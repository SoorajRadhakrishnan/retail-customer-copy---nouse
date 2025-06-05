<?php

namespace App\Http\Controllers\Admin;

use App\Events\PaymentTransactionEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\{PaymentMethod, PaymentTransfer};
use Illuminate\Support\Facades\{DB, Validator};

class PaymentTransferController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $payMethod = request()->query('payMethod') ?? null;

        if (!checkUserPermission('stock_transfer')) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $branch_id = $this->getBranchId();
        $paymentTransfers = PaymentTransfer::where('branch_id', $branch_id)
                            ->whereBetween('created_at', [$from_date, $to_date])
                            ->when($payMethod, function($query, $payMethod){
                                $query->where('source_payment_type', $payMethod)
                                ->orWhere('destination_payment_type', $payMethod);
                            })->latest()->get();

        $paymentMethods = PaymentMethod::where('branch_id', $branch_id)->get();

        return view('Admin.payment-transfer', compact('paymentTransfers', 'branch_id', 'paymentMethods', 'payMethod'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('stock_transfer_create'))) {
            return view('Helper.unauthorized_access');
        }
        $branch_id = $request->shop;
        $paymentMethods = PaymentMethod::where('branch_id', $branch_id)->get();
        return view('Admin.Model.paymentTransferModel', compact('paymentMethods', "branch_id"));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'source_payment_type' => 'required|different:destination_payment_type',
            'destination_payment_type' => 'required|different:source_payment_type',
            'notes' => 'nullable|string',
            'transaction_date' => 'nullable|date',
            'amount' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        $dateAdded = $request->transaction_date ? $request->transaction_date : date('Y-m-d');

        // Create new purchase logic
        if (!(checkUserPermission('stock_transfer_create'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/payment-transfer'));
        }

        $transfer = PaymentTransfer::create([
            'user_id' => auth()->user()->id,
            'branch_id' => $request->branch_id,
            'source_payment_type' => $request->source_payment_type,
            'destination_payment_type' => $request->destination_payment_type,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'transaction_date' => $dateAdded,
            'uuid' => Str::uuid(),
        ]);

        event(new PaymentTransactionEvent(
            type: 'sub',
            amount: $request->amount,
            refNo: $transfer->id,
            paymentType: $request->source_payment_type,
            status: 'payment transfer to ' . $request->destination_payment_type,
            branchId: $request->branch_id,
        ));

        event(new PaymentTransactionEvent(
            type: 'add',
            amount: $request->amount,
            refNo: $transfer->id,
            paymentType: $request->destination_payment_type,
            status: 'payment transfer received from ' . $request->source_payment_type,
            branchId: $request->branch_id,
        ));

        return $this->sendResponse(1, 'Payment Transfer Added', '', '');
    }
}
