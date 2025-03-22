<?php

namespace App\Http\Controllers\Counter;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OpenDrawer extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Counter.open_drawer_print');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(!(checkUserPermission('open_drawer')))
        // {
        //     return view('Helper.unauthorized_access');
        // }
        return view('Counter.Model.open_drawer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'branch_id' => 'required',
            'password' => 'required',
            'reason' => 'required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        // if(!(checkUserPermission('open_drawer')))
        // {
        //     return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('home'));
        // }

        if(app('appSettings')['drawer_password']->value != $request->password){
            return $this->sendResponse(0,'Password Does Not Match','','');
        }

        DB::table('open_drawer_log')->insert([
            'shop_id' => $request->branch_id,
            'user_id' => auth()->user()->id,
            'reason' => $request->reason,
            'open_date' => date("Y-m-d H:i:s"),
        ]);

        return $this->sendResponse(1,'Drawer Opened','',url('open-drawer'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
