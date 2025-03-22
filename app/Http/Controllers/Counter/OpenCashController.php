<?php

namespace App\Http\Controllers\Counter;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;

class OpenCashController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!(checkUserPermission('opening_balance')))
        {
            return view('Helper.unauthorized_access');
        }
        $opencash = null;
        // $result = DB::table('settle_sale')->where('shop_id',auth()->user()->branch_id)->orderBy('id', 'desc')->first();
        // if($result !== null){
        //     $opencash = $result->cash_at_starting;
        // }else{
            $opencash = Branch::where('id',auth()->user()->branch_id)->first()->opening_cash;
        // }
        return view('Counter.Model.opencash',compact('opencash'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'opening_balance' => 'required',
            'branch_id' => 'required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        if(!(checkUserPermission('opening_balance')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('home'));
        }

        // $result = DB::table('settle_sale')->where('shop_id',$request->branch_id)->orderBy('id', 'desc')->first();
        // if($result !== null){
        //     DB::table('settle_sale')->where('id', $result->id)->update(['cash_at_starting' => $request->opening_balance]);
        // }else{
            Branch::where('id', auth()->user()->branch_id)->update([
                'opening_cash' => $request->opening_balance
            ]);
        // }
        return $this->sendResponse(1,'Opening Balance Updated','','');
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
