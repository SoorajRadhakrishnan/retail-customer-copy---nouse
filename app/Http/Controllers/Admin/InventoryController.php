<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ItemPrice;
use App\Models\Admin\Item;
use App\Models\Admin\Customer;
use DB;
// use Illuminate\Validation\Rule;
use App\Traits\ResponseTraits;
use Illuminate\Support\Facades\Log;
class InventoryController extends Controller
{
    use ResponseTraits;
    public function index(Request $request)
    {

     $item_type = $request->item_type;
        $price_id = $request->price_id;
        $category_id = $request->category_id;
        $barcode = $request->barcode; // Get the barcode from the request

        $branch_id = $this->getBranchId();

        $items = ItemPrice::from('item_prices')
            ->leftJoin('items as i', function ($join) {
                $join->on('i.id', '=', 'item_prices.item_id');
            })
            ->leftJoin('categories as c', function ($join) {
                $join->on('c.id', '=', 'i.category_id');
            })
            ->select(['item_prices.*', 'i.stock_applicable'])
            ->when($branch_id, function ($query) use ($branch_id) {
                $query->where('item_prices.branch_id', $branch_id);
            })
            ->when($item_type, function ($query) use ($item_type) {
                $query->where('item_prices.price_item_type', $item_type);
            })
            ->when($price_id, function ($query) use ($price_id) {
                $query->where('item_prices.id', $price_id);
            })
            ->when($category_id, function ($query) use ($category_id) {
                $query->where('c.id', $category_id);
            })
            ->when($barcode, function ($query) use ($barcode) {
                $query->where('item_prices.barcode', $barcode);
            })
            ->orderBy('item_prices.id', 'desc')
            ->get();

        if ($request->ajax()) {
            return view('Admin.partials.inventory_items', compact('items'))->render();
        }

        $itemList = ItemPrice::leftJoin('items', function ($join) {
            $join->on('item_prices.item_id', '=', 'items.id');
        })
        ->leftJoin('price_size', function ($join) {
            $join->on('price_size.id', '=', 'item_prices.price_size_id');
        })
        ->leftJoin('units', function ($join) {
            $join->on('units.id', '=', 'items.unit_id');
        })
        ->when($branch_id, function ($query, $branch_id) {
            $query->where('items.branch_id', $branch_id);
        })
        ->select(DB::raw('item_prices.id as price_id, items.item_name, items.id as item_id, price_size.size_name, item_prices.stock, items.unit_id, units.unit_name'))
        ->whereNull('items.deleted_at')
        ->whereNull('item_prices.deleted_at')
        ->get();

        $categories = categoryList($branch_id);
        $customers = Customer::where('branch_id', $branch_id)->get();
// dd($itemList);
        return view('Admin.inventory', compact('items', 'item_type', 'price_id', 'itemList', 'categories', 'category_id', 'barcode', 'customers'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $branch_id = $request->branch_id;
        $user_id = $request->user_id;
        $customer_id = $request->customer;
        $quantities = $request->qty;
        $stocks = $request->stock;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Loop through each item and store in inventory_log
            foreach ($quantities as $item_id => $qty) {
                // Get the current stock for the item
                $item_price = ItemPrice::find($item_id);
                if ($item_price) {
                    $open_stock = $item_price->stock;

                    // Insert into inventory_log table
                    $log_id = DB::table('inventory_log')->insertGetId([
                        'branch_id' => $branch_id,
                        'user_id' => $user_id,
                        'customer_id' => $customer_id,
                        'item_id' => $item_id,
                        'qty' => $qty,
                        'open_stock' => $open_stock,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Set the stock to the new quantity
                    $item_price->stock += $qty;
                    $item_price->save();

                    // Update the closing stock in the inventory_log table
                    DB::table('inventory_log')->where('id', $log_id)->update([
                        'closing_stock' => $item_price->stock,
                    ]);

                    // Determine the action type based on the comparison of qty and open_stock
                    $action_type = $qty >= $open_stock ? 'add' : 'sub';

                    // Insert into stock_management_history table
                    DB::table('stock_management_history')->insert([
                        'user_id' => auth()->user()->id,
                        'item_id' => $item_price->item_id,
                        'item_price_id' => $item_price->id,
                        'action_type' => $action_type, // Dynamic action type
                        'open_stock' => $open_stock,
                        'stock_value' => $qty,
                        'closing_stock' => $item_price->stock,
                        'date_added' => now(),
                        'reference_no' => $log_id,
                        'reference_key' => 'Stock adjustment',
                        'shop_id' => $this->getBranchId(),
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Inventory updated successfully');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error
            Log::error('Error updating inventory: ' . $e->getMessage(), [
                'branch_id' => $branch_id,
                'user_id' => $user_id,
                'customer_id' => $customer_id,
                'quantities' => $quantities,
                'exception' => $e,
            ]);

            return redirect()->back()->with('error', 'An error occurred while updating the inventory. Please try again.');
        }
    }

    public function barcode_search(Request $request)
    {
        $item_search = $request->barcode;
        if ($item_search) {
            $query = Item::leftJoin('item_prices', function ($join) {
                $join->on('items.id', '=', 'item_prices.item_id');
            })
            ->leftJoin('categories', function ($joins) {
                $joins->on('items.category_id', '=', 'categories.id');
            })
            ->leftJoin('price_size', function ($joins) {
                $joins->on('item_prices.price_size_id', '=', 'price_size.id');
            })
            ->leftJoin('units', function ($joins) {
                $joins->on('items.unit_id', '=', 'units.id');
            })
            ->where('items.branch_id', auth()->user()->branch_id)
            ->where('items.active', 'yes')
            ->select(DB::raw('items.*, item_prices.id as price_id, item_prices.item_id, item_prices.price_size_id, item_prices.price, item_prices.stock as item_stock, item_prices.cost_price as item_price_cost_price, categories.category_slug, price_size.size_name, units.unit_name'))
            ->where('item_prices.barcode', $item_search);

            $items = $query->limit(1)->get();
// dd($items);
            // Map the results to modify the price field
            $items = $items->map(function ($item) use ($request) {
                if ($request->service != 'normal' && $request->type == 'delivery' && isset($item->delivery_service_price)) {
                    $item->price = $item->delivery_service_price;
                } else {
                    $item->price = $item->price;
                }
                return $item;
            });

            return response()->json(['data' => $items]);
        }
    }
}
