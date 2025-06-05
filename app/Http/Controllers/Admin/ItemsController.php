<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\Item;
use App\Models\Admin\Category;
use App\Models\Admin\ItemPrice;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;

class ItemsController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('items'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $item_id = $request->item_id;
        $category_id = $request->category_id; // Get category_id from request
        $item_type = $request->item_type; // Get item_type from request
        $branch_id = $this->getBranchId();

        $itemsQuery = Item::with('category', 'unit')
            ->whereHas('category', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->whereHas('unit', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->when($item_id, function ($query, $item_id) {
                $query->where('id', $item_id);
            })
            ->when($category_id, function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($item_type, function ($query, $item_type) {
                $query->where('item_type', $item_type);
            });

        $items = $itemsQuery->when($branch_id, function ($query,$branch_id) {
                            $query->where('branch_id',$branch_id);
                        })->orderBy('item_name', 'asc') // Order by 'item_name' alphabetically
                        ->get();

        $itemList = getAllItem($branch_id, $item_type);

        $categories = Category::whereNull('deleted_at')
    ->when($branch_id, function ($query) use ($branch_id) {
        return $query->where('branch_id', $branch_id);
    })
    ->get();
 // Assuming you have a Category model
        $itemTypes = [
            '' => 'Select Item Type',
            '1' => 'Salable',
            '2' => 'Raw Material',
        ];

        return view('Admin.item', compact('items', 'item_id', 'itemList', 'categories', 'itemTypes', 'category_id', 'item_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('item_create'))) {
            return view('Helper.unauthorized_access');
        }
        $item = null;
        return view('Admin.Model.itemmodel', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'minimum_qty' => $request->minimum_qty ?? 0,
        ]);

        $validation = Validator::make($request->all(), [
            'category_id' => 'required',
            'unit_id' => 'required',
            'item_name' => [
                'required',
                Rule::unique('items')
                    ->ignore($request->uuid, 'uuid')
                    ->whereNull('deleted_at')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
            ],
            'item_price' => 'required|array',
            'item_price.*' => 'nullable|numeric', // Allow null for prices, but ensure they're numeric
            'item_barcode' => 'array',
            'item_type' => 'required',
            // 'stock_applicable' => 'required',
            'image' => 'max:2048|mimes:pdf,jpg,png,jpeg|image',
            'branch_id' => 'required',
            'minimum_qty' => 'required|numeric|min:0|max:9999999.999999999',
        ]);

        // Add a custom rule to require item_barcode when item_price has a value
        $validation->after(function ($validation) use ($request) {

            if (app('appSettings')['barcode']->value == 'yes') {
                $itemBarcodes = $request->input('item_barcode', []);

                foreach ($request->input('item_price', []) as $index => $price) {
                    if (!is_null($price) && empty($request->input("item_barcode.$index"))) {
                        $validation->errors()->add("item_barcode{$index}", "The barcode field is required when price is present.");
                    }

                    // Step 2: Filter out null or empty barcodes and check for uniqueness
                    $filteredBarcodes = array_filter($itemBarcodes, function ($barcode) {
                        return !empty($barcode); // Keep only non-empty barcodes
                    });

                    // Step 3: Check if all remaining barcodes are unique
                    $barcodeCounts = array_count_values($filteredBarcodes);
                    foreach ($barcodeCounts as $barcode => $count) {
                        if ($count > 1) {
                            // Find the keys where this duplicate barcode occurs
                            foreach (array_keys($itemBarcodes, $barcode) as $key) {
                                $validation->errors()->add("item_barcode.$key", "The barcode must be unique.");
                            }
                        }
                    }

                    // Check for uniqueness
                    if (!is_null($price)) {
                        $barcode = $request->input("item_barcode.$index");
                        $item_id = $request->id;
                        $branch_id = $request->branch_id;
                        $checkBarcode = ItemPrice::where('barcode', $barcode)->where('branch_id', $branch_id)
                                        ->when($item_id, function ($query) use ($item_id) {
                                            $query->where('item_id', '!=',$item_id);
                                        })->exists();
                        if ($checkBarcode) {
                            $validation->errors()->add("item_barcode{$index}", "The barcode has already been taken.");
                        }
                    }
                }
            }

            // Ensure at least one item_price is filled
            if (empty(array_filter($request->input('item_price', [])))) {
                $validation->errors()->add('item_price', 'At least one price is required.');
            }
        });

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $customErrors = [];

            // Customize the barcode error keys
            foreach ($errors as $key => $messages) {
                if (strpos($key, 'item_barcode.') === 0) {
                    // Change item_barcode.1 to item_barcode1
                    $newKey = preg_replace('/item_barcode\.(\d+)/', 'item_barcode$1', $key);
                    $customErrors[$newKey] = $messages;
                } else {
                    // Keep original error keys
                    $customErrors[$key] = $messages;
                }
            }
            return $this->sendResponse(0, '', $customErrors, '');
        }

        // $item_price_check = is_array_empty($request->item_price);
        // if(!$item_price_check)
        // {
        //     $array = [
        //         "item_price" => [
        //             "Minimum one price required"
        //         ]
        //     ];
        //     $error = ($array);
        //     return $this->sendResponse(0, '', $error, '');
        // }

        // $isNumberArray = isNumberArray($request->item_price);
        // if(!$isNumberArray)
        // {
        //     $array = [
        //         "item_price" => [
        //             "The price field must be a number."
        //         ]
        //     ];
        //     $error = ($array);
        //     return $this->sendResponse(0, '', $error, '');
        // }

        $checkMultiplePrice = checkMultiplePrice($request->item_price);
        $multiple_price = 'no';
        if ($checkMultiplePrice > 1) {
            $multiple_price = 'yes';
        }

        $imageName = '';
        if ($request->image) {
            if ($image = $request->file('image')) {
                $destinationPath = storage_path('app/public/item_image');
                $profileImage = time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $imageName = $profileImage;
            }
        } else {
            if ($request->uuid) {
                $imageName = Item::where('uuid', $request->uuid)->first('image')->image;
            }
        }
        // dd($request->all());
        //dd(empty($request->item_price));
        // foreach($request->item_price as $permission)
        // {
        //     $user->permissions()->saveMany([
        //                 new UserHasPermissions([
        //                 'user_id' => $user->id,
        //                 'action' => $permission,])

        //     ]);
        // }

        if ($request->uuid) {
            if (!(checkUserPermission('item_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/item'));
            }

            $item = Item::where('uuid', $request->uuid)->first();
            $oldName = $item->item_slug;
            $item->item_name = $request->item_name;

            if($item->isDirty()){
                Item::where('item_slug', $oldName)->update([
                    'item_name' => $request->item_name,
                    'item_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->item_name))),
                ]);
            }

            Item::where('uuid', $request->uuid)->update([
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                // 'item_name' => $request->item_name,
                // 'item_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->item_name))),
                'item_other_name' => $request->item_other_name,
                'item_cost_price' => '0',//$request->item_cost_price,
                'multiple_price' => $multiple_price,
                'item_price' => '0',//array_values($request->item_price)[0],
                'barcode' => $request->barcode,
                // 'stock' => $request->stock,
                'item_type' => $request->item_type,
                'stock_applicable' => $request->stock_applicable ?? '0',
                'image' => $imageName,
                // 'expiry_date' => $request->expiry_date,
                'ingredient' => isset($request->ingredient) ? $request->ingredient : '0',
                'active' => isset($request->active) ? $request->active : 'yes',
                'branch_id' => $request->branch_id,
                'minimum_qty' => isset($request->minimum_qty) ? $request->minimum_qty : '0',
            ]);
            // \Log::info('Minimum Qty: ' . $request->minimum_qty);

            $item = Item::where('uuid', $request->uuid)->first();

            foreach ($request->item_price as $key => $item_price) {
                if ($item_price) {

                    $value = '';
                    if (app('appSettings')['barcode']->value == 'yes') {
                        $value = $request->item_barcode[$key];
                    }

                    $checkItem = ItemPrice::where('price_size_id', $key)->where('item_id', $item->id)->first();
                    if ($checkItem !== null) {
                        ItemPrice::where('price_size_id', $key)->where('item_id', $item->id)->update([
                            // 'branch_id' => $item->branch_id,
                            // 'item_id' => $item->id,
                            // 'price_size_id' => $key,
                            'price' => $item_price,
                            'barcode' => $value,
                            'price_item_type' => $request->item_type,
                        ]);
                    } else {
                        ItemPrice::create([
                            'branch_id' => $item->branch_id,
                            'item_id' => $item->id,
                            'price_size_id' => $key,
                            'price' => $item_price,
                            'stock' => '0',
                            'barcode' => $value,
                            'price_item_type' => $request->item_type,
                        ]);
                    }
                }
            }

            // ItemPrice::where('item_id',$item->id)->delete();
            // foreach($request->item_price as $key => $item_price)
            // {
            //     $item->itemprice()
            //         ->saveMany([
            //             new ItemPrice([
            //             'branch_id' => $item->branch_id,
            //             'item_id' => $item->id,
            //             'price_size_id' => $key,
            //             'price' => $item_price,
            //         ])
            //     ]);
            // }

            return $this->sendResponse(1, 'Item Updated', '', url('admin/item'));
        } else {

            if (!(checkUserPermission('item_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/item'));
            }
            // dd(isset($request->ingredient) ? $request->ingredient : 0);
            // DB::enableQueryLog();
            $item = Item::create([
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'item_name' => $request->item_name,
                'item_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->item_name))),
                'item_other_name' => $request->item_other_name,
                'item_cost_price' => '0',
                'multiple_price' => $multiple_price,
                'barcode' => $request->barcode,
                'item_type' => $request->item_type,
                'ingredient' => $request->ingredient ?? '0',
                'image' => $imageName,
                'stock_applicable' => $request->stock_applicable ?? '0',
                'active' => $request->active ?? 'yes',
                'branch_id' => $request->branch_id,
                'minimum_qty' => $request->minimum_qty,
                'uuid' => Str::uuid(),
            ]);

            $item_prices = [];
           if($request->item_type == '2'){

                // if item type is raw material no need multiple price size, so no loop

                $first_key = key($request->item_price);
                $item_price = $request->item_price[$first_key] ?? 0;

                    // Handle barcode value based on the settings
                    $value = app('appSettings')['barcode']->value == 'yes' ? $request->item_barcode[$first_key] : '';

                    // Add the item price to the array for insertion
                    $item_prices[] = [
                        'branch_id' => $request->branch_id,
                        'item_id' => $item->id,
                        'price_size_id' => $first_key,
                        'price' => $item_price,
                        'stock' => '0', // Set stock to 0 if needed, or adjust this based on your logic
                        'barcode' => $value,
                        'price_item_type' => $request->item_type,
                    ];
            }else{
                foreach ($request->item_price as $key => $item_price) {
                    // If item price is missing or empty, set it to 0
                    $item_price = !empty($item_price) ? $item_price : 0;

                    // Handle barcode value based on the settings
                    $value = app('appSettings')['barcode']->value == 'yes' ? $request->item_barcode[$key] : '';

                    // Add the item price to the array for insertion
                    $item_prices[] = [
                        'branch_id' => $request->branch_id,
                        'item_id' => $item->id,
                        'price_size_id' => $key,
                        'price' => $item_price,
                        'stock' => '0', // Set stock to 0 if needed, or adjust this based on your logic
                        'barcode' => $value,
                        'price_item_type' => $request->item_type,
                    ];
                }
            }

            // Insert the prices into the item_prices table
            $item->itemprice()->createMany($item_prices);

            if ($request->has('is_modal')) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Item Created',
                    'id' => $item->id,
                    'name' => $item->item_name,
                    'price_id' => ItemPrice::where('item_id', $item->id)->first()->id,
                    'size_name' => ItemPrice::where('item_id', $item->id)->first()->price_size_id,
                    'item_price_cost_price' => ItemPrice::where('item_id', $item->id)->first()->cost_price,
                ]);
            } else {
                return $this->sendResponse(1, 'Item Created', '', url('admin/item'));
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item, Request $request)
    {
        if (!(checkUserPermission('item_edit'))) {
            return view('Helper.unauthorized_access');
        }
        return view('Admin.Model.itemmodel', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if (!(checkUserPermission('item_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/item'));
        }
        $item->delete();
        $result = $item->itemprice()->delete();
        if ($result) {
            return $this->sendResponse(1, 'Item Deleted succussfully', '', url('admin/item'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/item'));
        }
    }
    public function uploadExcel(Request $request)
    {
        // Validate the Excel file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Handle the uploaded Excel file
        if ($request->file('excel_file')) {
            $file = $request->file('excel_file');

            // Use Excel package to import the file
            Excel::import(new ItemImport, $file);

            // Provide feedback to the user
            return redirect()->back()->with('success', 'Items have been successfully uploaded.');
        }

        return redirect()->back()->with('error', 'There was a problem uploading the file.');
    }
}
