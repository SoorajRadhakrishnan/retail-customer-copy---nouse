<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ingredient;
use App\Models\Admin\Item;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('production'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $branch_id = $this->getBranchId();
        $item_id = $request->input('item_id');  // Get selected item ID from request

        $items = Item::leftJoin('item_prices', function ($join) {
                $join->on('items.id', '=', 'item_prices.item_id');
            })
            ->leftJoin('price_size', function ($joins) {
                $joins->on('item_prices.price_size_id', '=', 'price_size.id');
            })
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('items.branch_id', $branch_id);
            })
            ->when($item_id, function ($query, $item_id) {
                $query->where('items.id', $item_id);  // Filter by item_id if provided
            })
            ->where('items.stock_applicable', '1')
            ->where('items.item_type', '1')
            ->where('items.ingredient', '1')
            ->select(DB::raw('items.*, item_prices.id as price_id, item_prices.item_id, item_prices.price_size_id, item_prices.price, item_prices.stock as item_stock, item_prices.cost_price as item_price_cost_price, price_size.size_name'))
            ->orderBy('items.item_name', 'asc')
            ->get();

        // Pass the selected item_id and the items list to the view
        return view('Admin.item_ingredient', compact('items', 'item_id'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('production'))) {
            return view('Helper.unauthorized_access');
        }
        $item_price_id = $request->id;
        $branch_id = $request->branch;
        $ingredient = Ingredient::where('main_item_id', $request->id)->get();
        $items = Item::leftJoin('item_prices', function ($join) {
            $join->on('items.id', '=', 'item_prices.item_id');
        })->leftJoin('price_size', function ($joins) {
            $joins->on('item_prices.price_size_id', '=', 'price_size.id');
        })->where('items.branch_id', $branch_id)
            ->where('items.stock_applicable', '1')
            ->where('items.item_type', '2')
            // ->where('items.active', 'yes')
            ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name'))
            ->get();
        return view('Admin.Model.ingredientModel', compact('ingredient','items', 'item_price_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $price_id = $request->price_id;
        if(!(checkUserPermission('production')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/ingredient'));
        }

        if($price_id == null){
            return $this->sendResponse(0,'Please add item','','');
        }

        Ingredient::where('main_item_id',$request->id)->delete();

        $price_id = $request->price_id;
        foreach($price_id as $key => $values)
        {
            if($request->qty[$key] != null && $request->qty[$key] > 0) {
                Ingredient::create([
                    'main_item_id' => $request->id,
                    'qty' => $request->qty[$key],
                    'unit' => $request->unit[$key],
                    'item_name' => $request->item_name[$key],
                    'price_id' => $values,
                    'item_id' => $request->item_id[$key],
                    'user_id' => auth()->user()->id,
                    'branch_id' => $request->branch_id,
                ]);
                ItemPrice::where('id',$request->id)->update(['ingredient_added' => 1]);
            }
        }

        return $this->sendResponse(1,'Ingredient Added success','','');
    }
}
