<?php

namespace App\Http\Controllers\Counter;

use App\Models\Branch;
use App\Models\SaleOrders;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Customer;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CrmController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer_id = $request->customer;
        $customer = Customer::where('id',$customer_id)->first();
        $customer_orders = SaleOrders::where('customer_id',$customer_id)->orderBy('id', 'desc')->limit('5')->get();
        $item_orders = SaleOrders::leftJoin('sale_order_items', function ($join) {
            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');})
            ->where('sale_orders.customer_id',$customer_id)
            ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.item_unit_price * sale_order_items.qty) as item_price , sum(sale_order_items.qty) as qty,sum(sale_order_items.total_price) as total_price'))
            // ->groupBy('sale_order_items.item_id')
            ->groupBy('sale_order_items.price_size_id')
            ->orderBy('qty', 'desc')
            ->limit('5')
            ->get();

        $top_customes = SaleOrders::where('customer_id',"!=","0")->select(DB::raw('count(*) as total_count,customer_id,sum(with_tax) as with_tax'))
                        ->groupBy('customer_id')->limit('10')->orderBy('with_tax', 'desc')->get();
        $total_amount = SaleOrders::where('customer_id',$customer_id)->sum('with_tax');
        $total_count = SaleOrders::where('customer_id',$customer_id)
                        ->where('status',"!=","hold")->where('status',"!=","reject")->count();

        return view('Counter.crm',compact('customer_id','customer','customer_orders','item_orders','total_amount','top_customes','total_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = null;
        return view('Counter.Model.customer_mode', compact('customer'));
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
