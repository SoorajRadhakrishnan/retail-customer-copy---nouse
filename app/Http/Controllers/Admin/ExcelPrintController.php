<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BillWiseExport;
use App\Exports\CategoryWiseExport;
use App\Exports\CustomerWiseExport;
use App\Exports\DriverWiseExport;
use App\Exports\ExpenseExport;
use App\Exports\ItemWiseExport;
use App\Exports\OrderTypeWiseExport;
use App\Exports\PerfomanceWiseExport;
use App\Exports\PurchaseWiseExport;
use App\Exports\SettleSaleExport;
use App\Exports\StaffWiseExport;
use App\Exports\StockWiseExport;
use App\Exports\UserWiseExport;
use App\Models\SaleOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\SettleSale;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExcelPrintController extends Controller
{

    public function getFromdate($request)
    {
        return (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
    }

    public function getTodate(Request $request)
    {
        return (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
    }

    public function getBranch()
    {
        $branch_id = '';
        if(auth()->user()->branch_id)
        {
            $branch_id = auth()->user()->branch_id;
        }
        if(getSessionBranch())
        {
            $branch_id = getSessionBranch();
        }
        return $branch_id;
    }

    public function bill_wise(Request $request)
    {
        return Excel::download(new BillWiseExport($request), 'bill-wise.xlsx');
    }

    public function bill_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['customer'] = $customer = $request->customer;
        $data['receipt_id'] = $receipt_id = $request->receipt_id;
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] = SaleOrders::whereBetween('ordered_date', [$from_date, $to_date])
                    ->where('status','!=','hold')
                    ->where('payment_status','paid')
                    ->when($branch_id, function ($query,$branch_id) {
                        $query->where('shop_id',$branch_id);
                    })
                    ->when($customer, function ($query,$customer) {
                        $query->where('customer_id',$customer);
                    })
                    ->when($receipt_id, function ($query,$receipt_id) {
                        $query->where('receipt_id',$receipt_id);
                    })
                    ->get();

        $pdf = Pdf::loadView('Admin.pdf.bill_wise', $data);

        return $pdf->download('bill-wise.pdf');
    }

    public function category_wise(Request $request)
    {
        return Excel::download(new CategoryWiseExport($request), 'Category-excel.xlsx');
    }

    public function category_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['category'] = $category = $request->category;
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                        $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })
                    ->when($category, function ($query,$category) {
                        $query->where('sale_order_items.category_id',$category);
                    })
                    ->when($branch_id, function ($query,$branch_id) {
                        $query->where('shop_id',$branch_id);
                    })
                    ->where('sale_orders.status','!=','hold')
                    ->where('sale_orders.payment_status','paid')
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.category_id')
                    ->select(DB::raw('sale_order_items.category_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                    ->get();

        $pdf = Pdf::loadView('Admin.pdf.category', $data);

        return $pdf->download('category-wise.pdf');
    }

    public function item_wise(Request $request)
    {
        return Excel::download(new ItemWiseExport($request), 'item-excel.xlsx');
    }

    public function item_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['item'] = $item = $request->item;
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                        $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })
                    ->when($item, function ($query,$item) {
                        $query->where('sale_order_items.price_size_id',$item);
                    })
                    ->when($branch_id, function ($query,$branch_id) {
                        $query->where('shop_id',$branch_id);
                    })
                    ->where('sale_orders.status','!=','hold')
                    ->where('sale_orders.payment_status','paid')
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.category_id')
                    ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.cost_price * sale_order_items.qty) as cost_price,sum(sale_order_items.qty) total_qty'))
                ->get();



        // $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        // $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        // $item = $request->item;

        // if(auth()->user()->branch_id)
        // {
        //     $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
        //         $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
        //     })->when($item, function ($query,$item) {
        //         $query->where('sale_order_items.price_size_id',$item);
        //     })->where('sale_orders.shop_id', auth()->user()->branch_id)
        //         ->where('sale_orders.status','!=','hold')
        //         ->where('sale_orders.payment_status','paid')
        //         ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
        //         ->groupBy('sale_order_items.price_size_id')
        //         ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.cost_price * sale_order_items.qty) as cost_price,sum(sale_order_items.qty) total_qty'))
        //         ->get();
        // }
        // else{
        //     if(getSessionBranch()){
        //         $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
        //                     $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
        //                 })->when($item, function ($query,$item) {
        //                     $query->where('sale_order_items.price_size_id',$item);
        //                 })->where('sale_orders.shop_id', getSessionBranch())
        //                 ->where('sale_orders.status','!=','hold')
        //                 ->where('sale_orders.payment_status','paid')
        //                 ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
        //                 ->groupBy('sale_order_items.price_size_id')
        //                 ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.cost_price * sale_order_items.qty) as cost_price,sum(sale_order_items.qty) total_qty'))
        //                 ->get();
        //     }else{
        //         $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
        //                     $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
        //                 })->when($item, function ($query,$item) {
        //                     $query->where('sale_order_items.price_size_id',$item);
        //                 })->where('sale_orders.status','!=','hold')
        //                 ->where('sale_orders.payment_status','paid')
        //                 ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
        //                 ->groupBy('sale_order_items.price_size_id')
        //                 ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.cost_price * sale_order_items.qty) as cost_price,sum(sale_order_items.qty) total_qty'))
        //                 ->get();
        //     }
        // }
        $pdf = Pdf::loadView('Admin.pdf.item', $data);

        return $pdf->download('item-wise.pdf');
    }

    public function order_type(Request $request)
    {
        return Excel::download(new OrderTypeWiseExport($request), 'order-type-excel.xlsx');
    }

    public function order_type_print(Request $request)
    {
        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['order_type'] = $order_type = $request->order_type;
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] = SaleOrders::when($branch_id, function ($query,$branch_id) {
                            $query->where('shop_id',$branch_id);
                        })
                        ->where('status','!=','hold')
                        ->where('payment_status','paid')
                        ->whereBetween('ordered_date', [$from_date, $to_date])
                        ->groupBy('order_type')
                        ->select(DB::raw('order_type,count(*) as counts,sum(with_tax) as with_tax, sum(without_tax) as without_tax,sum(discount) as discount'))
                        ->get();

        $pdf = Pdf::loadView('Admin.pdf.order_type', $data);

        return $pdf->download('order-type-wise.pdf');
    }

    public function staff_wise(Request $request)
    {
        return Excel::download(new StaffWiseExport($request), 'staff-excel.xlsx');
    }

    public function staff_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');

        $data['to_date'] =  $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        if(auth()->user()->branch_id)
        {
        $data['data'] =  SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.staff_id')
                ->select(DB::raw('sale_orders.staff_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
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
                        ->groupBy('sale_orders.staff_id')
                        ->select(DB::raw('sale_orders.staff_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }else{
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.staff_id')
                        ->select(DB::raw('sale_orders.staff_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }
        }
        $pdf = Pdf::loadView('Admin.pdf.staff', $data);

        return $pdf->download('staff-wise.pdf');
    }

    public function user_wise(Request $request)
    {
        return Excel::download(new UserWiseExport($request), 'user-excel.xlsx');
    }

    public function user_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $user_id = $request->user_id;

        if(auth()->user()->branch_id)
        {
            $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->when($user_id, function ($query,$user_id) {
                $query->where('sale_orders.user_id',$user_id);
            })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.user_id')
                ->select(DB::raw('sale_orders.user_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                ->get();
                $users = getUserForFilter(auth()->user()->branch_id);
        }
        else{
            if(getSessionBranch()){
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($user_id, function ($query,$user_id) {
                            $query->where('sale_orders.user_id',$user_id);
                        })->where('sale_orders.shop_id', getSessionBranch())
                        ->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.user_id')
                        ->select(DB::raw('sale_orders.user_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
                        $users = getUserForFilter(getSessionBranch());
            }else{
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($user_id, function ($query,$user_id) {
                            $query->where('sale_orders.user_id',$user_id);
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.user_id')
                        ->select(DB::raw('sale_orders.user_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
                        $users = getUserForFilter();
            }
        }
        $pdf = Pdf::loadView('Admin.pdf.user', $data);

        return $pdf->download('user-wise.pdf');
    }

    public function customer_wise(Request $request)
    {
        return Excel::download(new CustomerWiseExport($request), 'customer-excel.xlsx');
    }

    public function customer_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $customer_id = $request->customer_id;

        if(auth()->user()->branch_id)
        {
            $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($customer_id, function ($query,$customer_id) {
                    $query->where('sale_orders.customer_id',$customer_id);
                })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->where('sale_orders.customer_id','>','0')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.customer_id')
                ->select(DB::raw('sale_orders.customer_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                ->get();
        }
        else{
            if(getSessionBranch()){
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($customer_id, function ($query,$customer_id) {
                            $query->where('sale_orders.customer_id',$customer_id);
                        })->where('sale_orders.shop_id', getSessionBranch())
                        ->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->where('sale_orders.customer_id','>','0')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.customer_id')
                        ->select(DB::raw('sale_orders.customer_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }else{
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($customer_id, function ($query,$customer_id) {
                            $query->where('sale_orders.customer_id',$customer_id);
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->where('sale_orders.customer_id','>','0')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.customer_id')
                        ->select(DB::raw('sale_orders.customer_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }
        }
        $pdf = Pdf::loadView('Admin.pdf.customer', $data);

        return $pdf->download('customer-wise.pdf');
    }

    public function driver_wise(Request $request)
    {
        return Excel::download(new DriverWiseExport($request), 'driver-wise.xlsx');
    }

    public function driver_wise_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $driver_id = $request->driver_id;

        if(auth()->user()->branch_id)
        {
            $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($driver_id, function ($query,$driver_id) {
                    $query->where('sale_orders.driver_id',$driver_id);
                })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->where('sale_orders.driver_id','>','0')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.driver_id')
                ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                ->get();

        }
        else{
            if(getSessionBranch()){
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($driver_id, function ($query,$driver_id) {
                            $query->where('sale_orders.driver_id',$driver_id);
                        })->where('sale_orders.shop_id', getSessionBranch())
                        ->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->where('sale_orders.driver_id','>','0')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.driver_id')
                        ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();

            }else{
                $data['data'] = SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($driver_id, function ($query,$driver_id) {
                            $query->where('sale_orders.driver_id',$driver_id);
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->where('sale_orders.driver_id','>','0')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.driver_id')
                        ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();

            }
        }
        $pdf = Pdf::loadView('Admin.pdf.driver', $data);

        return $pdf->download('driver-wise.pdf');
    }

    public function stock(Request $request)
    {
        return Excel::download(new StockWiseExport($request), 'stock-manage.xlsx');
    }

    public function stock_print(Request $request)
    {

        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['item_id'] = $item_id = $request->item_id;
        $data['action_type'] = $action_type = $request->action_type;
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] = DB::table('stock_management_history')
                        ->when($branch_id, function ($query,$branch_id) {
                            $query->where('shop_id',$branch_id);
                        })
                        ->when($action_type, function ($query,$action_type) {
                            $query->where('action_type',$action_type);
                        })
                        ->when($item_id, function ($query,$item_id) {
                            $query->where('item_price_id',$item_id);
                        })
                        ->whereBetween('date_added', [$from_date, $to_date])->orderBy('id','desc')->get();

        $pdf = Pdf::loadView('Admin.pdf.stock', $data);

        return $pdf->download('stock-manage.pdf');
    }

    public function purchase_wise(Request $request)
    {
        return Excel::download(new PurchaseWiseExport($request), 'purchase-wise.xlsx');
    }

    public function purchase_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        $supplier_id = $request->supplier_id;
        $payment_status = $request->payment_status;

        if(auth()->user()->branch_id)
        {
            $data['data'] = Purchase::where('shop_id', auth()->user()->branch_id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->when($supplier_id, function ($query,$supplier_id) {
                        $query->where('supplier_id',$supplier_id);
                    })->when($payment_status, function ($query,$payment_status) {
                        $query->where('payment_status',$payment_status);
                    })->get();

        }
        else{
            if(getSessionBranch()){
                $data['data'] = Purchase::where('shop_id', getSessionBranch())
                        ->whereBetween('created_at', [$from_date, $to_date])
                        ->when($supplier_id, function ($query,$supplier_id) {
                            $query->where('supplier_id',$supplier_id);
                        })->when($payment_status, function ($query,$payment_status) {
                            $query->where('payment_status',$payment_status);
                        })->get();

            }else{
                $data['data'] = Purchase::when($supplier_id, function ($query,$supplier_id) {
                            $query->where('supplier_id',$supplier_id);
                        })->when($payment_status, function ($query,$payment_status) {
                            $query->where('payment_status',$payment_status);
                        })
                        ->whereBetween('created_at', [$from_date, $to_date])->get();

            }
        }
        $pdf = Pdf::loadView('Admin.pdf.purchase', $data);

        return $pdf->download('purchase-wise.pdf');
    }

    public function perfomance(Request $request)
    {
        return Excel::download(new PerfomanceWiseExport($request), 'perfomance-wise.xlsx');
    }

    public function perfomance_print(Request $request)
    {
        $data['from_date'] = $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $data['to_date'] = $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

        $item_id = $request->item_id;

        if(auth()->user()->branch_id)
        {
            // DB::enableQueryLog();
            $data['data'] =  SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->when($item_id, function ($query,$item_id) {
                    $query->where('sale_order_items.price_size_id',$item_id);
                })
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.price_size_id')
                ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                ->orderBy('total_price','desc')
                ->get();//dd($data['data']);
                // dd(DB::getQueryLog());
        }
        else{
            if(getSessionBranch()){
                $data['data'] =  SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })->where('sale_orders.shop_id', getSessionBranch())
                    ->when($item_id, function ($query,$item_id) {
                        $query->where('sale_order_items.price_size_id',$item_id);
                    })
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.price_size_id')
                    ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                    ->orderBy('total_price','desc')
                    ->get();
            }else{
                $data['data'] =  SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })
                    ->when($item_id, function ($query,$item_id) {
                        $query->where('sale_order_items.price_size_id',$item_id);
                    })
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.price_size_id')
                    ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                    ->orderBy('total_price','desc')
                    ->get();
            }
        }
        $pdf = Pdf::loadView('Admin.pdf.perfomance', $data);

        return $pdf->download('perfomance.pdf');
    }

    public function settle_sale(Request $request)
    {
        return Excel::download(new SettleSaleExport($request), 'settle-sale.xlsx');
    }

    public function settle_sale_print(Request $request)
    {

        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['branch_id'] = $branch_id = $this->getBranch();

        $data['data'] =  SettleSale::when($branch_id, function ($query,$branch_id) {
                            $query->where('shop_id',$branch_id);
                        })->whereBetween('settle_date', [$from_date, $to_date])->orderBy('id','desc')
                        ->get();

        $pdf = Pdf::loadView('Admin.pdf.settle-sale', $data);

        return $pdf->download('settle-sale.pdf');
    }

    public function expense_wise(Request $request)
    {
        return Excel::download(new ExpenseExport($request), 'expense.xlsx');
    }

    public function expense_print(Request $request)
    {

        $data['from_date'] = $from_date = $this->getFromdate($request);
        $data['to_date'] = $to_date = $this->getTodate($request);
        $data['branch_id'] = $branch_id = $this->getBranch();
        $data['payment_status'] = $payment_status = $request->payment_status;

        $data['data'] =  Expense::when($branch_id, function ($query,$branch_id) {
                            $query->where('branch_id',$branch_id);
                        })->when($payment_status, function ($query,$payment_status) {
                            $query->where('payment_status',$payment_status);
                        })
                        ->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')
                        ->get();

        $pdf = Pdf::loadView('Admin.pdf.expense', $data);

        return $pdf->download('expense.pdf');
    }
}
