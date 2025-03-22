<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BillWiseExport;
use App\Models\SaleOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class DayWiseController extends Controller
{
    public function bill_wise(Request $request)
    {
        return Excel::download(new BillWiseExport($request), 'bill-wise.xlsx');
    }

    public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        if(auth()->user()->branch_id)
        {
            $sales = DB::table('sale_order_payments')
            ->whereNull('deleted_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total_sales'))
            ->groupBy('date');

            $purchases = DB::table('purchase_orders')
            ->whereNull('deleted_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_purchases'))
            ->groupBy('date');

            $expenses = DB::table('expenses')
            ->whereNull('deleted_at')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_expenses'))
            ->groupBy('date');

            $startDate = request('start_date');
            $endDate = request('end_date');

            if ($startDate && $endDate) {
                $sales->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
                $purchases->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
                $expenses->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
            }

            $salesData = $sales->get()->keyBy('date');
            $purchasesData = $purchases->get()->keyBy('date');
            $expensesData = $expenses->get()->keyBy('date');

            $dates = $salesData->keys()->merge($purchasesData->keys())->merge($expensesData->keys())->unique()->sort();

            $report = collect();

            foreach ($dates as $date) {
                $report->push([
                    'date' => $date,
                    'total_sales' => $salesData->get($date)->total_sales ?? 0,
                    'total_purchases' => $purchasesData->get($date)->total_purchases ?? 0,
                    'total_expenses' => $expensesData->get($date)->total_expenses ?? 0,
                ]);
            }
        }
        else{
            if(getSessionBranch()){

            }else{

            }
        }


        return view('Admin.Day-wise',compact('report'));
    }

    public function category_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        if(auth()->user()->branch_id)
        {
            $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.category_id')
                ->select(DB::raw('sale_order_items.category_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                ->get();
        }
        else{
            if(getSessionBranch()){
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->where('sale_orders.shop_id', getSessionBranch())
                        ->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_order_items.category_id')
                        ->select(DB::raw('sale_order_items.category_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }else{
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_order_items.category_id')
                        ->select(DB::raw('sale_order_items.category_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }
        }
        $pdf = PDF::loadView('Admin.pdf.category', $data);

        return $pdf->download('category-wise.pdf');
    }

}
