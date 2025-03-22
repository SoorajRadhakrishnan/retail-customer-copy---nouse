<?php

namespace App\Http\Services;

use App\Models\Expense;
use App\Models\SaleOrders;
use App\Models\SettleSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public static function PaymentSaleAmount($from_date,$to_date,$branch_id = null)
    {
        // DB::enableQueryLog();
        return SaleOrders::leftJoin('sale_order_payments', function ($join) {
            $join->on('sale_orders.id', '=', 'sale_order_payments.sale_order_id');
            })->when($branch_id, function ($query,$branch_id) {
                $query->where('sale_orders.shop_id',$branch_id);
            })->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
            ->groupBy('sale_order_payments.payment_type')
            ->select(DB::raw('sale_order_payments.payment_type,sum(sale_order_payments.amount) as total_price'))
            ->get();
            // dd(DB::getQueryLog());
    }

    public static function ExpenseAmount($from_date,$to_date,$branch_id = null)
    {
        return Expense::when($branch_id, function ($query,$branch_id) {
                    $query->where('branch_id',$branch_id);
                })->whereBetween('created_at', [$from_date, $to_date])
                ->select(DB::raw('sum(total_amount) as total_price'))
                ->first();
    }

    public static function TopItems($from_date,$to_date,$branch_id = null)
    {
        return SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($branch_id, function ($query,$branch_id) {
                    $query->where('sale_orders.shop_id',$branch_id);
                })->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.price_size_id')
                ->select(DB::raw('sum(sale_order_items.total_price) as total_price,sale_order_items.price_size_id'))
                ->limit('5')
                ->get();
    }

    public static function MonthWiseSale($branch_id = null)
    {

        // Get the current date
        $currentDate = Carbon::now();

        // Create a collection to hold the months
        $months = collect();

        // Loop through the last 5 months
        for ($i = 4; $i >= 0; $i--) {
            $months->push($currentDate->copy()->subMonths($i)->format('Y-m'));
        }

        // Fetch sales data for the last 5 months, grouped by month
        $sales =  SaleOrders::selectRaw('SUM(with_tax) as total,DATE_FORMAT(ordered_date, "%Y-%m") as month')
            ->when($branch_id, function ($query,$branch_id) {
                $query->where('shop_id',$branch_id);
            })
            ->where('ordered_date', '>=', $currentDate->copy()->subMonths(4)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        // Ensure every month in the last 5 months is represented, filling in missing months with 0
        $data = $months->mapWithKeys(function ($month) use ($sales) {
            return [$month => $sales->get($month, 0)];
        });

        // Extract labels and data for Chart.js
        $labels = $data->keys()->map(function ($month) {
            return Carbon::createFromFormat('Y-m', $month)->format('F Y');
        });

        return [
            'labels' => $labels,
            'data' => $data->values()
        ];
    }

    public static function MonthWiseExpense($branch_id = null)
    {

        // Get the current date
        $currentDate = Carbon::now();

        // Create a collection to hold the months
        $months = collect();

        // Loop through the last 5 months
        for ($i = 4; $i >= 0; $i--) {
            $months->push($currentDate->copy()->subMonths($i)->format('Y-m'));
        }

        // Fetch sales data for the last 5 months, grouped by month
        $sales =  Expense::selectRaw('SUM(total_amount) as total,DATE_FORMAT(created_at, "%Y-%m") as month')
            ->when($branch_id, function ($query,$branch_id) {
                $query->where('branch_id',$branch_id);
            })
            ->where('created_at', '>=', $currentDate->copy()->subMonths(4)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        // Ensure every month in the last 5 months is represented, filling in missing months with 0
        $data = $months->mapWithKeys(function ($month) use ($sales) {
            return [$month => $sales->get($month, 0)];
        });

        // Extract labels and data for Chart.js
        $labels = $data->keys()->map(function ($month) {
            return Carbon::createFromFormat('Y-m', $month)->format('F Y');
        });

        return [
            'labels' => $labels,
            'data' => $data->values()
        ];
    }

    public static function DayWiseSale($branch_id = null)
    {
        $currentDate = Carbon::now();

        // Generate an array of the last 24 days (dates)
        $days = collect();
        for ($i = 23; $i >= 0; $i--) {
            $days->push($currentDate->copy()->subDays($i)->format('Y-m-d'));
        }

        // Fetch sales data for the last 24 days, grouped by day
        $sales = SaleOrders::selectRaw('SUM(with_tax) as total, DATE(ordered_date) as day')
            ->when($branch_id, function ($query,$branch_id) {
                $query->where('shop_id',$branch_id);
            })
            ->where('ordered_date', '>=', $currentDate->copy()->subDays(23)->startOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->pluck('total', 'day');

        // Ensure every day in the last 24 days is represented, filling in missing days with 0
        $data = $days->mapWithKeys(function ($day) use ($sales) {
            return [$day => $sales->get($day, 0)];
        });

        return [
            'labels' => $data->keys(),
            'data' => $data->values()
        ];
    }

    public static function RecentSales($branch_id=null)
    {
        // DB::enableQueryLog();
        return SaleOrders::when($branch_id, function ($query,$branch_id) {
                $query->where('shop_id',$branch_id);
            })->select(DB::raw('id,shop_id,customer_id,customer_name,customer_number,without_tax,tax_amount,with_tax,ordered_date,receipt_id'))
            ->latest()
            ->limit('20')
            ->get();
            // dd(DB::getQueryLog());
    }

    public static function totalCashDrawer($branch_id=null)
    {
        $inputs['shop_id'] = $branch_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['discount_type'] = 'amount';
        $inputs['to_date'] = date("Y-m-d H:i:s");
        $settle_sales = (new SettleSale())->getAllSettle($inputs);//dd($settle_sales);
        return $settle_sales['cash_drawer'];
    }
}
