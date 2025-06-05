<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\{Item, ItemPrice};
use App\Models\Purchase;
use App\Events\PaymentTransactionEvent;
use Illuminate\Support\Facades\{DB, Validator, Log};
use Carbon\Carbon;

class PurchaseController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        // Parse date range from request if available - from_date blank by default, to_date set to today
        $from_date = $request->input('from_date') ? Carbon::parse($request->input('from_date')) : null;
        $to_date = $request->input('to_date') ? Carbon::parse($request->input('to_date'))->endOfDay() : Carbon::today()->endOfDay();
        $supplier = $request->input('supplier');
        $payment_status = $request->input('payment_status') ?? '';
        $status = $request->input('status');
        $invoice_number = $request->input('invoice_number'); // Get invoice number from request

        // Authorization check
        if (!checkUserPermission('purchases')) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $query = Purchase::query();
        $shop_id = auth()->user()->branch_id ?? getSessionBranch();

        if ($shop_id) {
            $query->where('shop_id', $shop_id);
        }

        // Filter by supplier, invoice number, and conditional date range
        $query->when($supplier, function ($query, $supplier) {
            return $query->where('supplier_id', $supplier);
        })
            ->when($invoice_number, function ($query, $invoice_number) {
                return $query->where('invoice_no', 'LIKE', "%{$invoice_number}%");
            })
            ->when($from_date && $to_date, function ($query) use ($from_date, $to_date) {
                return $query->whereBetween('date_added', [$from_date, $to_date]);
            });

        // Conditional filtering for payment status
        if ($payment_status) {
            $query->where(function ($query) use ($payment_status) {
                if ($payment_status === 'paid') {
                    $query->where('payment_status', 'paid');
                } elseif ($payment_status === 'un_paid') {
                    $query->where('payment_status', 'un_paid');
                } elseif ($payment_status === 'partial_paid') {
                    $query->where('payment_status', 'partial_paid');
                } elseif ($payment_status === 'pending') {
                    $query->whereIn('payment_status', ['un_paid', 'partial_paid']);
                }
            });
        }
        if ($status) {
            $query->where('status', $status);
        }

        // DB::enableQueryLog();
        $purchases = $query->get();
        // Log::info('Executed Query: ', DB::getQueryLog());

        $suppliers = getSuppliers($shop_id);

        $totalOutstanding = Purchase::select(DB::raw('SUM(total_amount) - SUM(paid_amount) as amount_due'))
            ->when($from_date && $to_date, function ($query) use ($from_date, $to_date) {
                return $query->whereBetween('date_added', [$from_date, $to_date]);
            })
            ->when($supplier, function ($query, $supplier) {
                return $query->where('supplier_id', $supplier);
            })->first()->amount_due;

        $PaymentLists = PaymentList($shop_id);

        // Log::info('Request Parameters: ', $request->all());

        return view('Admin.purchase', compact('purchases', 'suppliers', 'payment_status', 'totalOutstanding', 'from_date', 'to_date', 'shop_id', 'PaymentLists'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('purchase_create'))) {
            return view('Helper.unauthorized_access');
        }
        $branch_id = $request->shop;
        $purchase = $purchse_items = null;
        $items = Item::leftJoin('item_prices', function ($join) {
            $join->on('items.id', '=', 'item_prices.item_id');
        })->leftJoin('price_size', function ($joins) {
            $joins->on('item_prices.price_size_id', '=', 'price_size.id');
        })->where('items.branch_id', $branch_id)
            ->where('items.stock_applicable', '1')
            //->where('items.ingredient', '0')
            // ->where('items.active', 'yes')
            // ->where('item_prices.price', '>', 0)
            ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name'))
            ->get();
        return view('Admin.Model.purchaseModel', compact('purchase', 'items', "purchse_items"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validation = Validator::make($request->all(), [
            'branch_id' => 'required',
            'supplier_id' => 'required',
            'invoice_no' => 'required|string',
            // 'payment_status' => 'required|string',
            'status' => 'required|string',
            'purchase_date' => 'nullable|date',
            'price_id.*' => 'required|integer', // Validate each price_id
            'item_id.*' => 'required|integer',   // Validate each item_id
            'item_name.*' => 'required|string',   // Validate each item_name
            'qty.*' => 'required|numeric|min:0.01',
            'cost_price.*' => 'required|numeric', // Validate each cost_price
            'total_price.*' => 'required|numeric', // Validate each total_price
            'discount' => 'nullable|array',
            'total_discount' => 'nullable|numeric', // Validate total_discount
            'tax.*' => 'nullable|numeric',         // Validate each tax if provided
            'tax_amount.*' => 'nullable|numeric',  // Validate each tax_amount if provided
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        // Use the purchase_date from the request or default to now()
        $dateAdded = $request->purchase_date ? $request->purchase_date : now();

        // Set default for total_discount if not provided
        $total_discount = $request->total_discount ?? 0;

        // Handle discount: if it's an array, sum it, otherwise use as is
        $discount = 0;
        if (is_array($request->discount)) {
            $discount = array_sum($request->discount);
        } else {
            $discount = $request->discount ?? 0;
        }

        if ($request->id) {
            // Update existing purchase logic (untouched as requested)
            if (!(checkUserPermission('purchase_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/purchase'));
            }

            DB::table('purchase_order_items')->where('purchase_id', $request->id)->delete();

            $price_id = $request->price_id;
            $tax_amount = $total_amount = 0;

            foreach ($price_id as $key => $values) {
                if (
                    !isset($values) || !isset($request->item_id[$key]) || !isset($request->item_name[$key]) ||
                    !isset($request->qty[$key]) || !isset($request->cost_price[$key]) || !isset($request->total_price[$key])
                ) {
                    continue;
                }

                $purchase_item_id = DB::table('purchase_order_items')->insertGetId([
                    'purchase_id' => $request->id,
                    'price_id' => $values,
                    'item_id' => $request->item_id[$key],
                    'product_name' => $request->item_name[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->cost_price[$key],
                    'total_amount' => $request->total_price[$key],
                    'discount' => $request->discount[$key] ?? 0,
                    'tax' => $request->tax[$key] ?? 0,
                    'tax_amount' => $request->tax_amount[$key] ?? 0.00,
                ]);

                if ('received' == $request->status) {
                    $items = ItemPrice::where('id', $values)->first();
                    if ($items) {
                        $old_stock = $items->stock;
                        $current_stock = $request->qty[$key] + $items->stock;
                        $finalTotalCostPrice = $items->total_cost_price + $request->total_price[$key];
                        $finalCostPrice = $finalTotalCostPrice / $current_stock;

                        ItemPrice::where('id', $values)->update([
                            'stock' => $current_stock,
                            'cost_price' => $finalCostPrice,
                            'total_cost_price' => $finalTotalCostPrice,
                            'edit_cost_price' =>  1,
                        ]);

                        DB::table('stock_management_history')->insert([
                            'user_id' => auth()->user()->id,
                            'item_id' => $request->item_id[$key],
                            'item_price_id' => $values,
                            'action_type' => 'add',
                            'open_stock' => $old_stock,
                            'stock_value' => $request->qty[$key],
                            'closing_stock' => $current_stock,
                            'date_added' => $dateAdded,
                            'reference_no' => $purchase_item_id,
                            'reference_key' => 'Purchase Order',
                            'shop_id' => $request->branch_id,
                            'cost_price' => $finalCostPrice,
                            'total_cost_price' => $finalTotalCostPrice
                        ]);
                    }
                }

                $tax_amount += $request->tax_amount[$key] ?? 0;
                $total_amount += $request->total_price[$key];
            }
            $total_amount -= $total_discount;

            Purchase::where('id', $request->id)->update([
                'supplier_id' => $request->supplier_id,
                'supplier_name' => supplierByID($request->supplier_id)->supplier_name,
                'invoice_no' => $request->invoice_no,
                'status' => $request->status,
                'tax_amount' => $tax_amount,
                'total_amount' => $total_amount,
                'discount' => $discount,
                'total_discount' => $total_discount,
                'payment_status' => 'un_paid', //$request->payment_status,
                'date_added' => $dateAdded,
            ]);

            return $this->sendResponse(1, 'Purchase Updated', '', '');
        } else {
            // Create new purchase logic
            if (!(checkUserPermission('purchase_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/purchase'));
            }

            $price_id = $request->price_id;

            if ($price_id == null) {
                return $this->sendResponse(0, 'Please add item', '', '');
            }

            $purchase_id = Purchase::insertGetId([
                'supplier_id' => $request->supplier_id,
                'supplier_name' => supplierByID($request->supplier_id)->supplier_name,
                'invoice_no' => $request->invoice_no,
                'status' => $request->status,
                'tax_amount' => $request->vat_amt ?? 0,
                'total_amount' => 0, // Temporarily set total to 0, will calculate below
                'discount' => $discount,
                'total_discount' => $total_discount,
                'payment_status' => 'un_paid', //$request->payment_status,
                'user_id' => auth()->user()->id,
                'shop_id' => $request->branch_id,
                'uuid' => Str::uuid(),
                'created_at' => $dateAdded,
                'date_added' => $dateAdded,
            ]);

            $tax_amount = $total_amount = 0;

            foreach ($price_id as $key => $values) {
                if (
                    !isset($values) || !isset($request->item_id[$key]) || !isset($request->item_name[$key]) ||
                    !isset($request->qty[$key]) || !isset($request->cost_price[$key]) || !isset($request->total_price[$key])
                ) {
                    continue;
                }

                $purchase_item_id = DB::table('purchase_order_items')->insertGetId([
                    'purchase_id' => $purchase_id,
                    'price_id' => $values,
                    'item_id' => $request->item_id[$key],
                    'product_name' => $request->item_name[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->cost_price[$key],
                    'total_amount' => $request->total_price[$key],
                    'discount' => $request->discount[$key] ?? 0,
                    'tax' => $request->tax[$key] ?? 0,
                    'tax_amount' => $request->tax_amount[$key] ?? 0.00,
                ]);

                $tax_amount += $request->tax_amount[$key] ?? 0;
                $total_amount += $request->total_price[$key];

                if ('received' == $request->status) {
                    $items = ItemPrice::where('id', $values)->first();
                    if ($items) {
                        $old_stock = $items->stock;
                        $current_stock = $request->qty[$key] + $items->stock;
                        $finalTotalCostPrice = $items->total_cost_price + $request->total_price[$key];
                        $finalCostPrice = $finalTotalCostPrice / $current_stock;

                        ItemPrice::where('id', $values)->update([
                            'stock' => $current_stock,
                            'cost_price' => $finalCostPrice,
                            'total_cost_price' => $finalTotalCostPrice,
                            'edit_cost_price' =>  1,
                        ]);

                        DB::table('stock_management_history')->insert([
                            'user_id' => auth()->user()->id,
                            'item_id' => $request->item_id[$key],
                            'item_price_id' => $values,
                            'action_type' => 'add',
                            'open_stock' => $old_stock,
                            'stock_value' => $request->qty[$key],
                            'closing_stock' => $current_stock,
                            'date_added' => $dateAdded,
                            'reference_no' => $purchase_item_id,
                            'reference_key' => 'Purchase Order',
                            'shop_id' => $request->branch_id,
                            'cost_price' => $finalCostPrice,
                            'total_cost_price' => $finalTotalCostPrice
                        ]);
                    }
                }
            }

            $total_amount -= $total_discount;

            Purchase::where('id', $purchase_id)->update([
                'total_amount' => $total_amount,
                'tax_amount' => $tax_amount,
            ]);

            return $this->sendResponse(1, 'Purchase Added', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase, Request $request)
    {
        if (!(checkUserPermission('purchase_edit'))) {
            return view('Helper.unauthorized_access');
        }
        $branch_id = $request->shop;
        $items = Item::leftJoin('item_prices', function ($join) {
            $join->on('items.id', '=', 'item_prices.item_id');
        })->leftJoin('price_size', function ($joins) {
            $joins->on('item_prices.price_size_id', '=', 'price_size.id');
        })->where('items.branch_id', $branch_id)
            ->where('items.stock_applicable', '1')
            // ->where('items.ingredient', '0')
            // ->where('items.active', 'yes')
            // ->where('item_prices.price', '>', 0)
            ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name'))
            ->get();

        $purchse_items = DB::table('purchase_order_items')->where('purchase_id', $purchase->id)->get();
        return view('Admin.Model.purchaseModel', compact('purchase', 'items', 'purchse_items'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        if (!(checkUserPermission('purchase_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/purchase'));
        }
        $result = $purchase->delete();
        if ($result) {
            return $this->sendResponse(1, 'Purchase Deleted succussfully', '', url('admin/purchase'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/purchase'));
        }
    }

    public function change_status(Request $request)
    {
        $purchase_id = $request->purchase_id;
        $status = $request->status;
        if ($purchase_id) {
            Purchase::where('id', $purchase_id)->update([
                'payment_status' => $status
            ]);
            return 'success';
        } else {
            return 'failed';
        }
    }

    public function change_purchase_status(Request $request)
    {
        $purchase_id = $request->purchase_id;
        $branch_id = $request->shop_id;
        $status = $request->status;
        if ($purchase_id) {
            Purchase::where('id', $purchase_id)->update([
                'status' => $status
            ]);

            if ('received' == $request->status) {
                $purchase_items = DB::table('purchase_order_items')->where('purchase_id', $purchase_id)->get();
                foreach ($purchase_items as $values) {

                    $items = ItemPrice::where('id', $values->price_id)->first();
                    $old_stock = $items->stock;
                    $current_stock = $values->qty + $items->stock;
                    $finalTotalCostPrice = $items->total_cost_price + $values->total_amount;
                    $finalCostPrice = $finalTotalCostPrice / $current_stock;

                    ItemPrice::where('id', $values->price_id)->update([
                        'stock' => $current_stock,
                        'cost_price' => $finalCostPrice,
                        'total_cost_price' => $finalTotalCostPrice,
                        'edit_cost_price' =>  1,
                    ]);

                    DB::table('stock_management_history')->insert([
                        'user_id' => auth()->user()->id,
                        'item_id' => $values->item_id,
                        'item_price_id' => $values->price_id,
                        'action_type' => 'add',
                        'open_stock' => $old_stock,
                        'stock_value' => $values->qty,
                        'closing_stock' => $current_stock,
                        'date_added' => date("Y-m-d H:i:s"),
                        'reference_no' => $values->id,
                        'reference_key' => 'Purchase Order',
                        'shop_id' =>  $branch_id,
                        'cost_price' => $finalCostPrice,
                        'total_cost_price' => $finalTotalCostPrice
                    ]);
                }
            }
            return 'success';
        } else {
            return 'failed';
        }
    }    public function updatePaymentStatus(Request $request)
    {
        // Validate that purchase_ids exist
        $validatedData = $request->validate([
            'purchase_ids' => 'required|array|min:1',
            'purchase_ids.*' => 'exists:purchase_orders,id', // Ensure each ID exists in the 'purchase_orders' table
        ]);

        // Update the payment status to 'paid' for the selected purchases
        Purchase::whereIn('id', $request->purchase_ids)->update([
            'payment_status' => 'paid'
        ]);

        // Return a response to indicate success
        return response()->json(['message' => 'Payment status updated successfully!'], 200);
    }
    // PurchaseController.php
    // PurchaseController.php
    public function show(Request $request, $id)
    {
        // Log the request to help with debugging
        // Log::info('Fetching recent purchase items for purchase ID: ' . $id);

        try {
            // Fetch purchase items directly from the purchase_order_items table using the correct purchase_id
            $item_list = DB::table('purchase_order_items')
                ->where('purchase_id', $id) // Ensure this is your actual foreign key
                ->select('id', 'product_name', 'qty', 'unit_price', 'tax', 'tax_amount', 'total_amount') // Updated column names
                ->orderBy('id', 'desc')
                ->get();

            // Log the fetched items for debugging
            // Log::info('Fetched purchase items: ', $item_list->toArray());

            // Return the view with the fetched items
            return view('Admin.Model.items-list', compact('item_list'));
        } catch (\Exception $e) {
            Log::error('Error fetching purchase items:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return a JSON response with a detailed error message for debugging (not for production)
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage(),   // Show the error message in response
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function purchasePay(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'purchase_id' => 'required',
            'payment_type' => 'required',
            'amount' => 'required|numeric|gt:0',
            'total_amount' => 'required',
            'balance' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        $payment_status = 'partial_paid';
        if ($request->total_amount == ($request->amount + ($request->total_amount - $request->balance))) {
            $payment_status = 'paid';
        }

        $purchase = Purchase::find($request->purchase_id);

        if ($purchase) {

            Purchase::where('id', $request->purchase_id)->update([
                'paid_amount' => $purchase->paid_amount + $request->amount,
                'payment_status' => $payment_status,
            ]);

            DB::table('purchase_pay_log')->insert([
                'branch_id' => $purchase->shop_id,
                'purchase_id' => $request->purchase_id,
                'payment_type' => $request->payment_type,
                'price' => $request->amount,
                'created_at' => now(),
            ]);

            event(new PaymentTransactionEvent(
            type: 'sub',
            amount: $request->amount,
            refNo: $request->purchase_id,
            paymentType: $request->payment_type,
            status: 'purchase',
            branchId: $purchase->shop_id,
        ));

        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/purchase'));
        }


        return $this->sendResponse(1, 'Payment Paid Success', '', '');
    }

    public function purchasePayMultiple(Request $request)
    {
        // Debugging: Log the incoming request
        Log::info($request->all()); // Check what is being sent

        // Validate the incoming data
        $validation = Validator::make($request->all(), [
            'purchase_id' => 'required|array',
            'purchase_id.*' => 'required|exists:purchase_orders,id',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|gt:0',
            'total_amount' => 'required|array',
            'total_amount.*' => 'required|numeric',
            'balance' => 'required|array',
            'balance.*' => 'required|numeric',
            'payment_type' => 'required|array',
            'payment_type.*' => 'required|string',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        // Loop through each purchase in the request data
        foreach ($request->purchase_id as $purchaseId) {
            // Retrieve the purchase using DB facade
            $purchase = DB::table('purchase_orders')->where('id', $purchaseId)->first();

            if (!$purchase) {
                continue; // Skip if the purchase ID is not found
            }

            // Check if the purchase is paid; if so, skip further processing
            if ($purchase->payment_status === 'paid') {
                continue; // Skip if the purchase is already fully paid
            }

            $amount = $request->amount[$purchaseId];
            $totalAmount = $request->total_amount[$purchaseId];
            $balance = $request->balance[$purchaseId];
            $paymentType = $request->payment_type[$purchaseId];

            // Determine the payment status
            $paymentStatus = 'partial_paid';
            if ($totalAmount == ($amount + ($totalAmount - $balance))) {
                $paymentStatus = 'paid';
            }

            // Update the purchase payment details
            DB::table('purchase_orders')->where('id', $purchaseId)->update([
                'paid_amount' => $purchase->paid_amount + $amount,
                'payment_status' => $paymentStatus,
            ]);

            // Insert a record in the payment log
            DB::table('purchase_pay_log')->insert([
                'branch_id' => $purchase->shop_id,
                'purchase_id' => $purchaseId,
                'payment_type' => $paymentType,
                'price' => $amount,
                'created_at' => now(),
            ]);
        }

        // Return a JSON response without redirecting
        return response()->json([
            'status' => 1,
            'message' => 'Payments processed successfully',
            'response' => '',
        ]);
    }
    public function getItemByBarcode(Request $request)
    {
        $barcode = $request->input('barcode');

        $item = DB::table('item_prices')
            ->join('items', 'item_prices.item_id', '=', 'items.id')
            ->leftJoin('price_size', 'item_prices.price_size_id', '=', 'price_size.id')
            ->where('item_prices.barcode', $barcode) // Ensure barcode exists in item_prices
            ->where('items.stock_applicable', '1')
            ->where('items.ingredient', '0')
            ->select(
                'items.id as item_id',
                'items.item_name',
                'item_prices.id as price_id',
                'item_prices.price_size_id',
                'item_prices.price',
                'item_prices.stock as item_stock',
                'item_prices.cost_price as item_price_cost_price',
                'price_size.size_name'
            )
            ->first();

        if ($item) {
            return response()->json(['status' => 1, 'data' => $item]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Item not found.']);
        }
    }
}
