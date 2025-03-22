<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasePay;  // Assuming you have a model for the purchase_pay_log table
// use App\Models\PurchaseOrder;
use Carbon\Carbon;

use DB;  // Assuming you have a model for the purchase_orders table

class PurchasePayController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected supplier from the request
        $supplier = $request->input('supplier');

        // If no 'from_date' is provided, set it to null, otherwise set it to the input value
        $from_date = $request->input('from_date') ? Carbon::parse($request->input('from_date')) : null;
        $to_date = $request->input('to_date') ?? date('Y-m-d');
        $payment_type = $request->input('payment_type');

        // Add timestamps to ensure we catch all records for the day
        if ($from_date) {
            $from_date .= ' 00:00:00'; // Ensure it's a valid datetime format if not null
        }
        $to_date .= ' 23:59:59'; // Ensure to_date includes the whole day

        // Get the current shop ID from the authenticated user or the session
        $shop_id = auth()->user()->branch_id ?? getSessionBranch();

        // Start building the query
        $query = DB::table('purchase_orders')
            ->leftJoin('purchase_pay_log', 'purchase_pay_log.purchase_id', '=', 'purchase_orders.id') // Left join to purchase_pay_log
            ->where('purchase_orders.status', 'received') // Filter by 'received' status
            ->select(
                'purchase_orders.supplier_name',
                DB::raw('SUM(purchase_orders.total_amount) as total_amount'), // Sum of total amount per supplier
                DB::raw('SUM(purchase_pay_log.price) as total_paid'), // Sum of paid amount per supplier
                DB::raw('(SUM(purchase_orders.total_amount) - SUM(purchase_pay_log.price)) as credit') // Remaining balance (credit)
            )
            ->groupBy('purchase_orders.supplier_name') // Group by supplier name
            ->when($shop_id, function ($query) use ($shop_id) {
                return $query->where('purchase_orders.shop_id', $shop_id);
            })
            ->when($from_date && $to_date, function ($query) use ($from_date, $to_date) {
                return $query
                // ->whereBetween('purchase_pay_log.created_at', [$from_date, $to_date])
                ->whereBetween('purchase_orders.created_at', [$from_date, $to_date]) // Apply date filter on purchase_orders
                             ; // Apply date filter on purchase_pay_log
            })
            ->when($payment_type, function ($query) use ($payment_type) {
                return $query->where('purchase_pay_log.payment_type', $payment_type);
            })
            ->when($supplier, function ($query, $supplier) {
                return $query->where('purchase_orders.supplier_id', $supplier);
            })
            ->orderBy('purchase_orders.supplier_name', 'asc') // Apply ordering here
            ->get(); // Execute the query and get the result

        // Calculate if the total paid amount matches the total amount for each supplier
            $data=$query;

        \Log::info('Result Count: ' . $data->count());

        // Fetch all suppliers for the dropdown
        $suppliers = getSuppliers($shop_id); // Assuming `getSuppliers` retrieves the suppliers for the shop

        return view('Admin.Report.purchase-pay-log', [
            'data' => $data,
            'from_date' => $from_date ? substr($from_date, 0, 10) : null,  // Pass null if from_date is not set
            'to_date' => substr($to_date, 0, 10),
            'payment_type' => $payment_type,
            'suppliers' => $suppliers,  // Pass suppliers to the view
            'supplier' => $supplier,  // Pass the selected supplier
        ]);
    }




    public function create(Request $request)
    {
        $supplier_name = $request->id; // Supplier name passed as parameter

        // Retrieve purchase orders for the specified supplier with status 'received'
        $credit_list = DB::table('purchase_orders')
            ->leftJoin('purchase_pay_log', 'purchase_orders.id', '=', 'purchase_pay_log.purchase_id') // Use left join to include all orders
            ->where('purchase_orders.supplier_name', $supplier_name)
            ->where('purchase_orders.status', 'received') // Filter for orders that have status 'received'
            ->orderBy('purchase_orders.id', 'desc')
            ->select(
                'purchase_orders.id',
                'purchase_orders.uuid',
                'purchase_orders.shop_id',
                'purchase_orders.user_id',
                'purchase_orders.supplier_id',
                'purchase_orders.supplier_name',
                'purchase_orders.invoice_no',
                'purchase_orders.payment_status',
                'purchase_orders.total_amount',
                'purchase_orders.paid_amount',
                'purchase_orders.discount',
                'purchase_orders.total_discount',
                'purchase_orders.tax_amount',
                'purchase_orders.status',
                'purchase_orders.date_added',
                'purchase_orders.date_updated',
                'purchase_orders.created_at as purchase_order_created_at', // Renamed to avoid confusion
                'purchase_orders.updated_at',
                'purchase_orders.deleted_at',
                // Ensure we can handle cases where no payment exists
                'purchase_pay_log.payment_type as payment_method',
                DB::raw('(purchase_orders.total_amount - COALESCE(purchase_orders.paid_amount, 0)) as balance_amount'), // Calculate remaining balance
                DB::raw('COALESCE(purchase_pay_log.price, 0) as paid_amount'), // Set to 0 if no payment record
                'purchase_pay_log.created_at as payment_created_at' // Payment creation date
            )
            ->get();
        // dd($credit_list);
        // Pass the fetched credit list and supplier name to the view
        return view('Admin.Model.supplier_statement', compact('credit_list', 'supplier_name'));
    }



    public function show(string $credit_sale)
    {
        $supplier_name = $credit_sale; // Supplier name passed as parameter

        $credit_list = DB::table('purchase_orders')
            ->leftJoin('purchase_pay_log', 'purchase_orders.id', '=', 'purchase_pay_log.purchase_id') // Use left join to include all orders
            ->where('purchase_orders.supplier_name', $supplier_name)
            ->where('purchase_orders.status', 'received') // Filter for orders with status 'received'
            ->orderBy('purchase_orders.id', 'desc')
            ->select(
                'purchase_orders.id',
                'purchase_orders.uuid',
                'purchase_orders.shop_id',
                'purchase_orders.user_id',
                'purchase_orders.supplier_id',
                'purchase_orders.supplier_name',
                'purchase_orders.invoice_no',
                'purchase_orders.payment_status',
                'purchase_orders.total_amount',
                'purchase_orders.paid_amount',
                'purchase_orders.discount',
                'purchase_orders.total_discount',
                'purchase_orders.tax_amount',
                'purchase_orders.status',
                'purchase_orders.date_added',
                'purchase_orders.date_updated',
                'purchase_orders.created_at as purchase_order_created_at', // Renamed to avoid confusion
                'purchase_orders.updated_at',
                'purchase_orders.deleted_at',
                'purchase_pay_log.payment_type as payment_method',
                DB::raw('(purchase_orders.total_amount - COALESCE(purchase_orders.paid_amount, 0)) as balance_amount'), // Calculate remaining balance
                DB::raw('COALESCE(purchase_pay_log.price, 0) as paid_amount'), // Set to 0 if no payment record
                'purchase_pay_log.created_at as payment_created_at' // Payment creation date
            )
            ->get();

        // Pass the fetched credit list and supplier name to the view
        return view('Admin.Model.supplier_statement_print', compact('credit_list', 'supplier_name'));
    }


}
