<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ingredient;
use App\Models\Admin\Item;
use App\Models\Admin\ItemPrice;
use App\Models\Admin\Production;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
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
        $items = Item::leftJoin('item_prices', function ($join) {
            $join->on('items.id', '=', 'item_prices.item_id');
        })->leftJoin('price_size', function ($joins) {
            $joins->on('item_prices.price_size_id', '=', 'price_size.id');
        })->when($branch_id, function ($query,$branch_id) {
            $query->where('items.branch_id',$branch_id);
        })->where('items.stock_applicable', '1')
            ->where('items.item_type', '1')
            ->where('items.ingredient', '1')
            // ->where('items.active', 'yes')
            ->where('item_prices.ingredient_added', '1')
            ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name'))
            ->get();


        return view('Admin.production', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(!(checkUserPermission('production')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/production'));
        }

        $price_id = $request->price_id;
        if($price_id == null){
            return $this->sendResponse(0,'Please add item','','');
        }

        foreach($price_id as $key => $value)
        {
            $qty = $request->qty[$key];
            if($qty != null && $qty > 0) {
                $production_id = Production::insertGetId([
                    'qty' => $qty,
                    'price_id' => $value,
                    'item_id' => $request->item_id[$key],
                    'user_id' => auth()->user()->id,
                    'branch_id' => $request->branch_id,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);

                $items = ItemPrice::where('id',$value)->first();
                $old_stock = $items->stock;
                $current_stock = $qty + $old_stock;

                ItemPrice::where('id',$value)->update([
                    'stock' => $current_stock,
                ]);

                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $request->item_id[$key],
                    'item_price_id' => $value,
                    'action_type' => 'add',
                    'open_stock' => $old_stock,
                    'stock_value' => $qty,
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => $production_id,
                    'reference_key' => 'Production',
                    'shop_id' =>  $request->branch_id
                ]);

                $ingredients = Ingredient::where('main_item_id', $value)->get();
                foreach($ingredients as $keys => $values)
                {
                    $items = ItemPrice::where('id',$values['price_id'])->first();
                    $old_stock_sub = $items->stock;
                    $current_stock_sub = $old_stock_sub - ($qty * $values['qty']);

                    ItemPrice::where('id',$values['price_id'])->update([
                        'stock' => $current_stock_sub,
                    ]);

                    DB::table('stock_management_history')->insert([
                        'user_id' => auth()->user()->id,
                        'item_id' => $values['item_id'],
                        'item_price_id' => $values['price_id'],
                        'action_type' => 'sub',
                        'open_stock' => $old_stock_sub,
                        'stock_value' => $qty * $values['qty'],
                        'closing_stock' => $current_stock_sub,
                        'date_added' => date("Y-m-d H:i:s"),
                        'reference_no' => $production_id,
                        'reference_key' => 'Production',
                        'shop_id' =>  $request->branch_id
                    ]);
                }
            }
        }
        // return redirect('admin/production');
        return $this->sendResponse(1,'Production Success','','');
    }
}
