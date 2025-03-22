<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Item;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Barryvdh\DomPDF\Facade\Pdf;

class BarcodeController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barcode = new DNS1D();
        $barcode->setStorPath(__DIR__.'/cache/');

        $barcodeHtml = $barcode->getBarcodeHTML('123456', 'C128', 2, 60); // CODE 128 Barcode
        $branch_id = $this->getBranchId();

        $items = Item::leftJoin('item_prices', function ($join) {
                    $join->on('items.id', '=', 'item_prices.item_id');
                })->leftJoin('price_size', function ($joins) {
                    $joins->on('item_prices.price_size_id', '=', 'price_size.id');
                })->when($branch_id, function ($query,$branch_id) {
                    $query->where('items.branch_id',$branch_id);
                })->where('items.stock_applicable', '1')
                ->where('items.item_type', '1')
                ->where('item_prices.barcode', '!=', '')
                // ->where('items.active', 'yes')
                // ->where('item_prices.price', '>', 0)
                ->select(DB::raw('items.*,item_prices.id as price_id,item_prices.item_id,item_prices.price_size_id,item_prices.price,item_prices.stock as item_stock,item_prices.cost_price as item_price_cost_price,price_size.size_name,item_prices.barcode as item_barcode'))
                ->get();
// dd($items);
        return view('Admin.barcode', compact('barcodeHtml','items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // if(!(checkUserPermission('expense_create')))
        // {
        //     return view('Helper.unauthorized_access');
        // }
        // $expense = null;
        // return view('Admin.Model.expensemodel',compact('expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $qtys = $request->qty;
        $cost_prices = $request->cost_price;
        $item_names = $request->item_name;
        $barcodes = $request->barcode;

        if ($qtys == null) {
            return redirect('admin/barcode-print')->withMessage('Please add item');
        }

        $items = [];

        foreach ($qtys as $key => $value) {
            for ($i = 0; $i < $value; $i++) {
                // Remove "- Unit price" if it exists in the name
                $cleanedName = str_ends_with($item_names[$key], ' - Unit price')
                    ? str_replace(' - Unit price', '', $item_names[$key])
                    : $item_names[$key];

                $items[] = [
                    'name' => $cleanedName,
                    'price' => $cost_prices[$key],
                    'barcode' => $barcodes[$key]
                ];
            }
        }

        $barcodeGenerator = new DNS1D();
        $barcodeGenerator->setStorPath(__DIR__.'/cache/');

        foreach ($items as &$item) {
            $item['barcode_html'] = $barcodeGenerator->getBarcodeHTML($item['barcode'], 'C128', 2, 50);
        }

        $pdf = Pdf::loadView('Admin.bar', ['items' => $items]);

        return $pdf->download('barcodes.pdf');
    }
    }
