<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\SaleOrders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettleSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'settle_sale';

    protected $fillable = [
        'expense_cat_id', 'expense_cat_name', 'invoice_no', 'description',
        'total_before_vat', 'vat', 'total_amount', 'action', 'user_id', 'branch_id', 'uuid'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getAllSettle($inputs)
    {
        $shop_id = $inputs['shop_id'];
        $from_date = (isset($inputs['from_date']) && $inputs['from_date'] != '') ? $inputs['from_date'] : '';
        $last_settle_sale = $this->getSettleSale($inputs);
        if ($last_settle_sale !== null) {
            // $cash_at_starting = $last_settle_sale->cash_at_starting;
            if($from_date == ''){
                $inputs['from_date'] = (isset($last_settle_sale->settle_date) && $last_settle_sale->settle_date != '') ? $last_settle_sale->settle_date : date("Y-m-d H:i:s");
            }
        } else {
            // $cash_at_starting = auth()->user()->branch->opening_cash;
            $date = DB::table('sale_orders')->where('shop_id', $shop_id)->orderBy('ordered_date', 'ASC')->first('ordered_date');
            if($from_date == ''){
                $inputs['from_date'] = (isset($date) && $date != '') ? $date->ordered_date : date("Y-m-d H:i:s");
            }
        }
        $cash_at_starting = auth()->user()->branch->opening_cash;
        // echo "<pre>";print_r($cash_at_starting);echo "</pre>";exit;
        $orders =  $this->getSaleOrderItemDetailsList($inputs);
        $credit_sale = $this->getCreditSale($inputs);
        $pay_back = $this->getAllPayBack($inputs);
        $expense_db = $this->getExpense($inputs);
        $orders_by_paid_date = $this->deliveryRecovery($inputs);//null; //getSaleOrderItemDetailsListByPaidDate($inputs);

        $grand_total_tax = $cash_back_amount = 0;
        $py_back1 = $expense = 0;
        $grand_total_without_tax = 0;
        $Grand_total = 0;
        $Net_total = 0;
        $CashSale = 0;
        $CardSale = 0;
        $CreditSale = 0;
        $CashDrawerAmt = 0;
        $cod_pending = false;
        $hold_pending = false;
        $deliveryUnPaidRecover = $deliveryPaidRecover = array();
        $deliveryUnPaidRecover['cod-cash'] = 0;
        $CashStartAmt = 0;
        $DeliverySale = 0;
        $CreditRecover = 0;
        $DiscountTotal = 0;
        $Cg_adv = 0;
        $Cg_recover = 0;
        $py_back = 0;
        $add_amt_new = 0;
        $DeliveryRecover = 0;
        $DeliveryCashRecover = 0;
        $adv_amt_new = 0;
        $Online_Order_Recovery = 0;
        $py_back_val = $py_back1_disc = $expense_vat = $cash_drawer_acct_exp = 0;

        if($orders_by_paid_date !== null)
        {
            $DeliveryRecover = $orders_by_paid_date->total_price;
        }

        $py_back_tax = $py_back_discount = $py_cash_back = 0;
        if (!$pay_back->isEmpty()) {
            foreach ($pay_back as $py_back_row) {
                if ($py_back_row->payment_type == 'cash') {
                    $py_cash_back += $py_back_row->amount * $py_back_row->qty;
                }
                $py_back += $py_back_row->amount * $py_back_row->qty;
                $py_back_discount += $py_back_row->discount * $py_back_row->qty;
                $py_back_tax += $py_back_row->tax_amt;
            }
        }

        if (!empty($expense_db)) {
            foreach ($expense_db as $expen) {
                $expense += $expen->total_amount;
                $expense_vat += $expen->vat;
            }
        }
        $sale_order_ids = array();
        if (!empty($orders)) {
            foreach ($orders as $row) {
                $sale_order_ids[] = $row['id'];
                //if($inputs['user_id']==$row['user_id'] && $inputs['shop_id']==$row['shop_id']){
                if ($inputs['shop_id'] == $row['shop_id']) {
                    $items = (array)json_decode($row['items'], true);
                    //echo "<pre>"; print_r($row);
                    if (count($items) != 0) {
                        //print_r($items);
                        $total = $discount_price = 0;
                        foreach ($items as $items_row) {
                            //print_r($items_row['item_id']);
                            $qty = $items_row['qty'];
                            $price = $items_row['price'];
                            $total += ($qty * $price);
                            $item_discount = $items_row['item_discount'];
                            $discount_price += ($item_discount * $qty);
                        }

                        $gross_total = $row['without_tax'];
                        $discount = $row['discount'];
                        $tax_amount = $row['tax_amount'];
                        $net_total = $row['with_tax'];

                        $grand_total_tax += $tax_amount;

                        // $cash_back_amount += $row['cash_back_tot_amount'];


                        if ($row['payment_type'] == 'card') {
                            $CardSale += $net_total;
                            // $CardSaleNoVat+=$gross_total - $discount_price;
                        }
                        if ($row['payment_type'] == 'cash') {
                            $CashSale += $net_total;
                            // $CashSaleNoVat+=$gross_total - $discount_price;
                        }

                        if ($row['payment_type'] == 'both') {
                            $card_amount = $cash_amount = 0;
                            if ($row['cash'] != 0 && $row['cash'] != '') {
                                $cash_amount = $net_total;
                            }
                            if ($row['card'] != 0 && $row['card'] != '') {
                                $card_amount  =  $row['card'];
                                $cash_amount = $net_total - $row['card'];
                                if ($cash_amount < 0) {
                                    $cash_amount = 0;
                                    $card_amount = $net_total;
                                }
                            }
                            $CashSale += $cash_amount;
                            $CardSale += $card_amount;
                        }


                        if ($row['payment_type'] == 'credit') {
                            $CreditSale += $net_total;
                        }
                        if ($row['payment_type'] != '' && $row['order_type'] == 'delivery') {
                            $DeliverySale += $net_total;

                            // echo"<pre>";print_r($row);
                            $deliveryUnPaidRecover[$row['payment_type']] = isset($deliveryUnPaidRecover[$row['payment_type']])  ? $deliveryUnPaidRecover[$row['payment_type']] : 0;
                            $deliveryUnPaidRecover[$row['payment_type']] += $net_total;

                            if ($row['payment_status'] == 'unpaid') {
                                $cod_pending = true;
                            }
                            if ($row['status'] != 'delivered') {
                                $cod_pending = true;
                            }
                        }
                        if ($row['status'] == 'hold') {
                            $hold_pending = true;
                        }

                        // $DiscountTotal=$DiscountTotal+$discount_price;
                        $DiscountTotal = $DiscountTotal + $discount;
                    }
                }
            }
        }
        $TotAllAmt = $CashSaleAmt = 0;
        $payment_types_amount = $this->getPaymetTypesSettle($sale_order_ids, $shop_id);
        if (count($payment_types_amount) != 0) {
            foreach ($payment_types_amount as $pay_value) {
                $TotAllAmt += $pay_value['amount'];
                if (strtolower($pay_value['payment_type']) == 'cash') {
                    $CashSaleAmt += $pay_value['amount'];
                }
            }
        }
        $CreditRecoverCash = 0;
        if (!empty($credit_sale)) {
            foreach ($credit_sale as $row) {
                if ($row->type == 'debit') {
                    if (strtolower($row->payment_type) == 'cash') {
                        $CreditRecoverCash += $row->amount;
                    }
                    $CreditRecover += $row->amount;
                }
            }
        }
        if (count($payment_types_amount) != 0) {
            foreach ($payment_types_amount as $pay_value) {
                $Grand_total += $pay_value['amount'];
            }
        }

        $Grand_total = $Grand_total + $DiscountTotal;//$Grand_total + ($DiscountTotal - $py_back_discount); //-$py_back;


        $CashDrawerAmt = ($CashSaleAmt + $CreditRecoverCash) - $py_cash_back;
        $Net_total = $Grand_total - $DiscountTotal;//($Grand_total - ($DiscountTotal - $py_back_discount));
        //if(ACCOUNT == 'yes'){
        //$CashDrawerAmt = ($CashDrawerAmt + $cash_at_starting) - ($cash_drawer_acct_exp);
        //$CashDrawerAmt = ($CashDrawerAmt + $cash_at_starting);
        //}else{
        $CashDrawerAmt = ($CashDrawerAmt + $cash_at_starting) - ($expense);
        //$CashDrawerAmt = ($CashDrawerAmt + $cash_at_starting);
        //}


        $result_ar = array();
        $result_ar['cash_sale'] = $CashSaleAmt;
        $result_ar['card_sale'] = $CardSale;
        $result_ar['credit_sale'] = $CreditSale;
        $result_ar['delivery_sale'] = $DeliverySale;
        $result_ar['cash_at_starting'] = $cash_at_starting;
        //$result_ar['paid_sale']=$PaidSale;
        $result_ar['credit_recover'] = $CreditRecover;
        $result_ar['delivery_recover'] = $DeliveryRecover;
        $result_ar['online_order_recovery'] = $Online_Order_Recovery;
        $result_ar['cg_advance'] = $Cg_adv;
        $result_ar['cg_recover'] = $Cg_recover;
        $result_ar['pay_back'] = $py_back;
        $result_ar['gross_total'] = $Grand_total;//($Grand_total - $py_back);
        $result_ar['deliveryUnPaidRecover'] = $deliveryUnPaidRecover;
        $result_ar['deliveryPaidRecover'] = $deliveryPaidRecover;
        //echo $py_back_tax;
        $result_ar['gross_total_tax'] = $grand_total_tax;//($grand_total_tax - $py_back_tax);
        $result_ar['gross_total_without_tax'] = ($grand_total_without_tax + $CreditRecover);
        $result_ar['expense'] = $expense;
        $result_ar['discount'] = $DiscountTotal;//($DiscountTotal - $py_back_discount);
        $result_ar['net_total'] = $Net_total;//($Net_total - $py_back);
        $result_ar['cash_drawer'] = $CashDrawerAmt;
        $result_ar['last_settle_date'] = $inputs['from_date'];
        $result_ar['cod_pending'] = $cod_pending;
        $result_ar['hold_pending'] = $hold_pending;
        $result_ar['orders'] = $orders;
        $result_ar['cash_back_amount'] = $cash_back_amount;
        $result_ar['multi_payment_types_amount'] = $payment_types_amount;
        $result_ar['pay_back_vat'] = $py_back_tax;

        // echo '<pre>'; print_r($result_ar);die;
        return $result_ar;
    }

    public function getSettleSale($inputs)
    {
        $shop_id = $inputs['shop_id'];
        return DB::table('settle_sale')->where('shop_id', $shop_id)->orderBy('id', 'desc')->limit('1')->first();
    }

    public function getSaleOrderItemDetailsList($inputs)
    { //print_r($inputs); die;
        $shop_id = (isset($inputs['shop_id']) && $inputs['shop_id'] != '') ? $inputs['shop_id'] : '';
        $from_date = (isset($inputs['from_date']) && $inputs['from_date'] != '') ? $inputs['from_date'] : '';
        $user_id = (isset($inputs['user_id']) && $inputs['user_id'] != '') ? $inputs['user_id'] : '';
        $payment_type = (isset($inputs['payment_type']) && $inputs['payment_type'] != '') ? $inputs['payment_type'] : '';
        $order_type = (isset($inputs['order_type']) && $inputs['order_type'] != '') ? $inputs['order_type'] : '';
        $customer_number = (isset($inputs['customer_number']) && $inputs['customer_number'] != '') ? $inputs['customer_number'] : '';
        $receipt_id = (isset($inputs['receipt_id']) && $inputs['receipt_id'] != '') ? $inputs['receipt_id'] : '';
        $status_online_order = (isset($inputs['status_online_order']) && $inputs['status_online_order'] != '') ? $inputs['status_online_order'] : '';
        $to_date = (isset($inputs['to_date']) && $inputs['to_date'] != '') ? $inputs['to_date'] : '';
        $driver_id = (isset($inputs['driver_id']) && $inputs['driver_id'] != '') ? $inputs['driver_id'] : '';

        // $query = DB::table('sale_orders')->where("id", "!=","")->where('order_type','!=','free_sale');
        $query = DB::table('sale_orders')->where('shop_id', $shop_id)
            ->where("id", "!=", "")->where('order_type', '!=', 'free_sale')
            ->whereBetween('ordered_date', [$from_date, $to_date])
            ->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
        // if(isset($shop_id) && $shop_id != '') {
        // 	$query->where('shop_id',$shop_id);
        // }
        // if(isset($driver_id) && $driver_id != '') {
        //     $query->where('driver_id',$driver_id);
        // }
        // if((isset($from_date) && $from_date != '') && (isset($to_date) && $to_date != '' )) {
        //     $query->whereBetween('ordered_date', [$from_date, $to_date]);
        // }
        // if(isset($payment_type) && $payment_type != '') {
        //     $query->where('payment_type',$payment_type);
        // }
        // // if(isset($user_id) && $user_id != '') {
        // // 	//$query .= " AND user_id='$user_id'";
        // // }
        // if(isset($order_type) && $order_type != '') {
        //     $query->where('order_type',$order_type);
        // }
        // if(isset($inputs['receipt_id']) && $inputs['receipt_id'] != '') {
        //     $query->where('receipt_id',$receipt_id);
        // }
        // if(isset($inputs['customer_number']) && $inputs['customer_number'] != '') {
        //     $query->where('customer_number',$customer_number);
        // }
        // if($status_online_order != ''){
        // 	if(isset($inputs['payment_status']) && $inputs['payment_status'] != '') {
        //         $query->where('payment_status','unpaid');
        // 	}
        // }
        // if(isset($inputs['status']) && $inputs['status'] != '' && $status_online_order == '') {
        //     $query->where('status','!=','delivered');
        //     $query->orWhere('payment_status','unpaid');
        // }
        // //For online order
        // if(isset($inputs['status_online_order']) && $inputs['status_online_order'] != '') {
        //     $query->where('status',$status_online_order);
        // }
        // $query->orderBy('id','DESC')->get();
        // $result = mysqli_query($GLOBALS['conn'], $query);
        if (!$query->isEmpty()) {
            $result_arr = array();
            foreach ($query as $row) {
                $result_ar = array();
                $result_ar['id'] = $row->id;
                $result_ar['user_id'] = $row->user_id;
                $result_ar['shop_id'] = $row->shop_id;
                $result_ar['contact_name'] = $row->customer_name;
                $result_ar['contact_number'] = $row->customer_number;
                $result_ar['customer_email'] = $row->customer_email;
                $result_ar['address'] = $row->customer_address;
                $result_ar['order_type'] = $row->order_type;
                $result_ar['payment_type'] = $row->payment_type;
                $result_ar['payment_status'] = $row->payment_status;
                $result_ar['status'] = $row->status;
                $result_ar['driver_id'] = $row->driver_id;
                $result_ar['ordered_date'] = $row->ordered_date;
                $result_ar['discount'] = $row->discount;
                $result_ar['receipt_id'] = $row->receipt_id;
                $result_ar['delivered_in'] = $row->delivered_in;
                $result_ar['reject_reason'] = $row->reject_reason;
                $result_ar['vat'] = $row->vat;
                $result_ar['date_time'] = $row->date_time;
                $result_ar['amount_given'] = $row->amount_given;
                $result_ar['staff_id'] = $row->staff_id;
                $result_ar['without_tax'] = $row->without_tax;
                $result_ar['tax_amount'] = $row->tax_amount;
                $result_ar['with_tax'] = $row->with_tax;

                $order_items_arr = array();
                $query2 = DB::table('sale_order_items')->where("sale_order_id", $row->id)->whereNull('deleted_at')->get();
                // $query2 = "SELECT * FROM ".DB_PRIFIX."sale_order_items  WHERE sale_order_id='".$row->id."'";

                // $result2 = mysqli_query($GLOBALS['conn'], $query2);
                if (!$query2->isEmpty()) {
                    foreach ($query2 as $row2) {
                        $order_items_arr[] = $row2;
                    }
                }
                $result_ar['items'] = json_encode($order_items_arr);
                $result_arr[] = $result_ar;
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function getCreditSale($inputs)
    {
        $shop_id = $inputs['shop_id'];
        $from_date = $inputs['from_date'];
        $to_date = $inputs['to_date'];
        $query = DB::table('credit_sale')->where('shop_id', $shop_id)
            ->whereBetween('paid_date', [$from_date, $to_date])
            ->whereNull('deleted_at')->get();
        // if((isset($from_date) && $from_date != '') && (isset($to_date) && $to_date != '' )){
        // 	$query->where('shop_id',$shop_id)->whereBetween('paid_date', [$from_date, $to_date])->get();
        // }else{
        // 	$query->where('shop_id',$shop_id)->get();
        // }
        return $query;
    }

    public function getAllPayBack($inputs)
    {
        $shop_id = $inputs['shop_id'];
        $from_date = $inputs['from_date'];
        $to_date = $inputs['to_date'];

        $query = DB::table('pay_back')->where('shop_id', $shop_id)
            ->whereBetween('payback_date', [$from_date, $to_date])
            ->whereNull('deleted_at')->get();
        // if((isset($from_date) && $from_date != '') && (isset($to_date) && $to_date != '' )){
        // 	$query->where('shop_id',$shop_id)->whereBetween('payback_date', [$from_date, $to_date])->get();
        // }else{
        // 	$query->where('shop_id',$shop_id)->get();
        // }
        return $query;
    }

    public function getExpense($inputs)
    {
        $from_date = $inputs['from_date'];
        $to_date = $inputs['to_date'];
        $shop_id = (isset($inputs['shop_id']) && $inputs['shop_id'] != '') ? $inputs['shop_id'] : '';

        $query = DB::table('expenses')->where('branch_id', $shop_id)
            ->where('payment_status', 'paid')
            ->whereBetween('created_at', [$from_date, $to_date])
            ->whereNull('deleted_at')->get();
        // if((isset($from_date) && $from_date != '') && (isset($to_date) && $to_date != '' )){
        // 	$query->where('branch_id',$shop_id)->whereBetween('created_at', [$from_date, $to_date])->get();
        // }else{
        // 	$query->where('branch_id',$shop_id)->get();
        // }
        return $query;
    }

    public function getPaymetTypesSettle($sale_order_ids, $shop_id)
    {
        $result = DB::table('payment_methods')->whereNull('deleted_at')->where('branch_id', $shop_id)->get();
        //$result=mysqli_query($GLOBALS['conn'],"SELECT * from ".DB_PRIFIX."payment_types where status='1' AND cat_payment_id = '0'");
        $output = array();
        if (!$result->isEmpty()) {
            $result_arr = array();
            foreach ($result as $row) {
                $result_arr['payment_type'] = $row->payment_method_slug;
                // DB::enableQueryLog();
                $result1 = SaleOrderPayment::leftJoin('sale_orders', function ($join) {
                        $join->on('sale_order_payments.sale_order_id', '=', 'sale_orders.id');
                    })->whereIn('sale_order_payments.sale_order_id', $sale_order_ids)
                    ->where('sale_order_payments.payment_type', $row->payment_method_slug)
                    ->select(DB::raw('COALESCE(SUM(sale_order_payments.amount),0) as amount'))
                    ->groupBy('sale_order_payments.payment_type')
                    ->first();

                $amount = 0;
                if ($result1 !== null) {
                    // foreach($result1 as $row1)
                    // {
                    $amount = $result1->amount;
                    // }
                    $result_arr['amount'] = $amount;
                    $output[] = $result_arr;
                }
            }
        }
        return $output;
    }

    function setSettleSale($inputs)
    {
        $shop_id = $inputs['shop_id'];
        $user_id = $inputs['user_id'];
        $gross_total_tax = (isset($inputs['gross_total_tax']) && $inputs['gross_total_tax'] != '') ? $inputs['gross_total_tax'] : '0.00';
        $gross_total_without_tax = (isset($inputs['gross_total_without_tax']) && $inputs['gross_total_without_tax'] != '') ? $inputs['gross_total_without_tax'] : '0.00';
        $cash_at_starting = (isset($inputs['cash_at_starting']) && $inputs['cash_at_starting'] != '') ? $inputs['cash_at_starting'] : '';
        $cash_sale = $inputs['cash_sale'];
        $card_sale = $inputs['card_sale'];
        $credit_sale = $inputs['credit_sale'];
        $delivery_sale = $inputs['delivery_sale'];
        $online_order_recovery = $inputs['online_order_recovery'];
        $multi_payment_types_amount = serialize($inputs['multi_payment_types_amount']);
        $credit_recover = $inputs['credit_recover'];
        $cg_advance = (isset($inputs['cg_advance']) && $inputs['cg_advance'] != '') ? $inputs['cg_advance'] : '';
        $cg_recover = (isset($inputs['cg_recover']) && $inputs['cg_recover'] != '') ? $inputs['cg_recover'] : '';
        $gross_total = $inputs['gross_total'];
        $discount = $inputs['discount'];
        $expense = $inputs['expense'];
        $pay_back = $inputs['pay_back'];
        $pay_back_vat = $inputs['pay_back_vat'];
        $net_total = $inputs['net_total'];
        $cash_drawer = $inputs['cash_drawer'];
        $staff_id = $inputs['staff_id'];
        $settle_date = date("Y-m-d H:i:s");

        $last_settle_sale = $this->getSettleSale($inputs);
        if ($last_settle_sale !== null) {
            $inputs['from_date'] = (isset($last_settle_sale->settle_date) && $last_settle_sale->settle_date != '') ? $last_settle_sale->settle_date : date("Y-m-d H:i:s");
        } else {
            $date = DB::table('sale_orders')->where('shop_id', $shop_id)->orderBy('ordered_date', 'ASC')->whereNull('deleted_at')->first('ordered_date');
            $inputs['from_date'] = (isset($date) && $date != '') ? $date->ordered_date : date("Y-m-d H:i:s");
        }
        $inputs['to_date'] = $settle_date;

        return DB::table('settle_sale')->insert([
            "shop_id" => $shop_id,
            "user_id" => $user_id,
            "cash_at_starting" => $cash_at_starting,
            "cash_sale" => $cash_sale,
            "card_sale" =>  $card_sale,
            "credit_sale" => $credit_sale,
            "delivery_sale" => $delivery_sale,
            "online_order_recovery" => $online_order_recovery,
            "credit_recover" => $credit_recover,
            "cg_advance" => $cg_advance,
            "cg_recover" => $cg_recover,
            "gross_total" => $gross_total,
            "discount" => $discount,
            "net_total" => $net_total,
            "cash_drawer" => $cash_drawer,
            "settle_date" => $settle_date,
            "gross_total_tax" => $gross_total_tax,
            "gross_total_without_tax" => $gross_total_without_tax,
            "expense" => $expense,
            "pay_back" => $pay_back,
            "staff_id" => $staff_id,
            "multi_payment_types_amount" => $multi_payment_types_amount,
            "deposit_amount" => 0,
            "petty_cash_amount" => 0,
            "pay_back_vat" => $pay_back_vat,
        ]);
    }

    public function deliveryRecovery($inputs)
    {
        $shop_id = $inputs['shop_id'];
        $from_date = $inputs['from_date'];
        $to_date = $inputs['to_date'];

        return SaleOrderPayment::where('shop_id',$shop_id)
            ->whereBetween('created_at', [$from_date, $to_date])
            ->where('order_type', 'delivery')
            ->select(DB::raw('sum(amount) as total_price'))
            ->first();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'shop_id','id');
    }
}
