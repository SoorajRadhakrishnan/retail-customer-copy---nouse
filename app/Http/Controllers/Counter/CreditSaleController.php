<?php

namespace App\Http\Controllers\Counter;

use App\Events\PaymentTransactionEvent;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;

class CreditSaleController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $customer_id = $request->customer;
    $sql = '';

    if ($customer_id) {
        $sql = "AND customer_id = '$customer_id' ";
    }

    $credit_sale = DB::select("
        SELECT customer_id,
            SUM(CASE WHEN type = 'credit' OR type = 'cod-credit' THEN amount ELSE 0 END) as credit,
            SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as debit,
            (SUM(CASE WHEN type = 'credit' OR type = 'cod-credit' THEN amount ELSE 0 END)
            - SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END)) as balance
        FROM credit_sale
        WHERE shop_id = '".auth()->user()->branch_id."'
        $sql
        GROUP BY customer_id
        HAVING balance > 0
        ORDER BY customer_id DESC
    ");

    return view('Counter.credit_sale', compact('credit_sale', 'customer_id'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customer_id = $request->id;
        $credit_list = DB::table('credit_sale')->where('customer_id', $request->id)->orderBy('id', 'desc')->get();
        return view('Counter.Model.credit_statement',compact('credit_list','customer_id'));
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

        $id = DB::table('credit_sale')->insertGetId([
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

        event(new PaymentTransactionEvent(
            type: 'add',
            amount: $request->amount,
            refNo: $id,
            paymentType: $request->payment_type,
            status: 'credit_recovery',
            branchId: auth()->user()->branch_id,
        ));

        return $this->sendResponse(1,'Payment Paid Success','','');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $credit_sale)
    {
        $credit_list = DB::table('credit_sale')->where('customer_id', $credit_sale)->orderBy('id', 'desc')->get();
        return view('Counter.Model.credit_statement_print',compact('credit_list','credit_sale'));
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
