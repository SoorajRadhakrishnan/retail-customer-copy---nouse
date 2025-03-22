<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('customers'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $customers = Customer::when($branch_id, function ($query,$branch_id) {
                    $query->where('branch_id',$branch_id);
                })->orderBy('id', 'desc')->get();
        return view('Admin.customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('customer_create'))) {
            return view('Helper.unauthorized_access');
        }
        $customer = null;
        return view('Admin.Model.customermodel', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_number' => ['required',
                                    Rule::unique('customers')
                                    ->ignore($request->uuid,'uuid')
                                    ->whereNull('deleted_at')
                                    ->where(function ($query) use ($request){
                                        return $query->where('branch_id',  $request->branch_id);
                                    })],
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            if (!(checkUserPermission('customer_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/customer'));
            }

            Customer::where('uuid', $request->uuid)->update([
                'customer_name' => $request->customer_name,
                'customer_number' => $request->customer_number,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_gender' => $request->customer_gender,
                'branch_id' => $request->branch_id
            ]);
            return $this->sendResponse(1, 'Customer Updated', '', '');
        } else {

            if (!(checkUserPermission('customer_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/customer'));
            }

            Customer::create([
                'customer_name' => $request->customer_name,
                'customer_number' => $request->customer_number,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_gender' => $request->customer_gender,
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Customer Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, Request $request)
    {
        if (!(checkUserPermission('customer_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.customermodel', compact('customer'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if (!(checkUserPermission('customer_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/customer'));
        }
        $result = $customer->delete();
        if ($result) {
            return $this->sendResponse(1, 'Customer Deleted succussfully', '', url('admin/customer'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/customer'));
        }
    }
}
