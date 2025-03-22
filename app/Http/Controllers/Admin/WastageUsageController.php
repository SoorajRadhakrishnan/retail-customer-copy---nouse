<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Item;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class WastageUsageController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        // Check if wastage usage is allowed
        if (config('appSettings.wastage-usage') === 'no') {
            return redirect('admin/wastage-usage')->with('message', 'Unauthorized Access');
        }

        // Get filters from request
        $item_type = $request->item_type;
        $item_id = $request->item_id;
        $price_id = $request->price_id;
        $branch_id = $this->getBranchId();

        $items = ItemPrice::when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })
        ->when($item_type, function ($query) use ($item_type) {
            $query->where('price_item_type', $item_type);
        })
        ->when($item_id, function ($query) use ($item_id) {
            $query->where('item_id', $item_id);
        })
        ->orderBy('id', 'desc')
        ->get();

        // Get list of items for filters
        $itemList = getAllItem($branch_id);
      

        // Return view with data
        return view('Admin.wastage_usage', compact('items', 'item_type', 'price_id', 'itemList'));
    }


        public function store(Request $request)
    {
        // Validate request data
        $validation = Validator::make($request->all(), [
            'branch_id' => 'required|array',
            'price_id' => 'required|array',
            'item_id' => 'required|array',
            'wastage_qty' => 'nullable|array',
            'usage_qty' => 'nullable|array',
            'stock' => 'required|array', // Ensure stock is included
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // Check stock availability before transaction
        foreach ($request->item_id as $index => $itemId) {
            $wastage_qty = $request->wastage_qty[$index] ?? 0;
            $usage_qty = $request->usage_qty[$index] ?? 0;
            $total_qty = $wastage_qty + $usage_qty;

            // Check if the available stock is less than the total quantity
            if ($total_qty > $request->stock[$index] && app('appSettings')['wastage-usage-zero-stock']->value == 'no') {
                // Notify user of insufficient stock
                return redirect()->back()->with('notify2', 'There is not enough stock available for item ID: ' . $itemId);
            }
        }

        // Insert logic
        DB::transaction(function () use ($request) {
            $count = count($request->item_id);

            for ($i = 0; $i < $count; $i++) {
                $wastage_qty = $request->wastage_qty[$i] ?? 0;
                $usage_qty = $request->usage_qty[$i] ?? 0;
                $total_qty = $wastage_qty + $usage_qty;

                // Only insert if either wastage_qty or usage_qty is greater than 0
                if ($total_qty > 0) {
                    // Insert into wastage_usage table
                    DB::table('wastage_usage')->insert([
                        'user_id' => auth()->user()->id,
                        'branch_id' => $request->branch_id[$i],
                        'price_id' => $request->price_id[$i],
                        'item_id' => $request->item_id[$i],
                        'wastage_qty' => $wastage_qty,
                        'usage_qty' => $usage_qty,
                        'qty' => $total_qty,
                        'created_at' => now(),
                    ]);

                    // Insert into stock_management_history for usage
                    if ($usage_qty > 0) {
                        DB::table('stock_management_history')->insert([
                            'shop_id' => $request->branch_id[$i],
                            'user_id' => auth()->user()->id,
                            'item_id' => $request->item_id[$i],
                            'item_price_id' => $request->price_id[$i],
                            'action_type' => 'sub', // Decrease stock for usage
                            'reference_key' => 'usage',
                            'open_stock' => $request->stock[$i],
                            'closing_stock' => $request->stock[$i] - $usage_qty,
                            'stock_value' => $usage_qty,
                            'date_added' => now(),
                        ]);
                    }

                    // Insert into stock_management_history for wastage
                    if ($wastage_qty > 0) {
                        DB::table('stock_management_history')->insert([
                            'shop_id' => $request->branch_id[$i],
                            'user_id' => auth()->user()->id,
                            'item_id' => $request->item_id[$i],
                            'item_price_id' => $request->price_id[$i],
                            'action_type' => 'sub', // Decrease stock for wastage
                            'reference_key' => 'wastage',
                            'open_stock' => $request->stock[$i],
                            'closing_stock' => $request->stock[$i] - $wastage_qty,
                            'stock_value' => $wastage_qty,
                            'date_added' => now(),
                        ]);
                    }

                    // Update the stock of the item_prices table
                    DB::table('item_prices')
                        ->where('id', $request->price_id[$i])
                        ->decrement('stock', $total_qty); // Subtract the total quantity (wastage + usage)
                }
            }
        });

        return redirect('admin/wastage-usage')->with('message', 'Wastage Usage Added Successfully');
    }

        // Helper function to get the current stock of an item

    }
