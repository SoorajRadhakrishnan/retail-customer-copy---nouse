<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Unit;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('units'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();

        $units = Unit::when($branch_id, function ($query,$branch_id) {
                    $query->where('branch_id',$branch_id);
                })->orderBy('id', 'desc')->get();
        return view('Admin.unit', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('unit_create'))) {
            return view('Helper.unauthorized_access');
        }
        $unit = null;
        return view('Admin.Model.unitmodel', compact('unit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'unit_name' => ['required',Rule::unique('units')
                            ->ignore($request->uuid,'uuid')
                            ->whereNull('deleted_at')
                            ->where(function ($query) use ($request){
                                return $query->where('branch_id',  $request->branch_id);
                            })],
            // 'unit_name' => 'unique:categories,unit_name,NULL,'. $request->uuid.',deleted_at,NULL',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            if (!(checkUserPermission('unit_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/unit'));
            }

            Unit::where('uuid', $request->uuid)->update([
                'unit_name' => $request->unit_name,
                'unit_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->unit_name))),
                'branch_id' => $request->branch_id,
            ]);
            return $this->sendResponse(1, 'Unit Updated', '', '');
        } else {

            if (!(checkUserPermission('unit_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/unit'));
            }

            Unit::create([
                'unit_name' => $request->unit_name,
                'unit_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->unit_name))),
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Unit Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit, Request $request)
    {
        if (!(checkUserPermission('unit_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.unitmodel', compact('unit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        if (!(checkUserPermission('unit_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/unit'));
        }
        $result = $unit->delete();
        if ($result) {
            return $this->sendResponse(1, 'unit Deleted succussfully', '', url('admin/unit'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/unit'));
        }
    }
}
