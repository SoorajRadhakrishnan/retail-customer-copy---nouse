<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemPrice;

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
                })->leftJoin('categories as c', function ($join) {
                    $join->on('c.id', '=', 'i.category_id');
                })->select(['item_prices.*','stock_applicable'])->when($branch_id, function ($query,$branch_id) {
                    $query->where('item_prices.branch_id',$branch_id);
                })->when($item_type, function ($query,$item_type) {
                    $query->where('item_prices.price_item_type',$item_type);
                })->when(!$item_type, function ($query) {
                    $query->whereIn('item_prices.price_item_type',['1', '2']);
                })->when($price_id, function ($query,$price_id) {
                    $query->where('item_prices.id',$price_id);
                })->when($category_id, function ($query,$category_id) {
                    $query->where('c.id',$category_id);
                })->orderBy('item_prices.id', 'desc')->get();

        $itemList = getAllItem(auth()->user()->branch_id);
        $categories = categoryList($branch_id);
        return view('Admin.stock', compact('items','item_type','price_id','itemList', 'categories', 'category_id'));
    }
}
