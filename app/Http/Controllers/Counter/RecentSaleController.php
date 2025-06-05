<?php

namespace App\Http\Controllers\Counter;

use App\Events\PaymentTransactionEvent;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\ItemPrice;
use App\Models\SaleOrderItems;
use App\Models\SaleOrders;
use App\Models\SaleOrderPayment;
use App\Models\Admin\Staff;

class RecentSaleController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $customer_id = $request->customer;
        $order_type = $request->order_type;
        $receipt_id = $request->receipt_id;
        $branch_id = $this->getBranchId();
        $payment_type = $request->payment_type;

        $sale_orders = SaleOrders::where('shop_id',auth()->user()->branch_id)
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->when($customer_id, function ($query,$customer_id) {
                            $query->where('customer_id',$customer_id);
                        })
                        ->when($order_type, function ($query,$order_type) {
                            $query->where('order_type',$order_type);
                        })
                        ->when($receipt_id, function ($query,$receipt_id) {
                            $query->where('receipt_id',$receipt_id);
                        })
                        ->when($payment_type, function ($query,$payment_type) {
                            $query->where('payment_type',$payment_type);
                        })
                        ->where('status','!=','hold')
                        ->orderBy('id',"desc")
                        ->get();

                    $PaymentLists = PaymentList($branch_id);
                        // dd($PaymentLists);

        return view('Counter.recent_sale',compact('sale_orders','customer_id','order_type','receipt_id','payment_type','PaymentLists'));
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
        $validation = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'payment_type' => 'required|string',
            'balance' => 'required|numeric',
            'cus_id' => 'required|exists:customers,id',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if (!(checkUserPermission('credit_sale'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('home'));
        }

        DB::transaction(function () use ($request) {
            // Insert into credit_sale
            $creditSaleId = DB::table('credit_sale')->insertGetId([
                'customer_id' => $request->cus_id,
                'name' => getCustomer($request->cus_id)->customer_name,
                'number' => $request->customer_number,
                'type' => 'debit',
                'amount' => $request->amount,
                'paid_date' => now(),
                'payment_type' => $request->payment_type,
                'user_id' => auth()->user()->id,
                'shop_id' => auth()->user()->branch_id,
            ]);

            // Update SaleOrders
            $this->updatePaymentType($request->sale_order_id, $request->payment_type);
        });

        return $this->sendResponse(1, 'Payment Paid Success', '', '');
    }

    public function changePaymentType(Request $request) {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:sale_orders,id', // Ensure this matches your sale order table
            'payment_type' => 'required|string', // Adjust validation rules as necessary
        ]);

        // Find the sale order
        $saleOrder = SaleOrders::find($request->id);
        if ($saleOrder) {
            // Update payment_type in SaleOrders
            $saleOrder->payment_type = $request->payment_type;
            $saleOrder->save();

            // Update payment_type in SaleOrderPayment
            SaleOrderPayment::where('sale_order_id', $saleOrder->id)->update([
                'payment_type' => $request->payment_type
            ]);

            event(new PaymentTransactionEvent(
                refNo: $saleOrder->id,
                paymentType: $request->payment_type,
                status: 'sale',
                update: true
            ));

            return response()->json(['status' => 1, 'message' => 'Payment type updated successfully.']);
        }

        return response()->json(['status' => 0, 'message' => 'Sale order not found.'], 404);
    }
                /**
     * Display the specified resource.
     */
 public function show(Request $request)
    {
        // Validate the request to ensure 'uuid' is provided
        $request->validate([
            'id' => 'required|exists:sale_orders,uuid',
            'reason' => 'required|string|max:255',
        ]);

        // Find the sale order using the 'uuid'
        $saleOrder = SaleOrders::where('uuid', $request->id)->firstOrFail();
        $saleOrder->edit_reason = $request->reason;
        $saleOrder->save();

        // Redirect to the edit page for the sale order
        return response()->json([
            'status' => 1,
            'message' => 'Edit reason saved successfully.',
            'redirect_url' => url("home/{$saleOrder->uuid}/edit?edited=yes")
        ]);
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
    public function destroy(Request $request, string $sale_order)
    {
        $saleOrder = SaleOrders::where('uuid', $sale_order)->first();

        // Check if the user has permission to delete sales
        if (!(checkUserPermission('sale_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('home'));
        }

        // Validate the reason field
        $request->validate([
            'reason' => 'required|string',
        ]);

        // Check if staff_pin validation is enabled
        if (app('appSettings')['staff_pin']->value == 'yes') {
            $request->validate([
                'staff_pin' => 'required|string'
            ]);

            // Validate the staff pin
            $result = Staff::where('staff_pin', $request->staff_pin)
                            ->where('branch_id', auth()->user()->branch_id)
                            ->first();

            if (!$result) {
                return response()->json(['status' => 0, 'message' => 'Invalid Staff PIN.']);
            }
        }

        // Attempt to save the reason and proceed with the deletion
        if ($saleOrder) {
            $saleOrder->reason = $request->reason; // Save the reason
            $saleOrder->save();

            // Retrieve the sale_id and sale type (assuming 'delete' type for this example)
            $sale_id = $saleOrder->id;
            $type = 'delete';  // You can dynamically set this based on request if necessary
            $status = null;     // Not needed in the delete operation
            $payment_type = null; // Not needed in the delete operation
            $total = 0;         // Not needed in the delete operation

            // Only proceed with deletion and stock update if type is 'delete'
            if ($type == 'delete') {
                // Get all sale items
                $items = SaleOrderItems::where('sale_order_id', $sale_id)->get();

                foreach($items as $key => $item) {
                    $old = ItemPrice::where('id', $item->price_size_id)->first();
                    $closing_stock = $old->stock + $item->qty;
                    ItemPrice::where('id', $item->price_size_id)->increment('stock', $item->qty);

                    // Insert stock management history
                    DB::table('stock_management_history')->insert([
                        'user_id' => auth()->user()->id,
                        'item_id' => $item->item_id,
                        'item_price_id' => $item->price_size_id,
                        'action_type' => 'add',
                        'open_stock' => $old->stock,
                        'stock_value' => $item->qty,
                        'closing_stock' => $closing_stock,
                        'date_added' => date("Y-m-d H:i:s"),
                        'reference_no' => $item->id,
                        'reference_key' => "Sale Delete",
                        'shop_id' => auth()->user()->branch_id
                    ]);
                }

                // Delete associated sale records
                SaleOrders::where('id', $sale_id)->delete();
                SaleOrderItems::where('sale_order_id', $sale_id)->delete();
                SaleOrderPayment::where('sale_order_id', $sale_id)->delete();
                event(new PaymentTransactionEvent(
                    refNo: $sale_id,
                    status: 'sale',
                    delete: true
                ));

                return $this->sendResponse(1, 'Sale deleted successfully.', '', url('home'));
            }

            // If type is not 'delete', respond with failure message (you can add more conditions as needed)
            return $this->sendResponse(1, 'Failed to delete sale order. Invalid type.', '', url('home'));
        }

        return $this->sendResponse(1, 'Sale order not found!', '', url('home'));
    }


}
