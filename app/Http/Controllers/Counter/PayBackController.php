<?php

namespace App\Http\Controllers\Counter;

use App\Models\PayBack;
use App\Models\SaleOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;

class PayBackController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        $key = $request->input('key');
        $from_date = $request->from_date ? $request->from_date . ' 00:00:00' : now()->startOfDay()->format('Y-m-d H:i:s');
        $to_date = $request->to_date ? $request->to_date . ' 23:59:59' : now()->endOfDay()->format('Y-m-d H:i:s');
        $customer_id = $request->customer_id;

        $value = null;
        $payBacks = null;
        $customers = DB::table('customers')->select('id', 'customer_name')->get();

        if ($key) {
            $value = SaleOrders::where('receipt_id', $key)->first();
            $customer_id = $value ? $value->customer_id : null;
        }

        $query = DB::table('pay_back')
            ->join('items', 'pay_back.item_id', '=', 'items.id')
            ->join('sale_orders', 'pay_back.receipt_id', '=', 'sale_orders.receipt_id')
            ->join('users', 'pay_back.user_id', '=', 'users.id')
            ->leftJoin('customers', 'sale_orders.customer_id', '=', 'customers.id')
            ->select(
                'pay_back.*',
                'items.item_name as item_name',
                'customers.customer_name as customer_name',
                'users.name as user_name'
            );

        if ($from_date && $to_date) {
            $query->whereBetween('pay_back.payback_date', [$from_date, $to_date]);
        }

        if ($customer_id) {
            $query->where('customers.id', $customer_id);
        }

        $payBacks = $query->get();

        return view('Counter.pay_back', [
            'key' => $key,
            'value' => $value,
            'payBacks' => $payBacks,
            'customers' => $customers,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'customer_id' => $customer_id,
        ]);
    }

    public function store(Request $request)
    {
        $return_qty = $request->return_qty ?? [];
        $sale_order_item_id = $request->sale_order_item_id ?? [];
        $sale_order_id = $request->sale_order_id ?? [];
        $item_id = $request->item_id ?? [];
        $price_size_id = $request->price_size_id ?? [];
        $price = $request->price ?? [];
        $discount = $request->discount ?? [];
        $discount_percent = $request->discount_percent ?? [];
        $tax_amt = $request->tax_amt ?? [];
        $final_price = $request->final_price ?? [];
        $receipt_id = $request->key;

        $return_id = [];

        foreach ($return_qty as $key => $value) {
            if ($value && isset($sale_order_item_id[$key], $sale_order_id[$key], $item_id[$key], $final_price[$key])) {
                $id = DB::table('pay_back')->insertGetId([
                    'shop_id' => auth()->user()->branch_id,
                    'user_id' => auth()->user()->id,
                    'sale_order_item_id' => $sale_order_item_id[$key],
                    'sale_order_id' => $sale_order_id[$key],
                    'receipt_id' => $receipt_id,
                    'item_id' => $item_id[$key],
                    'qty' => $value,
                    'amount' => $final_price[$key],
                    'discount' => $discount[$key] ?? 0,
                    'discount_percent' => $discount_percent[$key] ?? 0,
                    'tax_amt' => $tax_amt[$key] ?? 0,
                    'tax_type' => $request->tax_type[$key] ?? null,
                    'payback_date' => now(),
                    'payment_type' => $request->payment_type,
                ]);

                $item_id_key = $item_id[$key];
                $price_size_id_key = $price_size_id[$key] ?? null;
                $user_id = auth()->user()->id;
                $shop_id = auth()->user()->branch_id;

                $latest_stock = DB::table('stock_management_history')
                    ->where('item_id', $item_id_key)
                    ->orderBy('date_added', 'desc')
                    ->first();

                $open_stock = $latest_stock ? $latest_stock->closing_stock : 0;
                $closing_stock = $open_stock + $value;

                DB::table('stock_management_history')->insert([
                    'shop_id' => $shop_id,
                    'user_id' => $user_id,
                    'item_id' => $item_id_key,
                    'item_price_id' => $price_size_id_key,
                    'action_type' => 'add',
                    'reference_no' => $receipt_id,
                    'reference_key' => 'pay_back',
                    'open_stock' => $open_stock,
                    'closing_stock' => $closing_stock,
                    'stock_value' => $closing_stock * ($price[$key] ?? 0),
                    'date_added' => now(),
                ]);

                DB::table('item_prices')
                    ->where('id', $price_size_id_key)
                    ->increment('stock', $value);

                $return_id[] = $id;
            }
        }

        if (count($return_id) > 0) {
            return redirect('pay-back')->with("print", implode(",", $return_id))->with("receipt_id", $receipt_id);
        } else {
            return redirect('pay-back')->withMessage('Payback success');
        }
    }
  
      public function create()
    {
        return view("Counter.payback_print");
    }


}
