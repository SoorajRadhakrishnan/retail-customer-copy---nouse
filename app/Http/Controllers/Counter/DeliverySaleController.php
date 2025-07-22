<?php

namespace App\Http\Controllers\Counter;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SaleOrderPayment;
use Illuminate\Support\Facades\Validator;
use App\Models\SaleOrders;

class DeliverySaleController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $customer_id = $request->customer;
    $receipt_id = $request->receipt_id;
    $status = $request->status;
    $payment_type = $request->payment_type;

    $sale_orders = SaleOrders::where('shop_id', auth()->user()->branch_id)
        ->when($customer_id, function ($query, $customer_id) {
            $query->where('customer_id', $customer_id);
        })
        ->when($receipt_id, function ($query, $receipt_id) {
            $query->where('receipt_id', $receipt_id);
        })
        ->when($status, function ($query, $status) {
            $query->where('status', $status);
        }, function ($query) {
            // If no status is selected, exclude 'delivered' and 'reject'
            $query->whereNotIn('status', ['delivered', 'reject']);
        })
        ->when($payment_type, function ($query, $payment_type) {
            $query->where('payment_type', $payment_type);
        })
        ->orderBy('id', 'desc')
        ->get();

    return view('Counter.delivery_sale', compact('sale_orders', 'customer_id', 'receipt_id', 'status', 'payment_type'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $item_list = DB::table('sale_order_items')->where('sale_order_id', $request->id)->orderBy('id', 'desc')->get();
        return view('Counter.Model.recent_items',compact('item_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'amount' => 'required',
            'payment_type' => 'required',
            'balance' => 'required',
            'cus_id' => 'required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        if(!(checkUserPermission('credit_sale')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('home'));
        }

        DB::table('credit_sale')->insertGetId([
            'customer_id' => $request->cus_id,
            'name' => getCustomer($request->cus_id)->customer_name,
            'number' => $request->customer_number,
            'type' => 'debit',
            'amount' => $request->amount,
            'paid_date' => date('Y-m-d H:i:s'),
            'payment_type' => $request->payment_type,
            // 'sale_order_id' => $request->sale_order_id,
            'user_id' => auth()->user()->id,
            'shop_id' => auth()->user()->branch_id
        ]);
        return $this->sendResponse(1,'Payment Paid Success','','');
    }

    public function driverLog(Request $request)
    {
        $driver_id = $request->driver;

        $sale_orders = SaleOrders::where('shop_id',auth()->user()->branch_id)
                        ->when($driver_id, function ($query,$driver_id) {
                            $query->where('driver_id',$driver_id);
                        })
                        ->where('order_type','delivery')
                        ->where('status','!=','delivered')
                        ->where('status','!=','reject')
                        ->orderBy('id',"desc")
          ->where('payment_type', '=', '')
                        ->get();

        return view('Counter.driver_log',compact('sale_orders','driver_id'));
    }

    public function driver_order_close(Request $request)
    {
        // dd($request->all());
        $sale_ids = $request->checkDelivery;
        if(empty($sale_ids)){
            return redirect('driver-log')->withMessage('Sale closed error');
        }

        foreach($sale_ids as $sale_id => $value)
        {
            $status = 'delivered';
            $payment_type = $request->payment_type;
            $total = $value;
            if ($sale_id) {
                SaleOrders::where('id', $sale_id)->update([
                    'status' => $status
                ]);
                $balance = $total - getPaidSaleAmount($sale_id)->amount;
                if($balance > 0)
                {
                    SaleOrderPayment::create([
                        'sale_order_id' => $sale_id,
                        'payment_type' => $payment_type,
                        'amount' => $balance,
                        'currency' => app('appSettings')['currency']->value,
                        'multiplier' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'real_amount' => $balance,
                        'sub_payment_type' => '', //$sub_multiple_payment_type,
                        'remarks' => '', //$multiple_payment_remarks,
                        'order_type' => 'delivery',
                        'user_id' => auth()->user()->id,
                        'shop_id' => auth()->user()->branch_id
                    ]);
                }
            }
        }
        return redirect('driver-log')->withMessage('Sale closed success');
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
