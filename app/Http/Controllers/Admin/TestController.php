<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\SaleOrders;
use Carbon\Carbon;

class TestController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
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
        $sales = SaleOrders::selectRaw('SUM(with_tax) as total, DATE_FORMAT(ordered_date, "%Y-%m") as month')
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

        return view('Admin.Test', [
            'labels' => $labels,
            'data' => $data->values()
        ]);
    }
}
