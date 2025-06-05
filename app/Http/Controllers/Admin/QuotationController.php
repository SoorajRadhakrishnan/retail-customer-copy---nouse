<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};
use App\Traits\ResponseTraits;
use App\Models\Admin\Item;
use Illuminate\Validation\Rule;
use App\Models\Admin\Customer;
use Illuminate\Support\Str;


class QuotationController extends Controller
{
    use ResponseTraits;
    public function index(Request $request)
    {
        $branch_id = auth()->user()->branch_id; // Get the branch ID from the authenticated user

        // Date filter logic
        $from_date = $request->input('from_date') ?: date('Y-m-d');
        $to_date = $request->input('to_date') ?: date('Y-m-d');

        $quotations = DB::table('quotations')
            ->where('branch_id', $branch_id)
            ->whereNull('deleted_at')
            ->whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->get();

        // ...existing code...
        return view('Admin.quotation', compact('quotations'));
    }
    public function create(Request $request)
    {
        $branch_id = $request->shop;
        $quotation = $purchse_items = null;
        $items = Item::leftJoin('item_prices', function ($join) {
            $join->on('items.id', '=', 'item_prices.item_id');
        })->leftJoin('price_size', function ($joins) {
            $joins->on('item_prices.price_size_id', '=', 'price_size.id');
        })->where('items.branch_id', $branch_id)
            ->where('items.stock_applicable', '1')
            ->where('items.ingredient', '0')
            // ->where('items.active', 'yes')
            // ->where('item_prices.price', '>', 0)
            ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name'))
            ->get();
        // dd($items); // Debugging line to check the fetched items
        return view('Admin.Model.quotationmodel', compact('items', 'branch_id', 'quotation', 'purchse_items'));
    }
    public function store(Request $request)
    {
        // Remove debug line
        // dd($request->all());

        $validation = Validator::make($request->all(), [
            'branch_id' => 'required',
            'customer_id' => 'required',
            // 'quotation_no' => 'required|string',
            'quotation_date' => 'nullable|date',
            'price_id.*' => 'required|integer',
            'item_id.*' => 'required|integer',
            'item_name.*' => 'required|string',
            'qty.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric',
            'total_price.*' => 'required|numeric',
            'discount' => 'nullable|array',
            'total_discount' => 'nullable|numeric',
            'tax.*' => 'nullable|numeric',
            'tax_amount.*' => 'nullable|numeric',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        $price_id = $request->price_id;

        if ($price_id == null) {
            return $this->sendResponse(0, 'Please add item', '', '');
        }

        // Generate unique qout_id (UUID or custom)
        $qout_id = Str::uuid()->toString();

        // Calculate totals
        $total_price = array_sum($request->total_price);
        $total_discount = $request->total_discount ?? 0;
        $total_vat = array_sum($request->tax_amount);

        // Insert into quotations table
        $quotationId = DB::table('quotations')->insertGetId([
            'branch_id'      => $request->branch_id,
            'uuid'        => $qout_id,
            'quotation_no'   => getNextQuotationId(),
            'customer_id'    => $request->customer_id,
            'total_price'    => $total_price,
            'total_discount' => $total_discount,
            'total_vat'      => $total_vat,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Insert items into quotation_items table
        foreach ($request->item_id as $i => $item_id) {
            $category_id = DB::table('items')->where('id', $item_id)->value('category_id');
            $price_size_id = DB::table('item_prices')->where('id', $request->price_id[$i])->value('price_size_id');

            DB::table('quotation_items')->insert([
                'qout_id'         => $quotationId, // Use the integer ID from quotations table
                'category_id'     => $category_id,
                'item_id'         => $item_id,
                'price_id'         => $request->price_id[$i],
                'price_size_id'   => $price_size_id,
                'item_name'       => $request->item_name[$i],
                'other_item_name' => null,
                'item_type'       => 1,
                'stock_applicable' => '1',
                'price'           => $request->unit_price[$i],
                'item_unit_price' => $request->unit_price[$i],
                'qty'             => $request->qty[$i],
                'discount'        => $request->discount[$i] ?? 0,
                'tax_amt'         => $request->tax_amount[$i] ?? 0,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Quotation Created Successfully',
            'redirect_to' => url('admin/quotation')
        ]);
    }
    public function show($id)
    {
        // dd($id); // Debugging line to check the ID

        // dd($request->all()); // Debugging line to check the request data
        $item_list = DB::table('quotation_items')->where('qout_id', $id)->orderBy('id', 'desc')->get();
        // dd($item_list); // Debugging line to check the fetched items
        return view('Counter.Model.recent_items', compact('item_list'));
        // return view('admin.quotations.show', compact('id'));
    }
    public function destroy($id)
    {
        // Soft delete the quotation
        DB::table('quotations')->where('id', $id)->update([
            'deleted_at' => now(),
        ]);

        // Soft delete all related quotation_items
        DB::table('quotation_items')->where('qout_id', $id)->update([
            'deleted_at' => now(),
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Quotation deleted successfully',
            'redirect_to' => url('admin/quotation')
        ]);
    }


    public function customersave(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_number' => [
                'required',
                Rule::unique('customers')
                    ->whereNull('deleted_at')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    }),
            ],
            'branch_id' => 'required',
        ]);

        // If validation fails, return errors
        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        // Check permission to create a customer
        if (!checkUserPermission('customer_create')) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/customer'));
        }

        // Create a new customer
        $customer = Customer::create([
            'customer_name' => $request->customer_name,
            'customer_number' => $request->customer_number,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'customer_gender' => $request->customer_gender,
            'branch_id' => $request->branch_id,
            'uuid' => Str::uuid(),
        ]);

        // Return a success response with the created customer details
        return response()->json([
            'status' => 1,
            'message' => 'Customer Created',
            'id' => Customer::where('customer_name', $request->customer_name)->first()->id,
            'name' => Customer::where('customer_name', $request->customer_name)->first()->customer_name
        ]);
    }
    public function printquote(Request $request)
    {
        // dd($request->all()); // Debugging line to check the request data
        // dd($id); // Debugging line to check the ID
        $id = $request->id; // Get the quotation ID from the request
        // Fetch the quotation details
        $quotation = DB::table('quotations')->where('id', $id)->first();
        if (!$quotation) {
            return redirect()->back()->with('error', 'Quotation not found.');
        }

        // Fetch the items associated with the quotation
        $items = DB::table('quotation_items')->where('qout_id', $id)->get();

        // Return the view for printing the quotation
        return view('Admin.quote_print', compact('quotation', 'items'));
    }
}
