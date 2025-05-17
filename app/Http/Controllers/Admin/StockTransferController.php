<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\{Category, Item, ItemPrice, StockManage, StockManageItem, Unit};
use App\Models\{Branch, PriceSize};
use Illuminate\Support\Facades\{DB, Validator};

class StockTransferController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        if (!checkUserPermission('stock_transfer')) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $branch_id = $this->getBranchId();
        $stock_transfers = StockManage::where('manage_type', 'stock_transfer')
                            ->whereBetween('created_at', [$from_date, $to_date])
                            ->when($branch_id, function($query,$branch_id){
                                $query->where('destination_branch_id', $branch_id)
                                ->orWhere('source_branch_id', $branch_id);
                            })->latest()->get();

        // Return the view with the data
        return view('Admin.stock-transfer', compact('stock_transfers', 'branch_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('stock_transfer_create'))) {
            return view('Helper.unauthorized_access');
        }
        $branch_id = $request->shop;
        $stock_transfer = $transfer_items = null;
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

        $branches = Branch::when($branch_id,function($query, $branch_id){
                        $query->where('id','!=' ,$branch_id);
                    })->get();
        return view('Admin.Model.StockTransferModel', compact('stock_transfer', 'items', "transfer_items", "branches", "branch_id"));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validation = Validator::make($request->all(), [
            'source_branch_id' => 'required',
            'destination_branch_id' => 'required',
            'notes' => 'nullable|string',
            'transaction_date' => 'required|date',
            'price_id.*' => 'required|integer', // Validate each price_id
            'item_id.*' => 'required|integer',   // Validate each item_id
            'item_name.*' => 'required|string',   // Validate each item_name
            'qty.*' => 'required|integer|min:1',  // Validate each quantity
            'cost_price.*' => 'required|min:1',  // Validate each quantity
        ]);

        $validation->after(function ($validation) use ($request) {
            foreach ($request->input('qty', []) as $index => $qty) {
                if (is_null($qty)) {
                    $validation->errors()->add("qty{$index}", "All Qty Field is required.");
                }
            }
        });

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $customErrors = [];

            // Customize the barcode error keys
            foreach ($errors as $key => $messages) {
                if (strpos($key, 'qty.') === 0) {
                    // Change item_barcode.1 to item_barcode1
                    $newKey = preg_replace('/qty\.(\d+)/', 'qty$1', $key);
                    $customErrors[$newKey] = $messages;
                } else {
                    // Keep original error keys
                    $customErrors[$key] = $messages;
                }
            }
            return $this->sendResponse(0, '', $customErrors, '');
        }

        $price_id = $request->price_id;

        if ($price_id == null) {
            return $this->sendResponse(0, 'Please add item', '', '');
        }

        // Use the transaction_date from the request or default to now()
        $dateAdded = $request->transaction_date ? $request->transaction_date : date('Y-m-d');

        if ($request->id) {
            // Update existing purchase logic (untouched as requested)
            if (!(checkUserPermission('stock_transfer_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/stock-transfer'));
            }

            $manageItems = StockManageItem::where('stock_manage_id', $request->id)->get();

            foreach($manageItems as $item){

                $itemsPrice = ItemPrice::where('id', $item->item_price_id)->first();
                $old_stock = $itemsPrice->stock;
                if($old_stock > 0) {
                    $current_stock = $item->qty + $old_stock;
                    $totalAmount = $item->qty * $item->cost_price;
                    $finalTotalCostPrice = $itemsPrice->total_cost_price + $totalAmount;
                    $finalCostPrice = $finalTotalCostPrice / $current_stock;
                } else {
                    $current_stock = $old_stock + $item->qty;
                    $finalCostPrice = $item->cost_price;
                    $finalTotalCostPrice = $item->cost_price * $current_stock;

                    if($current_stock <= 0) {
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
                    'item_price_id' => $itemsPrice->id,
                    'action_type' => 'add',
                    'open_stock' => $old_stock,
                    'stock_value' => $item->qty,
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => $item->id,
                    'reference_key' => 'Stock Transfer Edit Stock Revert',
                    'shop_id' =>  $this->getBranchId(),
                    'cost_price' => $finalCostPrice,
                    'total_cost_price' => $finalTotalCostPrice
                ]);
            }


            DB::table('stock_manage_items')->where('stock_manage_id', $request->id)->delete();

            foreach ($price_id as $key => $values) {
                if (!isset($values) || !isset($request->item_id[$key]) || !isset($request->qty[$key])) {
                    continue;
                }
                // dd($request->all());
                $stockManageItem = StockManageItem::create([
                    'stock_manage_id' => $request->id,
                    'item_price_id' => $values,
                    'item_price_size_id' => $request->price_size_id[$key],
                    'item_id' => $request->item_id[$key],
                    'qty' => $request->qty[$key],
                    'cost_price' => $request->cost_price[$key],
                ]);

                $items = ItemPrice::where('id', $values)->first();
                $old_stock = $items->stock;
                $current_stock = $old_stock - $request->qty[$key];
                $item_cost_price = $items->cost_price;
                $finalCostPrice = $item_cost_price * $current_stock;
                if($current_stock <= 0) {
                    $finalCostPrice = 0;
                }

                ItemPrice::where('id', $items->id)->update([
                    'stock' => $current_stock,
                    'total_cost_price' => $finalCostPrice,
                ]);

                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $items->item_id,
                    'item_price_id' => $values,
                    'action_type' => 'sub',
                    'open_stock' => $old_stock,
                    'stock_value' => $request->qty[$key],
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => $stockManageItem->id,
                    'reference_key' => 'Stock Transfer Add',
                    'shop_id' =>  $request->source_branch_id,
                    'cost_price' => $item_cost_price,
                    'total_cost_price' => $finalCostPrice
                ]);
            }

            StockManage::where('id', $request->id)->update([
                'destination_branch_id' => $request->destination_branch_id,
                'notes' => $request->notes,
                'transaction_date' => $dateAdded,
            ]);

            return $this->sendResponse(1, 'Stock Transfer Updated', '', '');
        } else {
            // Create new purchase logic
            if (!(checkUserPermission('stock_transfer_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/stock-transfer'));
            }

            $transfer = StockManage::create([
                'created_user_id' => auth()->user()->id,
                'source_branch_id' => $request->source_branch_id,
                'destination_branch_id' => $request->destination_branch_id,
                'manage_type' => 'stock_transfer',
                'status' => 'pending',
                'notes' => $request->notes,
                'transaction_date' => $dateAdded,
                'uuid' => Str::uuid(),
            ]);

            foreach ($price_id as $key => $values) {
                if (!isset($values) || !isset($request->item_id[$key]) || !isset($request->qty[$key])) {
                    continue;
                }

                $stockManageItem = StockManageItem::create([
                    'stock_manage_id' => $transfer->id,
                    'item_price_id' => $values,
                    'item_price_size_id' => $request->price_size_id[$key],
                    'item_id' => $request->item_id[$key],
                    'qty' => $request->qty[$key],
                    'cost_price' => $request->cost_price[$key],
                ]);

                $items = ItemPrice::where('id', $values)->first();
                $old_stock = $items->stock;
                $current_stock = $old_stock - $request->qty[$key];
                $item_cost_price = $items->cost_price;
                $finalCostPrice = $item_cost_price * $current_stock;
                if($current_stock <= 0) {
                    $finalCostPrice = 0;
                }

                ItemPrice::where('id', $items->id)->update([
                    'stock' => $current_stock,
                    'total_cost_price' => $finalCostPrice,
                ]);

                DB::table('stock_management_history')->insert([
                    'user_id' => auth()->user()->id,
                    'item_id' => $items->item_id,
                    'item_price_id' => $values,
                    'action_type' => 'sub',
                    'open_stock' => $old_stock,
                    'stock_value' => $request->qty[$key],
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => $stockManageItem->id,
                    'reference_key' => 'Stock Transfer Add',
                    'shop_id' =>  $request->source_branch_id,
                    'cost_price' => $item_cost_price,
                    'total_cost_price' => $finalCostPrice
                ]);
            }

            return $this->sendResponse(1, 'Stock Transfer Added', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StockManage $stock_transfer)
    {
        if (!(checkUserPermission('stock_transfer_edit'))) {
            return view('Helper.unauthorized_access');;
        }

        $branch_id = $request->shop;
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

        $transfer_items = StockManageItem::where('stock_manage_id', $stock_transfer->id)->get();

        $branches = Branch::when($branch_id,function($query, $branch_id){
                        $query->where('id','!=' ,$branch_id);
                    })->get();
        return view('Admin.Model.StockTransferModel', compact('stock_transfer', 'items', 'transfer_items', 'branches', 'branch_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockManage $stock_transfer)
    {
        if (!(checkUserPermission('stock_transfer_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/stock-transfer'));
        }
        $stock_transfer_items = $stock_transfer->getManageItems;
        foreach($stock_transfer_items as $values){
            $itemsPrice = ItemPrice::where('id', $values->item_price_id)->first();
            $old_stock = $itemsPrice->stock;
            $qty = $values->qty;
            if($old_stock > 0) {
                $current_stock = $qty + $old_stock;
                $totalAmount = $qty * $values->cost_price;
                $finalTotalCostPrice = $itemsPrice->total_cost_price + $totalAmount;
                $finalCostPrice = $finalTotalCostPrice / $current_stock;
            } else {
                $current_stock = $old_stock + $qty;
                $finalCostPrice = $values->cost_price;
                $finalTotalCostPrice = $values->cost_price * $qty;

                if($current_stock <= 0) {
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
                'item_id' => $values->item_id,
                'item_price_id' => $values->item_price_id,
                'action_type' => 'add',
                'open_stock' => $old_stock,
                'stock_value' => $qty,
                'closing_stock' => $current_stock,
                'date_added' => date("Y-m-d H:i:s"),
                'reference_no' => $values->id,
                'reference_key' => 'Stock Transfer Delete',
                'shop_id' =>  $this->getBranchId(),
                'cost_price' => $finalCostPrice,
                'total_cost_price' => $finalTotalCostPrice
            ]);
        }
        $result = $stock_transfer->delete();
        if ($result) {
            return $this->sendResponse(1, 'Stock Transfer Deleted succussfully', '', url('admin/stock-transfer'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/stock-transfer'));
        }
    }

    public function show(Request $request, $id)
    {
        $item_list = StockManageItem::where('stock_manage_id', $id)
                    ->orderBy('id', 'asc')
                    ->get();
        $show = $request->show;
        $stockTransfer = StockManage::find($id);
        $source_branch_id = $stockTransfer->source_branch_id;
        $destination_branch_id = $stockTransfer->destination_branch_id;

        return view('Admin.Model.StockManage-ItemList', compact('item_list', 'id', 'show', 'source_branch_id', 'destination_branch_id'));
    }

    public function approveTransfer(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'stock_manage_id' => 'required',
            'source_branch_id' => 'required',
            'destination_branch_id' => 'required',
            'price_id.*' => 'required|integer', // Validate each price_id
            'item_id.*' => 'required|integer',   // Validate each item_id
            'item_name.*' => 'required|string',   // Validate each item_name
            'received_qty.*' => 'required|integer|min:1',  // Validate each quantity
            'qty.*' => 'required|integer|min:1',  // Validate each quantity
            'item_price_name.*' => 'required|string|min:1',  // Validate each quantity
        ]);

        $validation->after(function ($validation) use ($request) {
            foreach ($request->input('received_qty', []) as $index => $price) {
                if (is_null($price)) {
                    $validation->errors()->add("received_qty{$index}", "All Received Qty is required.");
                }
            }
        });

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $customErrors = [];

            // Customize the barcode error keys
            foreach ($errors as $key => $messages) {
                if (strpos($key, 'received_qty.') === 0) {
                    // Change item_barcode.1 to item_barcode1
                    $newKey = preg_replace('/received_qty\.(\d+)/', 'received_qty$1', $key);
                    $customErrors[$newKey] = $messages;
                } else {
                    // Keep original error keys
                    $customErrors[$key] = $messages;
                }
            }
            return $this->sendResponse(0, '', $customErrors, '');
        }

        $receivedQty = $request->received_qty;
        $item_ids = $request->item_id;
        $stock_manage_id = $request->stock_manage_id;
        $source_branch_id = $request->source_branch_id;
        $destination_branch_id = $request->destination_branch_id;
        $item_name = $request->item_name;
        $item_price_name = $request->item_price_name;
        $price_id = $request->price_id;
        $qtys = $request->qty;
        $cost_prices = $request->cost_price;

        foreach($receivedQty as $key => $qty)
        {
            $item_id = $item_ids[$key];
            $sourceItem = Item::find($item_id);
            $itemSlug = $sourceItem->item_slug;

            $checkdestinationItem = Item::where('item_slug', $itemSlug)->where('branch_id', $destination_branch_id)->first();

            if($checkdestinationItem == null)
            {
                // check category if not available then create.
                $category = Category::where('id', $sourceItem->category_id)->first();
                $checkdestinationcategory = Category::where('category_slug', $category->category_slug)
                                            ->where('branch_id', $destination_branch_id)->first();

                if($checkdestinationcategory == null){
                    $checkdestinationcategory = Category::create([
                        'category_name' => $category->category_name,
                        'other_name' => $category->category_other_name,
                        'category_slug' => $category->category_slug,
                        'branch_id' => $destination_branch_id,
                        'uuid' => Str::uuid(),
                    ]);
                }

                // check unit if not available then create.
                $unit = Unit::where('id', $sourceItem->unit_id)->first();
                $checkdestinationUnit = Unit::where('unit_slug', $unit->unit_slug)
                                            ->where('branch_id', $destination_branch_id)->first();

                if($checkdestinationUnit == null){
                    $checkdestinationUnit = Unit::create([
                        'unit_name' => $unit->unit_name,
                        'unit_slug' => $unit->unit_slug,
                        'branch_id' => $destination_branch_id,
                        'uuid' => Str::uuid(),
                    ]);
                }

                $item = Item::create([
                    'category_id' => $checkdestinationcategory->id,
                    'unit_id' => $checkdestinationUnit->id,
                    'item_name' => $sourceItem->item_name,
                    'item_slug' => $sourceItem->item_slug,
                    'item_other_name' => $sourceItem->item_other_name,
                    'item_cost_price' => $sourceItem->item_cost_price,
                    'multiple_price' => $sourceItem->multiple_price,
                    'barcode' => $sourceItem->barcode,
                    'item_type' => $sourceItem->item_type,
                    'ingredient' => $sourceItem->ingredient,
                    'image' => $sourceItem->image,
                    'stock_applicable' => $sourceItem->stock_applicable,
                    'active' => $sourceItem->active,
                    'branch_id' => $destination_branch_id,
                    'minimum_qty' => $sourceItem->minimum_qty,
                    'uuid' => Str::uuid(),
                ]);

                $itemPrice = ItemPrice::where('item_id', $item_id)->get();//dd($itemPrice);
                foreach($itemPrice as $itemPriceValue)
                {
                    // check price size if not available then create.
                    $priceSize = PriceSize::where('id', $itemPriceValue->price_size_id)->first();
                    $checkdestinationPriceSize = PriceSize::where('size_slug', $priceSize->size_slug)
                                                ->where('branch_id', $destination_branch_id)->first();

                    if($checkdestinationPriceSize == null){
                        $checkdestinationPriceSize = PriceSize::create([
                            'size_name' => $priceSize->size_name,
                            'size_slug' => $priceSize->size_slug,
                            'branch_id' => $destination_branch_id,
                            'uuid' => Str::uuid(),
                        ]);
                    }
                    ItemPrice::create([
                        'branch_id' => $destination_branch_id,
                        'item_id' => $item->id,
                        'price_size_id' => $checkdestinationPriceSize->id,
                        'price' => $itemPriceValue->price,
                        'stock' => '0', // Set stock to 0 if needed, or adjust this based on your logic
                        'barcode' => $itemPriceValue->barcode,
                        'price_item_type' => $itemPriceValue->price_item_type,
                        'cost_price' => '0', //$itemPriceValue->cost_price,
                        'total_cost_price' => '0',
                    ]);
                }
            }

            $itemId = Item::where('item_slug', $item_name[$key])->where('branch_id', $destination_branch_id)->first();

            $destinationItempriceCount = $itemId->itemprice->count();
            $sourceItempriceCount = $sourceItem->itemprice->count();

            if($destinationItempriceCount != $sourceItempriceCount)
            {
                $itemPrice = ItemPrice::where('item_id', $item_id)->get();
                foreach($itemPrice as $itemPriceValue)
                {
                    // check price size if not available then create.
                    $priceSize = PriceSize::where('id', $itemPriceValue->price_size_id)->first();
                    $checkdestinationPriceSize = PriceSize::where('size_slug', $priceSize->size_slug)
                                                ->where('branch_id', $destination_branch_id)->first();

                    if($checkdestinationPriceSize == null){
                        $checkdestinationPriceSize = PriceSize::create([
                            'size_name' => $priceSize->size_name,
                            'size_slug' => $priceSize->size_slug,
                            'branch_id' => $destination_branch_id,
                            'uuid' => Str::uuid(),
                        ]);
                    }
                    ItemPrice::create([
                        'branch_id' => $destination_branch_id,
                        'item_id' => $itemId->id,
                        'price_size_id' => $checkdestinationPriceSize->id,
                        'price' => $itemPriceValue->price,
                        'stock' => '0', // Set stock to 0 if needed, or adjust this based on your logic
                        'barcode' => $itemPriceValue->barcode,
                        'price_item_type' => $itemPriceValue->price_item_type,
                        'cost_price' => '0', //$itemPriceValue->cost_price,
                        'total_cost_price' => '0',
                    ]);
                }
            }

            $sizeId = PriceSize::where('size_slug', $item_price_name[$key])->where('branch_id', $destination_branch_id)->first();

            if($qtys[$key] != $qty) {
                $itemsPrice = ItemPrice::where('id', $price_id[$key])->first();
                $old_stock = $itemsPrice->stock;
                $returnQty = $qtys[$key] - $qty;
                $current_stock = $old_stock + $returnQty;
                if($old_stock > 0) {
                    $current_stock = $returnQty + $old_stock;
                    $totalAmount = $returnQty * $cost_prices[$key];
                    $finalTotalCostPrice = $itemsPrice->total_cost_price + $totalAmount;
                    $finalCostPrice = $finalTotalCostPrice / $current_stock;
                } else {
                    $current_stock = $old_stock + $returnQty;
                    $finalCostPrice = $cost_prices[$key];
                    $finalTotalCostPrice = $cost_prices[$key] * $current_stock;

                    if($current_stock <= 0) {
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
                    'item_id' => $item_id,
                    'item_price_id' => $price_id[$key],
                    'action_type' => 'add',
                    'open_stock' => $old_stock,
                    'stock_value' => $returnQty,
                    'closing_stock' => $current_stock,
                    'date_added' => date("Y-m-d H:i:s"),
                    'reference_no' => $key,
                    'reference_key' => 'Stock Transfer Return',
                    'shop_id' =>  $source_branch_id,
                    'cost_price' => $finalCostPrice,
                    'total_cost_price' => $finalTotalCostPrice
                ]);
            }

            $itemsPrice = ItemPrice::where('item_id', $itemId->id)->where('price_size_id', $sizeId->id)->first();
            $old_stock = $itemsPrice->stock;
            if($old_stock > 0) {
                $current_stock = $old_stock + $qty;
                $totalAmount = $qty * $cost_prices[$key];
                $finalTotalCostPrice = $itemsPrice->total_cost_price + $totalAmount;
                $finalCostPrice = $finalTotalCostPrice / $current_stock;
            } else {
                $current_stock = $old_stock + $qty;
                $finalCostPrice = $cost_prices[$key];
                $finalTotalCostPrice = $cost_prices[$key] * $current_stock;

                if($current_stock <= 0) {
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
                'item_id' => $item_id,
                'item_price_id' => $price_id[$key],
                'action_type' => 'add',
                'open_stock' => $old_stock,
                'stock_value' => $qty,
                'closing_stock' => $current_stock,
                'date_added' => date("Y-m-d H:i:s"),
                'reference_no' => $key,
                'reference_key' => 'Stock Transfer',
                'shop_id' =>  $destination_branch_id,
                'cost_price' => $finalCostPrice,
                'total_cost_price' => $finalTotalCostPrice
            ]);

            StockManageItem::where('id', $key)->update([
                'received_qty' => $qty,
            ]);
        }

        StockManage::where('id', $stock_manage_id)->update([
            'status' => 'received',
            'approver_user_id' => auth()->user()->id,
        ]);
        return $this->sendResponse(1, 'Stock Transfer Approved succussfully', '', url('admin/stock-transfer'));

    }
}
