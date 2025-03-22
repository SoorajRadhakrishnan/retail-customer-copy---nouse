<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\Driver;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('drivers'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $drivers = Driver::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
        })->orderBy('id', 'desc')->get();

        return view('Admin.driver', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('driver_create'))) {
            return view('Helper.unauthorized_access');
        }
        $driver = null;
        return view('Admin.Model.drivermodel', compact('driver'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'driver_name' => 'required',
            'driver_phone' => ['required',Rule::unique('drivers')
                                ->ignore($request->uuid,'uuid')
                                ->whereNull('deleted_at')
                                ->where(function ($query) use ($request){
                                    return $query->where('branch_id',  $request->branch_id);
                                })],
            'date_of_join' => 'required',
            'driver_code' => ['required',Rule::unique('drivers')
                                ->ignore($request->uuid,'uuid')
                                ->whereNull('deleted_at')
                                ->where(function ($query) use ($request){
                                    return $query->where('branch_id',  $request->branch_id);
                                })],
            'driver_pin' => 'required',
            'driver_license' => 'max:2048|mimes:pdf,jpg,png,jpeg|image',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        $imageName = '';
        if($request->driver_license)
        {
            if ($image = $request->file('driver_license')) {
                $destinationPath = storage_path('app/public/driver_license');
                $profileImage = time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $imageName = $profileImage;
            }
        }else{
            if($request->uuid)
            {
                $imageName = Driver::where('uuid',$request->uuid)->first('driver_license')->driver_license;
            }
        }

        if ($request->uuid) {
            if (!(checkUserPermission('driver_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/driver'));
            }

            Driver::where('uuid', $request->uuid)->update([
                'driver_name' => $request->driver_name,
                'driver_email' => $request->driver_email,
                'driver_phone' => $request->driver_phone,
                'driver_address' => $request->driver_address,
                'date_of_join' => $request->date_of_join,
                'driver_code' => $request->driver_code,
                'driver_pin' => $request->driver_pin,
                'driver_license' => $imageName,
                'branch_id' => $request->branch_id,
            ]);
            return $this->sendResponse(1, 'Driver Updated', '', '');
        } else {

            if (!(checkUserPermission('driver_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/driver'));
            }

            Driver::create([
                'driver_name' => $request->driver_name,
                'driver_email' => $request->driver_email,
                'driver_phone' => $request->driver_phone,
                'driver_address' => $request->driver_address,
                'date_of_join' => $request->date_of_join,
                'driver_code' => $request->driver_code,
                'driver_pin' => $request->driver_pin,
                'driver_license' => $imageName,
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Driver Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver, Request $request)
    {
        if (!(checkUserPermission('driver_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.drivermodel', compact('driver'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        if (!(checkUserPermission('driver_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/driver'));
        }
        $result = $driver->delete();
        if ($result) {
            return $this->sendResponse(1, 'Driver Deleted succussfully', '', url('admin/driver'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/driver'));
        }
    }
}
