<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Supplier;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('suppliers'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $suppliers = Supplier::when($branch_id, function ($query,$branch_id) {
                        $query->where('branch_id',$branch_id);
                    })->orderBy('id', 'desc')->get();
        return view('Admin.supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('supplier_create'))) {
            return view('Helper.unauthorized_access');
        }
        $supplier = null;
        return view('Admin.Model.suppliermodel', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validation = Validator::make($request->all(), [
            'supplier_name' => [
                'required',
                Rule::unique('suppliers')
                    ->ignore($request->uuid, 'uuid')
                    ->whereNull('deleted_at')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
            ],
            'supplier_company_name' => 'required',
            'supplier_phone' => 'required',
            'branch_id' => 'required',
        ]);

        // Check if validation fails
        if ($validation->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation errors',
                'response' => $validation->errors(),
            ]);
        }

        // Check if updating or creating a supplier
        if ($request->uuid) {
            // Check permissions for editing
            if (!checkUserPermission('supplier_edit')) {
                return response()->json([
                    'status' => 0,
                    'message' => config('constant.UNAUTHORIZED_ACCESS'),
                ]);
            }

            // Update supplier
            Supplier::where('uuid', $request->uuid)->update([
                'supplier_name' => $request->supplier_name,
                'supplier_company_name' => $request->supplier_company_name,
                'supplier_email' => $request->supplier_email,
                'supplier_company_email' => $request->supplier_company_email,
                'supplier_phone' => $request->supplier_phone,
                'supplier_address' => $request->supplier_address,
                'branch_id' => $request->branch_id,
            ]);

            // Return success response without redirection
            return response()->json([
                'status' => 1,
                'message' => 'Supplier Updated',
            ]);
        } else {
            // Check permissions for creating
            if (!checkUserPermission('supplier_create')) {
                return response()->json([
                    'status' => 0,
                    'message' => config('constant.UNAUTHORIZED_ACCESS'),
                ]);
            }

            // Create supplier
            Supplier::create([
                'supplier_name' => $request->supplier_name,
                'supplier_company_name' => $request->supplier_company_name,
                'supplier_email' => $request->supplier_email,
                'supplier_company_email' => $request->supplier_company_email,
                'supplier_phone' => $request->supplier_phone,
                'supplier_address' => $request->supplier_address,
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);

            // Return success response without redirection
            return response()->json([
                'status' => 1,
                'message' => 'Supplier Created',
                'id'=>Supplier::where('supplier_name',$request->supplier_name)->first()->id,
                'name'=>Supplier::where('supplier_name',$request->supplier_name)->first()->supplier_name
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier, Request $request)
    {
        if (!(checkUserPermission('supplier_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.suppliermodel', compact('supplier'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if (!(checkUserPermission('supplier_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/supplier'));
        }
        $result = $supplier->delete();
        if ($result) {
            return $this->sendResponse(1, 'Supplier Deleted succussfully', '', url('admin/supplier'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/supplier'));
        }
    }
}
