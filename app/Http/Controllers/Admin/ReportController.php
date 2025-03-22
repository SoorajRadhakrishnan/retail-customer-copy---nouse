<?php

namespace App\Http\Controllers\Admin;

use App\Models\PayBack;
use App\Models\SaleOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\SettleSale;
use App\Models\Admin\Driver;
use App\Models\Admin\ItemPrice;

class ReportController extends Controller
{
    public function getFromDate($request)
    {
        return (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
    }

    public function getToDate($request)
    {
        return (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
    }

    public function bill_wise(Request $request)
    {
        if (!(checkUserPermission('bill_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $customer = $request->customer;
        $receipt_id = $request->receipt_id;
        $branch_id = $this->getBranchId();
        $customers = getCustomerall($branch_id);

        $data = SaleOrders::whereBetween('ordered_date', [$from_date, $to_date])
            ->where('status', '!=', 'hold')
            ->where('payment_status', 'paid')
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('shop_id', $branch_id);
            })
            ->when($customer, function ($query, $customer) {
                $query->where('customer_id', $customer);
            })
            ->when($receipt_id, function ($query, $receipt_id) {
                $query->where('receipt_id', $receipt_id);
            })
            ->get();

        return view('Admin.Report.bill-wise', compact('data', 'customers'));
    }

    public function category_wise(Request $request)
    {
        if (!(checkUserPermission('category_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $category = $request->category;
        $branch_id = $this->getBranchId();
        $categories = categoryList($branch_id);

        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
        })
            ->when($category, function ($query, $category) {
                $query->where('sale_order_items.category_id', $category);
            })
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('shop_id', $branch_id);
            })
            ->where('sale_orders.status', '!=', 'hold')
            ->where('sale_orders.payment_status', 'paid')
            ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
            ->groupBy('sale_order_items.category_id')
            ->groupBy('sale_orders.shop_id')
            ->select(DB::raw('sale_order_items.category_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sale_orders.shop_id'))
            ->get();

        return view('Admin.Report.category-wise', compact('data', 'categories'));
    }

    public function item_wise(Request $request)
    {
        if (!(checkUserPermission('item_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $item = $request->item_id;
        $branch_id = $this->getBranchId();

        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->when($item, function ($query, $item) {
                $query->where('sale_order_items.price_size_id', $item);
            })->when($branch_id, function ($query,$branch_id) {
                    $query->where('sale_orders.shop_id',$branch_id);
            })->where('sale_orders.status', '!=', 'hold')
                ->where('sale_orders.payment_status', 'paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.price_size_id')
                ->groupBy('sale_orders.shop_id')
                ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.cost_price * sale_order_items.qty) as cost_price,sum(sale_order_items.qty) total_qty,sale_orders.shop_id'))
                ->get();
        $items = getAllItem($branch_id);

        return view('Admin.Report.item-wise', compact('data', 'items'));
    }

    public function order_type_wise(Request $request)
    {
        // Check for user permissions
        if (!(checkUserPermission('order_type_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $order_type = $request->order_type; // Getting the order_type from the request
        $branch_id = $this->getBranchId();
        // Retrieve data based on the filters
        $data = SaleOrders::when($branch_id, function ($query, $branch_id) {
                    $query->where('shop_id', $branch_id);
                })->where('status', '!=', 'hold')
                ->where('payment_status', 'paid')
                ->whereBetween('ordered_date', [$from_date, $to_date])
                // Apply the order_type filter if it's provided in the request
                ->when($order_type, function ($query, $order_type) {
                    $query->where('order_type', $order_type);
                })->groupBy('order_type')->groupBy('shop_id')
                ->select(DB::raw('order_type, count(*) as counts, sum(with_tax) as with_tax, sum(without_tax) as without_tax, sum(discount) as discount,shop_id'))->get();

        // Return the view with data
        return view('Admin.Report.order-type-wise', compact('data'));
    }
    public function staff_wise(Request $request)
    {
        if (!(checkUserPermission('staff_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $branch_id = $this->getBranchId();

        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->when($branch_id, function ($query, $branch_id) {
                $query->where('sale_orders.shop_id', $branch_id);
            })
            ->where('sale_orders.status', '!=', 'hold')
            ->where('sale_orders.payment_status', 'paid')
            ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
            ->groupBy('sale_orders.staff_id')
            ->groupBy('sale_orders.shop_id')
            ->select(DB::raw('sale_orders.staff_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sale_orders.shop_id'))
            ->get();

        return view('Admin.Report.staff-wise', compact('data'));
    }

    public function user_wise(Request $request)
    {
        if (!(checkUserPermission('user_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $user_id = $request->user_id;
        $branch_id = $this->getBranchId();

        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($user_id, function ($query, $user_id) {
                    $query->where('sale_orders.user_id', $user_id);
                })->when($branch_id, function ($query, $branch_id) {
                    $query->where('sale_orders.shop_id', $branch_id);
                })->where('sale_orders.status', '!=', 'hold')
                ->where('sale_orders.payment_status', 'paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.user_id')
                ->groupBy('sale_orders.shop_id')
                ->select(DB::raw('sale_orders.user_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sale_orders.shop_id'))
                ->get();
        $users = getUserForFilter($branch_id);

        return view('Admin.Report.user-wise', compact('data', 'users'));
    }

    public function customer_wise(Request $request)
    {

        if (!(checkUserPermission('customer_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $customer_id = $request->customer_id;
        $branch_id = $this->getBranchId();
        $customers = getCustomerForFilter($branch_id);


        $data = SaleOrders::when($branch_id, function ($query, $branch_id) {
                    $query->where('shop_id', $branch_id);
                })->when($customer_id, function ($query, $customer_id) {
                    $query->where('customer_id', $customer_id);
                })->where('status', '!=', 'hold')
                ->where('payment_status', 'paid')
                ->where('customer_id', '>', '0')
                ->whereBetween('ordered_date', [$from_date, $to_date])
                ->groupBy('customer_id')
                ->groupBy('shop_id')
                ->select(DB::raw('customer_id,count(*) as counts,sum(with_tax) as with_tax, sum(without_tax) as without_tax,sum(discount) as discount,shop_id'))
                ->get();

        return view('Admin.Report.customer', compact('data', 'customers'));
    }
    public function payback_log(Request $request)
    {
        // Date handling: from_date and to_date, with default values for the current date
        $from_date = $request->from_date ? $request->from_date . ' 00:00:00' : date('Y-m-d 00:00:00');
        $to_date = $request->to_date ? $request->to_date . ' 23:59:59' : date('Y-m-d 23:59:59');

        // Customer filtering: customer_id, if provided
        $customer_id = $request->customer_id;

        try {
            // Fetch the data from the "pay_back" table with left joins
            $paybacks = PayBack::select(
                    'pay_back.*',
                    'items.item_name as item_name',
                    'users.name as user_name',
                    'sale_orders.customer_id as customer_id',
                    'customers.customer_name as customer_name'
                )
                ->join('items', 'pay_back.item_id', '=', 'items.id') // Join with items table
                ->join('users', 'pay_back.user_id', '=', 'users.id') // Join with users table
                ->leftJoin('sale_orders', 'pay_back.receipt_id', '=', 'sale_orders.receipt_id') // Left join with sale_orders
                ->leftJoin('customers', 'sale_orders.customer_id', '=', 'customers.id') // Left join with customers
                ->when($customer_id, function ($query, $customer_id) {
                    // Apply the customer_id filter if provided
                    return $query->where('sale_orders.customer_id', $customer_id);
                })
                ->whereBetween('payback_date', [$from_date, $to_date]) // Date range filter
                ->orderBy('payback_date', 'desc') // Order by date, newest first
                ->get();

            // Fetch distinct customers from the sale_orders table
            $customers = SaleOrders::select('customer_id', 'customers.customer_name')
                ->leftJoin('customers', 'sale_orders.customer_id', '=', 'customers.id') // Left join to get customer names
                ->distinct()
                ->get();

            // Return the view with the filtered payback data and customer list
            return view('Admin.Report.payback-log', compact('paybacks', 'customers', 'from_date', 'to_date', 'customer_id'));

        } catch (\Exception $e) {
            \Log::error('Error fetching payback log: ' . $e->getMessage());
            return redirect('admin/dashboard')->withMessage('Error fetching payback log');
        }
    }



    public function driver_wise(Request $request)
    {

        if (!(checkUserPermission('driver_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $driver_id = $request->driver_id;
        $branch_id = $this->getBranchId();

        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($driver_id, function ($query, $driver_id) {
                    $query->where('sale_orders.driver_id', $driver_id);
                })->when($branch_id, function ($query,$branch_id) {
                    $query->where('sale_orders.shop_id',$branch_id);
                })->where('sale_orders.status', '!=', 'hold')
                ->where('sale_orders.payment_status', 'paid')
                ->where('sale_orders.driver_id', '>', '0')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.driver_id')
                ->groupBy('sale_orders.shop_id')
                ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,shop_id'))
                ->get();
        $drivers = getDriverForFilter($branch_id);

        return view('Admin.Report.driver', compact('data', 'drivers'));
    }

    public function purchase_wise(Request $request)
    {
        if (!(checkUserPermission('purchase_wise_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $supplier_id = $request->supplier_id;
        $payment_status = $request->payment_status;
        $branch_id = $this->getBranchId();

        $data = Purchase::when($branch_id, function ($query,$branch_id) {
                    $query->where('shop_id',$branch_id);
                })->whereBetween('created_at', [$from_date, $to_date])
                ->when($supplier_id, function ($query, $supplier_id) {
                    $query->where('supplier_id', $supplier_id);
                })->when($payment_status, function ($query, $payment_status) {
                    $query->where('payment_status', $payment_status);
                })->get();
        $suppliers = getSuppliers($branch_id);

        return view('Admin.Report.purchase', compact('data', 'suppliers', 'payment_status'));
    }

    public function stock_wise(Request $request)
    {
        if (!(checkUserPermission('stock_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $item_id = $request->item_id;
        $action_type = $request->action_type;
        $branch_id = $this->getBranchId();
        $items = getAllItem($branch_id);

        $data = DB::table('stock_management_history')
                ->when($branch_id, function ($query, $branch_id) {
                    $query->where('shop_id', $branch_id);
                })
                ->when($item_id, function ($query, $item_id) {
                    $query->where('item_price_id', $item_id);
                })
                ->when($action_type, function ($query, $action_type) {
                    $query->where('action_type', $action_type);
                })
                ->whereBetween('date_added', [$from_date, $to_date])->orderBy('id', 'desc')->get();

        return view('Admin.Report.stock_manage', compact('data', 'items'));
    }
    // public function minimum_stock(Request $request)
// {
//     if ((app('appSettings')['Minimum-stock'])->value == 'no'){
//         return redirect('admin/dashboard')->withMessage('Unauthorized Access');
//     }

    //     // Get current date with time set to the end of the day
//     $to_date = date('Y-m-d 23:59:59');

    //     // Set $from_date based on the request or default to a very early date to ensure all products are covered
//     $from_date = (isset($request->from_date) && $request->from_date != '')
//                     ? $request->from_date . " 00:00:00"
//                     : '2000-01-01 00:00:00'; // Defaulting to an early date

    //     $item_id = $request->item_id;
//     $action_type = $request->action_type;
//     $branch_id = $this->getBranch();
//     $items = getAllItem($branch_id);

    //     // Fetch data with a join to the items table
//     $data = DB::table('stock_management_history as smh')
//         ->join('items as i', 'smh.item_id', '=', 'i.id') // Change to use item_id
//         ->join(DB::raw('(SELECT item_id, MAX(date_added) as latest_date FROM stock_management_history GROUP BY item_id) as latest'), function($join) {
//             $join->on('smh.item_id', '=', 'latest.item_id')
//                  ->on('smh.date_added', '=', 'latest.latest_date');
//         })
//         ->when($branch_id, function ($query, $branch_id) {
//             $query->where('smh.shop_id', $branch_id);
//         })
//         ->when($item_id, function ($query, $item_id) {
//             $query->where('smh.item_id', $item_id);
//         })
//         ->when($action_type, function ($query, $action_type) {
//             $query->where('smh.action_type', $action_type);
//         })
//         ->whereBetween('smh.date_added', [$from_date, $to_date])
//         ->whereColumn('smh.closing_stock', '<', 'i.minimum_qty') // Filter using minimum_qty from items
//         ->where('smh.closing_stock', '>', 0) // Ensure closing_stock is greater than 0
//         ->where('i.minimum_qty', '>', 0) // Ensure minimum_qty is greater than 0
//         ->orderBy('smh.date_added', 'desc') // Order by date_added
//         ->select('smh.*', 'i.item_name', 'i.minimum_qty') // Select required fields
//         ->limit(10) // Limit the results to 10
//         ->get();

    //     // dd($data);

    //     // Pass the data to the view
//     return view('Admin.Report.minimum-stock', compact('data', 'items', 'from_date', 'to_date', 'item_id', 'action_type', 'branch_id'));
// }

public function minimum_stock(Request $request)
{
    if ((app('appSettings')['Minimum-stock'])->value == 'no') {
        return redirect('admin/dashboard')->withMessage('Unauthorized Access');
    }

    // Get current date with time set to the end of the day
    $to_date = date('Y-m-d 23:59:59');

    // Set $from_date based on the request or default to a very early date to ensure all products are covered
    $from_date = (isset($request->from_date) && $request->from_date != '')
        ? $request->from_date . " 00:00:00"
        : '2000-01-01 00:00:00';

    $item_id = $request->item_id;
    $action_type = $request->action_type;
    $branch_id = $this->getBranchId();
    $items = getAllItem($branch_id);

    // Fetch data for items below minimum stock threshold using the stock level from item_price table
    $minimumStockData = DB::table('items as i')
        ->join('item_prices as ip', 'i.id', '=', 'ip.item_id')
        ->whereColumn('ip.stock', '<=', 'i.minimum_qty')
        ->when($branch_id, function ($query, $branch_id) {
            $query->where('i.branch_id', $branch_id);
        })
        ->when($item_id, function ($query, $item_id) {
            $query->where('i.id', $item_id);
        })
        ->select('i.id', DB::raw('UPPER(i.item_name) as item_name'), 'i.minimum_qty', 'ip.stock as closing_stock')
        ->orderBy('ip.updated_at', 'desc')
        ->limit(10)
        ->get();

    // Fetch items that are not in item_price (no stock info available)
    $notInStockPriceData = DB::table('items as i')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('item_prices as ip')
                ->whereRaw('ip.item_id = i.id');
        })
        ->when($branch_id, fn($query) => $query->where('i.branch_id', $branch_id))
        ->select('i.id', DB::raw('UPPER(i.item_name) as item_name'), 'i.minimum_qty', DB::raw('NULL as closing_stock'))
        ->get();

    // Merge the two result sets and sort alphabetically by item_name
    $combinedData = $minimumStockData->merge($notInStockPriceData)
        ->sortBy('item_name') // Sort the merged collection alphabetically by item_name
        ->values(); // Reindex the sorted collection

    // Pass the merged data to the view
    return view('Admin.Report.minimum-stock', compact('combinedData', 'items', 'from_date', 'to_date', 'item_id', 'action_type', 'branch_id'));
}


      public function wastage_usage(Request $request)
    {
        // Check if wastage-usage feature is enabled
        if ((app('appSettings')['wastage-usage'])->value == 'no') {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        // Get current date with time set to the end of the day
        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $branch_id = $this->getBranchId();

        // Get the filters from the request
        $item_id = $request->item_id;
        $user_id = $request->user_id;

        // Fetch all items and users for the dropdowns
        $items = getAllItem($branch_id);
        $users = DB::table('users')->select('id', 'name')->where('branch_id', $branch_id)->get();

        // Build the query to fetch wastage usage data
        $query = DB::table('wastage_usage')
            ->select('wastage_usage.*', 'users.name as user_name', 'items.item_name as item_name')
            ->join('users', 'wastage_usage.user_id', '=', 'users.id')
            ->join('items', 'wastage_usage.item_id', '=', 'items.id');

        // Apply filters if they are provided in the request
        if ($request->has('item_id') && !empty($request->item_id)) {
            $query->where('wastage_usage.item_id', $request->item_id);
        }

        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('wastage_usage.user_id', $request->user_id);
        }

        if ($request->has('from_date') && $request->has('to_date') && !empty($request->from_date) && !empty($request->to_date)) {
            $query->whereBetween('wastage_usage.created_at', [$request->from_date, $request->to_date]);
        }

        // Get the filtered results
        $wastageUsageData = $query->get();
        // dd($wastageUsageData);
                // Pass the data to the view
        return view('Admin.Report.wastage_usage', [
            'items' => $items,
            'users' => $users, // Fetch users from DB
            'wastageUsageData' => $wastageUsageData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'item_id' => $item_id, // Pass the selected item id
            'user_id' => $user_id  // Pass the selected user id
        ]);
    }



  public function available_stock(Request $request)
    {
        if (!(checkUserPermission('stock_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $item_type = $request->item_type;
        $price_id = $request->price_id;
        $branch_id = $this->getBranchId();

        $items = ItemPrice::when($branch_id, function ($query,$branch_id) {
                    $query->where('branch_id',$branch_id);
                })->when($item_type, function ($query, $item_type) {
                    $query->where('price_item_type', $item_type);
                })->when($price_id, function ($query, $price_id) {
                    $query->where('id', $price_id);
                })->get();

        $itemList = getAllItem($branch_id);

        return view('Admin.Report.available_stock', compact('items', 'item_type', 'price_id', 'itemList'));
    }

    public function perfomance_wise(Request $request)
    {
        if (!(checkUserPermission('perfomance_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $item_id = $request->item_id;
        $branch_id = $this->getBranchId();


        $data = SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->when($branch_id, function ($query,$branch_id) {
                    $query->where('sale_orders.shop_id',$branch_id);
                })->when($item_id, function ($query, $item_id) {
                    $query->where('sale_order_items.price_size_id', $item_id);
                })->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.price_size_id')
                ->groupBy('sale_orders.shop_id')
                ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty,shop_id'))
                ->orderBy('total_price', 'desc')
                ->get();

        $items = getAllItem($branch_id);

        return view('Admin.Report.perfomance', compact('data', 'items'));
    }

    public function settle_sale(Request $request)
    {
        if (!(checkUserPermission('settle_sale_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $branch_id = $this->getBranchId();

        $data = SettleSale::when($branch_id, function ($query,$branch_id) {
                    $query->where('shop_id',$branch_id);
                })
                ->whereBetween('settle_date', [$from_date, $to_date])->orderBy('id', 'desc')
                ->get();

        return view('Admin.Report.settle_sale', compact('data'));
    }

    public function settle_sale_re_print(Request $request,SettleSale $settle_sale)
    {
        $shop_id = $request->shop;
        return view("Admin.Report.settle-print", compact('settle_sale', 'shop_id'));
    }

    public function supplier()
    {
        if(!(checkUserPermission('supplier_outstanding_report')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $branch_id = $this->getBranchId();

        $data = Purchase::when($branch_id, function ($query, $branch_id) {
            $query->where('shop_id', $branch_id);
        })
        ->whereIn('payment_status', ['un_paid', 'partial_paid'])  // Include unpaid and partial paid statuses
        ->where('status', 'received')
        ->select(DB::raw('SUM(total_amount - paid_amount) as total_pending, supplier_id, shop_id'))
        ->groupBy('supplier_id')
        ->groupBy('shop_id')
        ->get();



        return view("Admin.Report.supplier-amount", compact('data'));
    }

    public function customer()
    {
        if(!(checkUserPermission('customer_outstanding_report')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $branch_id = $this->getBranchId();

        $sql = '';
        if ($branch_id) {
            $sql = "AND shop_id = '$branch_id' ";
        }
        $data = DB::select("SELECT customer_id,shop_id,
                        SUM(CASE WHEN type='credit' OR type='cod-credit' THEN amount END) as credit,
                        SUM(CASE WHEN type='debit' THEN amount END) as debit FROM credit_sale WHERE 1 " . $sql . " GROUP BY customer_id,shop_id ORDER BY customer_id DESC");

        // $data = DB::table('credit_sale')->when($branch_id, function ($query,$branch_id) {
        //             $query->where('shop_id',$branch_id);
        //         })->where('payment_status','un_paid')
        //         ->where('status','received')
        //         ->select(DB::raw('SUM(amount) as total_pending,customer_id,shop_id'))
        //         ->groupBy('customer_id')->groupBy('shop_id')->get();

        return view("Admin.Report.customer-amount", compact('data'));
    }

    public function expense(Request $request)
    {
        if(!(checkUserPermission('expense_report')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $branch_id = $this->getBranchId();
        $payment_status = $request->payment_status;
        $expense_cat_id = $request->expense_cat_id;
        $expenseCats = expenseCatList($branch_id);


        $data = Expense::when($branch_id, function ($query, $branch_id) {
                    $query->where('branch_id', $branch_id);
                })->when($expense_cat_id, function ($query, $expense_cat_id) {
                    $query->where('expense_cat_id', $expense_cat_id);
                })->when($payment_status, function ($query, $payment_status) {
                    $query->where('payment_status', $payment_status);
                })->whereBetween('created_at', [$from_date, $to_date])->orderBy('id', 'desc')->get();

        return view('Admin.Report.expense', compact('data', 'expenseCats'));
    }

    public function profit_loss(Request $request)
    {

        if (!(checkUserPermission('profit_loss_report'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }

        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);
        $branch_id = $this->getBranchId();

        $expense = Expense::when($branch_id, function ($query, $branch_id) {
            $query->where('branch_id', $branch_id);
        })->where('payment_status', 'paid')
            ->select(DB::raw('SUM(total_amount) as total_amount'))
            ->whereBetween('created_at', [$from_date, $to_date])
            ->first();

        $purchase = Purchase::when($branch_id, function ($query, $branch_id) {
            $query->where('shop_id', $branch_id);
        })->where('payment_status', 'paid')
            ->select(DB::raw('SUM(total_amount) as total_amount'))
            ->whereBetween('created_at', [$from_date, $to_date])
            ->first();

        $sale = SaleOrders::whereBetween('ordered_date', [$from_date, $to_date])
            ->where('status', '!=', 'hold')
            ->where('payment_status', 'paid')
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('shop_id', $branch_id);
            })->select(DB::raw('SUM(with_tax) as total_amount'))
            ->first();

        return view('Admin.Report.profit_loss', compact('expense', 'sale', 'purchase'));
    }

    public function driver(Request $request)
    {
        if(!(checkUserPermission('driver_outstanding_report')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        // Set date range from request or use today's date if not provided
        $from_date = $this->getFromDate($request);
        $to_date = $this->getToDate($request);

        // Get the current branch ID
        $branch_id = $this->getBranchId();

        // Fetch sales orders for deliveries that are 'out for delivery' and within the specified date range
        $data = SaleOrders::whereBetween('ordered_date', [$from_date, $to_date])
            ->where('status', 'out_for_delivery')
            ->where('order_type', 'delivery')
            ->when($branch_id, function ($query, $branch_id) {
                $query->where('shop_id', $branch_id); // Apply branch filter if branch ID exists
            })
            ->select(DB::raw('SUM(with_tax) as total_amount, driver_id'))
            ->groupBy('driver_id')
            ->get();

        // Include driver names in the data
        foreach ($data as $order) {
            // If a driver is associated with the order, get the driver name
            $order->driver_name = optional(Driver::find($order->driver_id))->driver_name ?? 'No Driver';
        }
        // dd($data);
// dd($from_date, $to_date);
        // Return the view with the data
        return view("Admin.Report.driver-amount", compact('data', 'from_date', 'to_date'));
    }
}
