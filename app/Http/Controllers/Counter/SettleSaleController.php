<?php

namespace App\Http\Controllers\Counter;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\SettleSale;

class SettleSaleController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, SettleSale $settle_sale)
    {
        $inputs['shop_id'] = auth()->user()->branch_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['discount_type'] = 'amount';
        $inputs['to_date'] = date("Y-m-d H:i:s");
        $settle_sales = $settle_sale->getAllSettle($inputs);
        // dd($settle_sales);
        return view('Counter.settle_sale',compact('settle_sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,SettleSale $settle_sale)
    {
        $inputs['shop_id'] = auth()->user()->branch_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['discount_type'] = 'amount';
        $inputs['from_date'] = $request->from_date;
        $inputs['settleId'] = $request->settleId;
        $inputs['to_date'] = date("Y-m-d H:i:s");
        $settle_sale = $settle_sale->getAllSettle($inputs);//dd($settle_sales);
        return view("Counter.settle_print",compact('settle_sale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,SettleSale $settle_sale)
    {
        $inputs['shop_id'] = auth()->user()->branch_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['discount_type'] = 'amount';
        $inputs['to_date'] = date("Y-m-d H:i:s");
        $inputs = $settle_sale->getAllSettle($inputs);
        $inputs['shop_id'] = auth()->user()->branch_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['discount_type'] = 'amount';
        $inputs['to_date'] = date("Y-m-d H:i:s");
        $inputs['settle_date'] = date("Y-m-d H:i:s");
        $inputs['settle_date'] = date("Y-m-d H:i:s");
        $inputs['staff_id'] = (isset($_GET['staff_id']) && $_GET['staff_id'] !='') ? $_GET['staff_id'] : '0';
        $settle_sale = $settle_sale->setSettleSale($inputs);//dd($settle_sales);
        return redirect('settle-sale')->with('print_date',$inputs['last_settle_date'])->with('settleId', $settle_sale);
    }
}
