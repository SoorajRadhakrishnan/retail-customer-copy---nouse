<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\{DB, Validator};

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

        $items = ItemPrice::from('item_prices')
            ->leftJoin('items as i', function ($join) {
                $join->on('i.id', '=', 'item_prices.item_id');
            })->select(['item_prices.*'])
            ->when($branch_id, function ($query) use ($branch_id) {
                $query->where('item_prices.branch_id', $branch_id);
            })
            ->when($item_type, function ($query) use ($item_type) {
                $query->where('item_prices.price_item_type', $item_type);
            })
            ->when($item_id, function ($query) use ($item_id) {
                $query->where('item_prices.item_id', $item_id);
            })->where('i.stock_applicable', 1)
            ->orderBy('item_prices.id', 'desc')
            ->get();

        // Get list of items for filters
        $itemList = getAllItem($branch_id);

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
                    $insertId = DB::table('wastage_usage')->insertGetId([
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

                        $itemPrice = ItemPrice::where('id', $request->price_id[$i])->first();
                        if ($itemPrice) {
                            $openStock = $itemPrice->stock;
                            $stock_reaming = $openStock - $usage_qty;
                            $item_cost_price = $itemPrice->cost_price;
                            $finalCostPrice = $item_cost_price * $stock_reaming;
                            if ($stock_reaming <= 0) {
                                $finalCostPrice = 0;
                            }

                            $itemPrice->update([
                                'stock' => $stock_reaming,
                                'total_cost_price' =>  $finalCostPrice,
                            ]);

                            DB::table('stock_management_history')->insert([
                                'shop_id' => $request->branch_id[$i],
                                'user_id' => auth()->user()->id,
                                'item_id' => $request->item_id[$i],
                                'item_price_id' => $request->price_id[$i],
                                'action_type' => 'sub', // Decrease stock for usage
                                'reference_no' => $insertId,
                                'reference_key' => 'usage',
                                'open_stock' => $openStock,
                                'closing_stock' => $stock_reaming,
                                'stock_value' => $usage_qty,
                                'date_added' => now(),
                                'cost_price' => $item_cost_price,
                                'total_cost_price' => $finalCostPrice
                            ]);
                        }
                    }

                    // Insert into stock_management_history for wastage
                    if ($wastage_qty > 0) {

                        $itemPrice = ItemPrice::where('id', $request->price_id[$i])->first();
                        if ($itemPrice) {
                            $openStock = $itemPrice->stock;
                            $stock_reaming = $openStock - $wastage_qty;
                            $item_cost_price = $itemPrice->cost_price;
                            $finalCostPrice = $item_cost_price * $stock_reaming;
                            if ($stock_reaming <= 0) {
                                $finalCostPrice = 0;
                            }

                            $itemPrice->update([
                                'stock' => $stock_reaming,
                                'total_cost_price' =>  $finalCostPrice,
                            ]);

                            DB::table('stock_management_history')->insert([
                                'shop_id' => $request->branch_id[$i],
                                'user_id' => auth()->user()->id,
                                'item_id' => $request->item_id[$i],
                                'item_price_id' => $request->price_id[$i],
                                'action_type' => 'sub', // Decrease stock for wastage
                                'reference_no' => $insertId,
                                'reference_key' => 'wastage',
                                'open_stock' => $openStock,
                                'closing_stock' => $stock_reaming,
                                'stock_value' => $wastage_qty,
                                'date_added' => now(),
                                'cost_price' => $item_cost_price,
                                'total_cost_price' => $finalCostPrice
                            ]);
                        }
                    }
                }
            }
        });

        return redirect('admin/wastage-usage')->with('message', 'Wastage Usage Added Successfully');
    }

}
