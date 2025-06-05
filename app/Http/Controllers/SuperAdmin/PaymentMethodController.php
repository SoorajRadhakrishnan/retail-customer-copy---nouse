<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
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
            $payment_methods = PaymentMethod::all();
        // }

        return view('SuperAdmin.payment-method', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $payment_method = null;
        return view('SuperAdmin.Model.payment_method-model', compact('payment_method'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            return $this->sendResponse(1, 'Payment Method Updated', '', '');
        } else {

            PaymentMethod::create([
                'payment_method_name' => $request->payment_method_name,
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->payment_method_name))),
                'branch_id' => $request->branch,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Payment Method Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $payment_method, Request $request)
    {
        return view('SuperAdmin.Model.payment_method-model', compact('payment_method'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $result = $payment_method->delete();
        if ($result) {
            return $this->sendResponse(1, 'Payment Method Deleted succussfully', '', url('admin/payment-method'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/payment-method'));
        }
    }
}
