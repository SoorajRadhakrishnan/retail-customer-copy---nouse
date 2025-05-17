<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\DB;

class StockAddController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('stock_add'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $item_type = $request->item_type;
        $price_id = $request->price_id;
        $category_id = $request->category_id;

        $branch_id = $this->getBranchId();

        $items = ItemPrice::from('item_prices')
            ->leftJoin('items as i', function ($join) {
                $join->on('i.id', '=', 'item_prices.item_id');
            })->leftJoin('categories as c', function ($join) {
                $join->on('c.id', '=', 'i.category_id');
            })->select(['item_prices.*', 'stock_applicable'])->when($branch_id, function ($query, $branch_id) {
                $query->where('item_prices.branch_id', $branch_id);
            })->when($item_type, function ($query, $item_type) {
                $query->where('item_prices.price_item_type', $item_type);
            })->when(!$item_type, function ($query) {
                $query->whereIn('item_prices.price_item_type', ['1', '2']);
            })->when($price_id, function ($query, $price_id) {
                $query->where('item_prices.id', $price_id);
            })->when($category_id, function ($query, $category_id) {
                $query->where('c.id', $category_id);
            })->orderBy('item_prices.id', 'desc')->get();

        $itemList = getAllItem(auth()->user()->branch_id);
        $categories = categoryList($branch_id);
        return view('Admin.stock-add', compact('items', 'item_type', 'price_id', 'itemList', 'categories', 'category_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $cost_price_non_stock = $request->cost_price_non_stock;
        $stock_adds = $request->stock_add;
        $cost_prices = $request->cost_price;

        if ($stock_adds == null) {
            return redirect('admin/stock-add')->withMessage('Add stock');
        }

        foreach ($cost_prices as $keys => $values) {
            $stock = $stock_adds[$keys];
            if ($values && $stock > 0) {
                $itemsPrice = ItemPrice::where('id', $keys)->first();
                $old_stock = $itemsPrice->stock;
                if ($old_stock > 0) {
                    $current_stock = $stock + $old_stock;
                    $totalAmount = $stock * $values;
                    $finalTotalCostPrice = $itemsPrice->total_cost_price + $totalAmount;
                    $finalCostPrice = $finalTotalCostPrice / $current_stock;
                } else {
                    $current_stock = $old_stock + $stock;
                    $finalCostPrice = $values;
                    $finalTotalCostPrice = $values * $current_stock;

                    if ($current_stock <= 0) {
                        $finalTotalCostPrice = 0;
                    }
                }

                $itemsPrice->update([
                    'stock' => $current_stock,
                    'cost_price' => $finalCostPrice,
                    'total_cost_price' => $finalTotalCostPrice,
                ]);

                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $itemsPrice->item_id,
                    'item_price_id' => $keys,
                    'action_type' => 'add',
                    'open_stock' => $old_stock,
                    'stock_value' => $stock,
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => null,
                    'reference_key' => 'Direct Stock Update',
                    'shop_id' =>  $request->branch_id,
                    'cost_price' => $finalCostPrice,
                    'total_cost_price' => $finalTotalCostPrice
                ]);
            } else if ($stock < 0) {

                $itemsPrice = ItemPrice::where('id', $keys)->first();
                $old_stock = $itemsPrice->stock;
                $stock_reaming = $itemsPrice->stock - abs($stock);
                $item_cost_price = $itemsPrice->cost_price;
                $finalCostPrice = $item_cost_price * $stock_reaming;
                if ($stock_reaming <= 0) {
                    $finalCostPrice = 0;
                }

                $itemsPrice->update([
                    'stock' => $stock_reaming,
                    'total_cost_price' =>  $finalCostPrice,
                ]);

                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $itemsPrice->item_id,
                    'item_price_id' => $keys,
                    'action_type' => 'sub',
                    'open_stock' => $old_stock,
                    'stock_value' => abs($stock),
                    'closing_stock' => $stock_reaming,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => null,
                    'reference_key' => 'Direct Stock Update',
                    'shop_id' =>  $request->branch_id,
                    'cost_price' => $item_cost_price,
                    'total_cost_price' => $finalCostPrice
                ]);
            }
        }

        if (!empty($cost_price_non_stock)) {
            foreach ($cost_price_non_stock as $key => $value) {
                if ($value) {
                    ItemPrice::where('id', $key)->update([
                        'cost_price' => $value,
                        'total_cost_price' => $value,
                    ]);
                }
            }
        }

        return redirect('admin/stock-add')->withMessage('Stock Updated');
    }
}
