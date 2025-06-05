<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Events\PaymentTransactionEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\PaymentTranscation;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if (!(checkUserPermission('payment_method'))) {
        //     return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        // }
        // if(auth()->user()->branch_id)
        // {
        //     $payment_methods = PaymentMethod::where('branch_id',auth()->user()->branch_id)->get();
        // }
        // else{
        $branch_id = $this->getBranchId();
        $payment_methods =  PaymentMethod::when($branch_id, function ($query,$branch_id) {
                                $query->where('branch_id',$branch_id);
                            })->get();
        // }

        return view('Admin.payment-method', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $payment_method = $openBalance = null;
        return view('Admin.Model.payment_method-model', compact('payment_method', 'openBalance'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            // 'payment_method_name' => 'required',
            'payment_method_name' => [
                                        'required',
                                        Rule::unique('payment_methods')
                                        ->ignore($request->uuid,'uuid')
                                        ->whereNull('deleted_at')
                                        ->where(function ($query) use ($request){
                                            return $query->where('branch_id',  $request->branch);
                                        }),
                                    ],
            'branch' => 'required',
            'opening_balance' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            PaymentMethod::where('uuid', $request->uuid)->update([
                'payment_method_name' => $request->payment_method_name,
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->payment_method_name))),
                'branch_id' => $request->branch,
            ]);

            $paymentMethod = PaymentMethod::where('uuid', $request->uuid)->first();

            PaymentTranscation::where('payment_type', $paymentMethod->payment_method_slug)
                    ->where('status', 'open_balance')
                    ->where('branch_id', $request->branch)
                    ->update([
                        'amount' => $request->opening_balance,
                    ]);
            return $this->sendResponse(1, 'Payment Method Updated', '', '');
        } else {

            $paymentMethod = PaymentMethod::create([
                'payment_method_name' => $request->payment_method_name,
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->payment_method_name))),
                'branch_id' => $request->branch,
                'uuid' => Str::uuid(),
            ]);

             event(new PaymentTransactionEvent(
                type: 'add',
                amount: $request->opening_balance,
                refNo: null,
                paymentType: $paymentMethod->payment_method_slug,
                status: 'open_balance',
                branchId: $request->branch,
            ));

            return $this->sendResponse(1, 'Payment Method Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $payment_method, Request $request)
    {
        $openBalance = PaymentTranscation::where('payment_type', $payment_method->payment_method_slug)
            ->where('status', 'open_balance')
            ->where('type', 'add')
            ->where('branch_id', $payment_method->branch_id)
            ->value('amount');

        return view('Admin.Model.payment_method-model', compact('payment_method', 'openBalance'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $result = $payment_method->delete();
        if ($result) {
            return $this->sendResponse(1, 'Payment Method Deleted succussfully', '', '');
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', '');
        }
    }
}
