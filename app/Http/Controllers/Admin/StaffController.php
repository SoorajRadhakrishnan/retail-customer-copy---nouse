<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\Staff;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('staffs'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $staffs = Staff::when($branch_id, function ($query,$branch_id) {
                    $query->where('branch_id',$branch_id);
                })->orderBy('id', 'desc')->get();

        return view('Admin.staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('staff_create'))) {
            return view('Helper.unauthorized_access');
        }
        $staff = null;
        return view('Admin.Model.staffmodel', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'staff_name' => 'required',
            'staff_phone' => ['required',Rule::unique('staff')
                            ->ignore($request->uuid,'uuid')
                            ->whereNull('deleted_at')
                            ->where(function ($query) use ($request){
                                return $query->where('branch_id',  $request->branch_id);
                            })],
            'date_of_join' => 'required',
            'staff_code' => ['required',Rule::unique('staff')
                            ->ignore($request->uuid,'uuid')
                            ->whereNull('deleted_at')
                            ->where(function ($query) use ($request){
                                return $query->where('branch_id',  $request->branch_id);
                            })],
            'staff_pin' => 'required',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            if (!(checkUserPermission('staff_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/staff'));
            }

            Staff::where('uuid', $request->uuid)->update([
                'staff_name' => $request->staff_name,
                'staff_email' => $request->staff_email,
                'staff_phone' => $request->staff_phone,
                'staff_address' => $request->staff_address,
                'date_of_join' => $request->date_of_join,
                'staff_code' => $request->staff_code,
                'staff_pin' => $request->staff_pin,
                'branch_id' => $request->branch_id,
            ]);
            return $this->sendResponse(1, 'Staff Updated', '', '');
        } else {

            if (!(checkUserPermission('staff_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/staff'));
            }

            Staff::create([
                'staff_name' => $request->staff_name,
                'staff_email' => $request->staff_email,
                'staff_phone' => $request->staff_phone,
                'staff_address' => $request->staff_address,
                'date_of_join' => $request->date_of_join,
                'staff_code' => $request->staff_code,
                'staff_pin' => $request->staff_pin,
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Staff Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff, Request $request)
    {
        if (!(checkUserPermission('staff_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.staffmodel', compact('staff'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        if (!(checkUserPermission('staff_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/staff'));
        }
        $result = $staff->delete();
        if ($result) {
            return $this->sendResponse(1, 'Staff Deleted succussfully', '', url('admin/staff'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/staff'));
        }
    }
}
