<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService as ServicesDashboardService;

class DashboardController extends Controller
{
    use ResponseTraits;

    public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $branch_id = $this->getBranchId();
        $cashDrawer = null;

        $payment_amount = ServicesDashboardService::PaymentSaleAmount($from_date,$to_date,$branch_id);
        $expense_amount = ServicesDashboardService::ExpenseAmount($from_date,$to_date,$branch_id);
        $top_items = ServicesDashboardService::TopItems($from_date,$to_date,$branch_id);
        $month_sale = ServicesDashboardService::MonthWiseSale($branch_id);
        $MonthWiseExpense = ServicesDashboardService::MonthWiseExpense($branch_id);
        $DayWiseSale = ServicesDashboardService::DayWiseSale($branch_id);
        $RecentSales = ServicesDashboardService::RecentSales($branch_id);
        if(auth()->user()->branch_id){
            $cashDrawer = ServicesDashboardService::totalCashDrawer($branch_id);
        }
        $labels = $month_sale['labels'];
        $data = $month_sale['data'];

        $expense_labels = $MonthWiseExpense['labels'];
        $expense_data = $MonthWiseExpense['data'];

        $day_labels = $DayWiseSale['labels'];
        $day_data = $DayWiseSale['data'];

        return view('Admin.dashboard',compact('payment_amount','expense_amount','top_items','labels','data','expense_labels','expense_data','day_labels','day_data','RecentSales','cashDrawer'));
    }

    public function index2()
    {
        return view('Admin.dashboard2');
    }

    public function setBranch(Request $request)
    {
        $branch_id = $request->input('id');
        setSessionBranch($branch_id);
        if($branch_id)
        {
            $msg = "Branch set succussfully";
        }else{
            $msg = "No Branch selected";
        }
        return $this->sendResponse(1,$msg,'','');
    }
}
