<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\DB;

class ItemStockController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('manage_stocks'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $item_type = $request->item_type;
        $price_id = $request->price_id;
        $category_id = $request->category_id;

        $branch_id = $this->getBranchId();

        $items = ItemPrice::from('item_prices')
                ->leftJoin('items as i', function ($join) {
                    $join->on('i.id', '=', 'item_prices.item_id');
                })
                ->leftJoin('categories as c', function ($join) {
                    $join->on('c.id', '=', 'i.category_id');
                })
                ->select('item_prices.*')
                ->when($branch_id, function ($query, $branch_id) {
                    $query->where('item_prices.branch_id', $branch_id);
                })
                ->when($item_type, function ($query, $item_type) {
                    $query->where('item_prices.price_item_type', $item_type);
                })
                ->when($price_id, function ($query, $price_id) {
                    $query->where('item_prices.id', $price_id);
                })
                ->when($category_id, function ($query, $category_id) {
                    $query->where('c.id', $category_id);
                })
                ->where('i.stock_applicable', '1') // Filter only where stock_applicable is 1
                ->orderBy('item_prices.id', 'desc')
                ->get();

        $itemList = getAllItem(auth()->user()->branch_id);
        $categories = categoryList($branch_id);

        return view('Admin.stock', compact('items', 'item_type', 'price_id', 'itemList', 'categories', 'category_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $old_stocks = $request->old_stock;
        $stock_adds = $request->stock_add;
        $cost_prices = $request->cost_price;

        if($stock_adds == null)
        {
            return redirect('admin/stock')->withMessage('Add Item to Update Stock');
        }

        foreach($stock_adds as $key => $value)
        {
            if($value)
            {
                $latest_stock = $old_stocks[$key] + $value;
                ItemPrice::where('id',$key)->update([
                    'stock' => $latest_stock,
                ]);

                if ($value > 0) {
                    $action_type =  "add";
                } else {
                    $action_type =  "sub";
                }
                $items = ItemPrice::where('id',$key)->first();
                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $items->item_id,
                    'item_price_id' => $key,
                    'action_type' => $action_type,
                    'open_stock' => $old_stocks[$key],
                    'stock_value' => $value,
                    'closing_stock' => $latest_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => null,
                    'reference_key' => 'Stock Update',
                    'shop_id' =>  $request->branch_id
                ]);
            }
        }

        foreach($cost_prices as $keys => $values)
        {
            if($values)
            {
                ItemPrice::where('id',$keys)->update([
                    'cost_price' => $values,
                ]);
            }
        }

        return redirect('admin/stock')->withMessage('Stock Updated');
    }
}
