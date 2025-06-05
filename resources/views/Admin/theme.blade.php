<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="POS Web Application for Retail ">
    <meta name="author" content="zaadPlatform">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.webp') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- <link href="assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet"> -->
    <link href="{{ url('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/typicons.font/typicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css"> -->
    <link rel="stylesheet" href="{{ url('assets/css/azia.css?v=') }}">
    <link href="{{ url('assets/lib/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/lib/select2/dist/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}?v=">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="{{ url('assets/lib/jquery/jquery.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="{{ url('assets/lib/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/swipe.js') }}"></script>
    @section('style')

    @show
    <style>
        .card-body-bg-icon {
            border-left: 5px solid #3b4863;
        }

        .card-body-bg-icon img {
            position: absolute;
            right: 5px;
            top: 5px;
            width: 30px;
            /* transform: rotate(-45deg); */
        }

      .overflow-thin-scroll {
    max-height: 500px;
    overflow-y: auto; /* Enables vertical scrolling */
    scrollbar-width: thin; /* Hide scrollbar for Firefox */
        scrollbar-color: #f4f5f8 #fff;
        scrollbar-arrow-color: #3b4863

}

.overflow-thin-scroll::-webkit-scrollbar {
    width: 1px; /* Width of the scrollbar */
    height: 1px; /* Height of the scrollbar */
    background: transparent; /* Make scrollbar transparent */
}

.overflow-thin-scroll::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb */
    border-radius: 10px; /* Rounded corners */
    border: 2px solid #f1f1f1; /* Creates a padding around the thumb */
}

/* For Webkit-based browsers to create top and bottom rounded ends */
.overflow-thin-scroll::-webkit-scrollbar-thumb:vertical {
    border-radius: 10px;
}
    </style>
</head>

<body>
    <div class="az-header">
        <div class="container-fluid">
            <div class="az-header-left">
                <a href="{{ url('admin/dashboard') }}" class="az-logo mt-1 animate__animatedd animate__flipInX">
                    <img src="{{ url('assets/img/zaadDocs.png') }}" class="d-none d-xl-block">
                    <img src="{{ url('assets/img/zaadDocs-m.png') }}" class="d-block d-xl-none" style="width: 130px;">
                </a>
                <a href="javascript:void(0)" id="azMenuShow" class="az-header-menu-icon d-xl-none"><span></span></a>
            </div>
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="{{ url('admin/dashboard') }}" class="az-logo w-100">
                        <img src="{{ url('assets/img/appicon.webp') }}" class="d-block d-xl-none px-3 mt-3 mt-2"
                            style="width: 100%;">
                        <span></span></a>
                    @if (auth()->user()->branch)
                        <h5 class="text-center mb-2 text-truncate">
                            {{ Str::ucfirst(auth()->user()->branch->branch_name) }}</h5>
                    @endif
                    <!-- <a href="javascript:void(0)" class="close">&times;</a> -->
                    <a href="javascript:void(0)" id="azMenuShow" class="az-header-menu-icon d-xl-none"><span></span></a>
                </div>
                <ul class="nav animate__animatedd animate__flipInX">
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link nav-link-m">
                            <span class="material-symbols-outlined">
                                <!-- dashboard -->
                                <i class="fa fa-th"></i> </span> Dashboard</a>
                    </li>
                    {{-- @dd(checkUserPermission('production')); --}}

                    @if (checkUserPermission('master'))

                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                    class="material-symbols-outlined">
                                    <!-- edit_square -->
                                    <i class="fa fa-edit"></i></span>Master</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">
                                            @if (checkUserPermission('category'))
                                                <a href="{{ url('admin/category') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/category.svg') }}" class="mr-1">
                                                    Categories
                                                </a>
                                            @endif

                                            @if (checkUserPermission('items'))
                                                <a href="{{ url('admin/item') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/items.svg') }}" class="mr-1">
                                                    Items
                                                </a>
                                            @endif

                                            @if (checkUserPermission('barcode_print') && app('appSettings')['barcode']->value == 'yes')
                                                <a href="{{ url('admin/barcode-print') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/barcode.svg') }}" class="mr-1">
                                                    Barcode Print
                                                </a>
                                            @endif
                                            @if (checkUserPermission('units'))
                                                <a href="{{ url('admin/unit') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/units.svg') }}" class="mr-1">
                                                    Units
                                                </a>
                                            @endif
                                            <a href="{{ url('admin/payment-method') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/settlesale_report.svg') }}"
                                                        class="mr-1">
                                                Payment Methods
                                            </a>
                                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('suppliers'))
                                                <a href="{{ url('admin/supplier') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/supplier.svg') }}" class="mr-1">
                                                    Suppliers
                                                </a>
                                            @endif


                                            @if (checkUserPermission('drivers') && app('appSettings')['delivery_sale']->value == 'yes')
                                                <a href="{{ url('admin/driver') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/driver.svg') }}" class="mr-1">
                                                    Drivers
                                                </a>
                                            @endif

                                            @if (checkUserPermission('staffs') && app('appSettings')['staff_pin']->value == 'yes')
                                                <a href="{{ url('admin/staff') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/staff.svg') }}" class="mr-1">
                                                    Staffs
                                                </a>
                                            @endif

                                            @if (checkUserPermission('customers'))
                                                <a href="{{ url('admin/customer') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/customer.svg') }}" " class="mr-1">
                                                    Customers
                                                </a>
 @endif

                                                    @if (checkUserPermission('expense_category'))
                                                        <a href="{{ url('admin/expense-category') }}"
                                                            class="nav-link">
                                                            <img src="{{ url('assets/icons/expense_ctgry.svg') }}"
                                                                class="mr-1">
                                                            Expense Categories
                                                        </a>
                                                    @endif
                                                    @if (app('appSettings')['production']->value == 'yes' && checkUserPermission('production'))
                                                        <a href="{{ url('admin/ingredient') }}" class="nav-link">
                                                            <img src="{{ url('assets/icons/items.svg') }}"
                                                                class="mr-1">
                                                            Add
                                                            Ingredient / Production</a>
                                                    @endif
                                                                            <a href="{{ url('admin/loyalty') }}" class="nav-link">
                                                        <img src="{{ url('assets/icons/customer.svg') }}" " class="mr-1">
                                                                Loyalty
                                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>

                    @endif

                    @if (checkUserPermission('transcations'))

                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                    class="material-symbols-outlined">
                                    <i class="fa fa-exchange"></i></span>Transaction</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">

                                            @if (checkUserPermission('sales'))
                                                <a href="{{ url('admin/sale-order') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/salesorder.svg') }}"
                                                        class="mr-1">
                                                    Recent Sales</a>
                                            @endif

                                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchases'))
                                                <a href="{{ url('admin/purchase') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/purchase.svg') }}"
                                                        class="mr-2">Purchases</a>
                                            @endif


                                            @if (checkUserPermission('expenses'))
                                                <a href="{{ url('admin/expense') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/expenses.svg') }}"
                                                        class="mr-2">Expenses</a>
                                            @endif

                                            @if (checkUserPermission('manage_stocks'))
                                                <a href="{{ url('admin/stock') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock.svg') }}"
                                                        class="mr-2">Stock</a>
                                            @endif

                                            @if (app('appSettings')['wastage-usage']->value == 'yes')
                                                <a href="{{ url('admin/wastage-usage') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1 d-none d-md-inline-block">
                                                    Wastage & Usage</a>
                                            @endif

                                            @if (checkUserPermission('stock_transfer'))
                                                <a href="{{ url('admin/stock-transfer') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1 d-none d-md-inline-block">
                                                        Stock Transfer</a>
                                            @endif
                                            {{-- @if (checkUserPermission('stock_add'))
                                                <a href="{{ url('admin/stock-add') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1 d-none d-md-inline-block">
                                                        Stock Add</a>
                                            @endif --}}
                                            <a href="{{ url('admin/inventory') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/stock.svg') }}"
                                                    class="mr-2">Stock Adjustment</a>

                                            {{-- @if (checkUserPermission('payment_transfer')) --}}
                                                <a href="{{ url('admin/payment-transfer') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1 d-none d-md-inline-block">
                                                        Payment Transfer
                                                </a>
                                            {{-- @endif --}}
                                                       @if (checkUserPermission('admin_quotation') && app('appSettings')['quotation']->value == 'yes')
                                                <a href="{{ url('admin/quotation') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/purchase.svg') }}"
                                                        class="mr-2">Quotations
                                                </a>
                                            @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>

                    @endif

                    @if (checkUserPermission('reports'))

                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                    class="material-symbols-outlined">
                                    <!-- summarize -->
                                    <i><i class="fa fa-bar-chart"></i></i> </span>Reports</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div class="overflow-thin-scroll">
                                        <nav class="nav">
                                            @if (checkUserPermission('bill_wise_report'))
                                                <a href="{{ url('admin/bill-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/bill-wise-report.svg') }}"
                                                        class="mr-1">
                                                    Bill
                                                    Wise Report</a>
                                            @endif

                                            @if (checkUserPermission('category_wise_report'))
                                                <a href="{{ url('admin/category-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/categorywise_report.svg') }}"
                                                        class="mr-1">
                                                    Category Wise Report</a>
                                            @endif

                                            @if (checkUserPermission('item_wise_report'))
                                                <a href="{{ url('admin/item-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/itemwise_report.svg') }}"
                                                        class="mr-1">
                                                    Item

                                                    Wise Report</a>
                                            @endif

                                            @if (checkUserPermission('order_type_wise_report'))
                                                <a href="{{ url('admin/order-type-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/orderwise_report.svg') }}"
                                                        class="mr-1">
                                                    Order Type Wise Report</a>
                                            @endif

                                            @if (app('appSettings')['staff_pin']->value == 'yes' && checkUserPermission('staff_wise_report'))
                                                <a href="{{ url('admin/staff-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/bill-wise-report.svg') }}"
                                                        class="mr-1">Staff
                                                    Wise Report</a>
                                            @endif


                                            @if (checkUserPermission('user_wise_report'))
                                                <a href="{{ url('admin/user-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/userwise_report.svg') }}"
                                                        class="mr-1">
                                                    User
                                                    Wise Report</a>
                                            @endif

                                            @if (app('appSettings')['delivery_sale']->value == 'yes' && checkUserPermission('driver_wise_report'))
                                                <a href="{{ url('admin/driver-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/driverwise_report.svg') }}"
                                                        class="mr-1">
                                                    Driver Wise Report</a>
                                            @endif


                                            @if (checkUserPermission('customer_wise_report'))
                                                <a href="{{ url('admin/customer-wise-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/customerwise_report.svg') }}"
                                                        class="mr-1">
                                                    Customer Wise Report</a>
                                            @endif

                                            {{-- @if (checkUserPermission('customer_wise_report')) --}}
                                            <a href="{{ url('admin/payback-log') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/customerwise_report.svg') }}"
                                                    class="mr-1">
                                                Pay Back Log</a>
                                        {{-- @endif --}}

                                            @if (checkUserPermission('perfomance_report'))
                                                <a href="{{ url('admin/perfomance-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/performance_report.svg') }}"
                                                        class="mr-1">
                                                    Perfomance Report</a>
                                            @endif

                                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchase_wise_report'))
                                                <a href="{{ url('admin/purchase-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/purchase_report.svg') }}"
                                                        class="mr-1">
                                                    Purchase Report</a>
                                            @endif

                                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchase_wise_report'))
                                            <a href="{{ url('admin/purchase-pay-log') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/purchase_report.svg') }}"
                                                    class="mr-1">
                                                Purchase Pay Log</a>
                                        @endif
                                                                                    @if (app('appSettings')['production']->value == 'yes' && checkUserPermission('production'))
                                                <a href="{{ url('admin/production_log') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/purchase_report.svg') }}"
                                                        class="mr-1">
                                                    Production Log</a>
                                            @endif
                                                <a href="{{ url('admin/points-history') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                    class="mr-1">
                                                Redeem History</a>


                                            @if (checkUserPermission('stock_report'))
                                                <a href="{{ url('admin/stock-moving-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1">
                                                    Stock moving Report</a>
                                            @endif
                                            @if (checkUserPermission('stock_report'))
                                                <a href="{{ url('admin/stock-out-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1">
                                                    Stock Out Report</a>
                                            @endif
                                            @if (app('appSettings')['Minimum-stock']->value == 'yes')
                                                <a href="{{ url('admin/Minimum-stock-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                        class="mr-1">
                                                    Minimum-stock Report</a>
                                            @endif

                                             @if (app('appSettings')['wastage-usage']->value == 'yes')
                                            <a href="{{ url('admin/wastage-usage-report') }}" class="nav-link">
                                                <img src="{{ url('assets/icons/stock_report.svg') }}"
                                                    class="mr-1 d-none d-md-inline-block">
                                                Wastage & Usage Report</a>
                                        @endif

                                            @if (checkUserPermission('settle_sale_report'))
                                                <a href="{{ url('admin/settle-sale-report') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/settlesale_report.svg') }}"
                                                        class="mr-1">
                                                    Day Closing Report</a>
                                            @endif

                                            @if (checkUserPermission('supplier_outstanding_report') && app('appSettings')['purchase']->value == 'yes')
                                                <a href="{{ url('admin/supplier-outstanding') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/supplieroutstanding_report.svg') }}"
                                                        class="mr-1">
                                                    supplier outstanding</a>
                                            @endif

                                            @if (checkUserPermission('customer_outstanding_report'))
                                                <a href="{{ url('admin/customer-outstanding') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/customeroutstanding_report.svg') }}"
                                                        class="mr-1">
                                                    Customer Outstanding</a>
                                            @endif
                                            @if (checkUserPermission('driver_outstanding_report') && app('appSettings')['delivery_sale']->value == 'yes')
                                                <a href="{{ url('admin/driver-outstanding') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/driveroutstanding_report.svg') }}"
                                                        class="mr-1">
                                                    Driver Outstanding</a>
                                            @endif
                                            @if (checkUserPermission('expense_report'))
                                                <a href="{{ url('admin/expense-report') }}" class="nav-link"><img
                                                        src="{{ url('assets/icons/expense report.svg') }}"
                                                        class="mr-1">
                                                    Expense Report</a>
                                            @endif
                                            @if (checkUserPermission('profit_loss_report'))
                                                <a href="{{ url('admin/profit-loss') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/profit_loss_report.svg') }}"
                                                        class="mr-1">
                                                    Profit Loss Report</a>
                                            @endif
                                            {{-- @if (checkThemeUserPermission('payment_book')) --}}
                                                <a href="{{ url('admin/payment-book') }}" class="nav-link">
                                                    <img src="{{ url('assets/icons/settlesale_report.svg') }}"
                                                        class="mr-1">
                                                        Cash/Bank Ledger</a>
                                            {{-- @endif --}}
                                            {{-- @if (checkUserPermission('logs'))
                                                <a href="{{ url('admin/logs') }}" class="nav-link">Logs</a>
                                            @endif --}}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="searchLi">
                        <div id="searchContainer">
                            <!-- <input type="text" id="searchInput" placeholder="Search..."> Search (ctrl+alt+f) -->
                            <input type="search" id="searchNav" placeholder="Search"
                                class="form-control py-1 rounded-10" autocomplete="off">
                            <div id="searchIcon">
                                <span class="material-symbols-outlined">
                                    search
                                </span>
                            </div>
                        </div>
                        <ul id="navList" class="shadow">
                            <li class="border-top"><a
                                    href="{{ url('admin/dashboard') }}">{{ Str::upper('Dashboard') }}</a></li>
                            @if (checkUserPermission('category'))
                                <li><a href="{{ url('admin/category') }}">{{ Str::upper('Categories') }}</a></li>
                            @endif

                            @if (checkUserPermission('items'))
                                <li><a href="{{ url('admin/item') }}">{{ Str::upper('Items') }}</a></li>
                            @endif

                            @if (checkUserPermission('barcode_print'))
                                <li><a href="{{ url('admin/barcode-print') }}">{{ Str::upper('Barcode Print') }}</a>
                                </li>
                            @endif
                            @if (checkUserPermission('units'))
                                <li><a href="{{ url('admin/unit') }}">{{ Str::upper('Units') }}</a></li>
                            @endif

                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('suppliers'))
                                <li><a href="{{ url('admin/supplier') }}">{{ Str::upper('Suppliers') }}</a></li>
                            @endif

                            @if (checkUserPermission('drivers') && app('appSettings')['delivery_sale']->value == 'yes')
                                <li><a href="{{ url('admin/driver') }}">{{ Str::upper('Drivers') }}</a></li>
                            @endif

                            @if (checkUserPermission('staffs') && app('appSettings')['staff_pin']->value == 'yes')
                                <li><a href="{{ url('admin/staff') }}">{{ Str::upper('Staffs') }}</a></li>
                            @endif

                            @if (checkUserPermission('customers'))
                                <li><a href="{{ url('admin/customer') }}">{{ Str::upper('Customers') }}</a></li>
                            @endif

                            @if (checkUserPermission('expense_category'))
                                <li><a
                                        href="{{ url('admin/expense-category') }}">{{ Str::upper('Expense Categories') }}</a>
                            @endif
                            @if (app('appSettings')['production']->value == 'yes' && checkUserPermission('production'))
                                <li><a
                                        href="{{ url('admin/ingredient') }}">{{ Str::upper('Add Ingredient / Production') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('sales'))
                                <li><a href="{{ url('admin/sale-order') }}">{{ Str::upper('Recent Sales') }}</a>
                                </li>
                            @endif

                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchases'))
                                <li><a href="{{ url('admin/purchase') }}">{{ Str::upper('Purchases') }}</a></li>
                            @endif

                            @if (checkUserPermission('expenses'))
                                <li><a href="{{ url('admin/expense') }}">{{ Str::upper('Expenses') }}</a></li>
                            @endif

                            @if (checkUserPermission('manage_stocks'))
                                <li><a href="{{ url('admin/stock') }}">{{ Str::upper('Stock') }}</a></li>
                            @endif

                            @if (checkUserPermission('stock_transfer'))
                                <li><a href="{{ url('admin/stock-transfer') }}">{{ Str::upper('Stock Transfer') }}</a></li>
                            @endif
                            @if (checkUserPermission('stock_add'))
                            <li><a href="{{ url('admin/stock-add') }}">{{ Str::upper('Stock Add') }}</a></li>
                        @endif
                            @if (checkUserPermission('bill_wise_report'))
                                <li><a
                                        href="{{ url('admin/bill-wise-report') }}">{{ Str::upper('Bill Wise Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('category_wise_report'))
                                <li><a
                                        href="{{ url('admin/category-wise-report') }}">{{ Str::upper('Category Wise Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('item_wise_report'))
                                <li><a
                                        href="{{ url('admin/item-wise-report') }}">{{ Str::upper('Item Wise Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('order_type_wise_report'))
                                <li><a
                                        href="{{ url('admin/order-type-wise-report') }}">{{ Str::upper('Order Type Wise Report') }}</a>
                                </li>
                            @endif

                            @if (app('appSettings')['staff_pin']->value == 'yes' && checkUserPermission('staff_wise_report'))
                                <li><a
                                        href="{{ url('admin/staff-wise-report') }}">{{ Str::upper('Staff Wise Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('user_wise_report'))
                                <li><a
                                        href="{{ url('admin/user-wise-report') }}">{{ Str::upper('User Wise Report') }}</a>
                            @endif

                            @if (app('appSettings')['delivery_sale']->value == 'yes' && checkUserPermission('driver_wise_report'))
                                <li><a
                                        href="{{ url('admin/driver-wise-report') }}">{{ Str::upper('Driver Wise Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('customer_wise_report'))
                                <li><a
                                        href="{{ url('admin/customer-wise-report') }}">{{ Str::upper('Customer Wise Report') }}</a>
                            @endif

                            @if (checkUserPermission('perfomance_report'))
                                <li><a
                                        href="{{ url('admin/perfomance-report') }}">{{ Str::upper('Perfomance Report') }}</a>
                            @endif

                            @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchase_wise_report'))
                                <li><a
                                        href="{{ url('admin/purchase-report') }}">{{ Str::upper('Purchase Report') }}</a>
                                </li>
                            @endif

                             @if (app('appSettings')['purchase']->value == 'yes' && checkUserPermission('purchase_wise_report'))
                            <li><a
                                    href="{{ url('admin/purchase-pay-log') }}">{{ Str::upper('Purchase Pay Log') }}</a>
                            </li>
                        @endif

                            @if (checkUserPermission('stock_report'))
                                <li><a
                                        href="{{ url('admin/stock-moving-report') }}">{{ Str::upper('Stock moving Report') }}</a>
                                </li>
                            @endif
                            @if (checkUserPermission('Minimum-stock'))
                                <li><a
                                        href="{{ url('admin/Minimum-stock-report') }}">{{ Str::upper('Minimum Stock Report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('settle_sale_report'))
                                <li><a
                                        href="{{ url('admin/settle-sale-report') }}">{{ Str::upper('Settle Sale Report') }}</a>
                            @endif

                            {{-- @if (checkUserPermission('settle_sale_report')) --}}
                            @if (checkUserPermission('supplier_outstanding_report') && app('appSettings')['purchase']->value == 'yes')
                                <li><a
                                        href="{{ url('admin/supplier-outstanding') }}">{{ Str::upper('supplier outstanding') }}</a>
                            @endif

                            @if (checkUserPermission('expense_report'))
                                <li><a
                                        href="{{ url('admin/expense-report') }}">{{ Str::upper('expense report') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('customer_outstanding_report'))
                                <li><a
                                        href="{{ url('admin/customer-outstanding') }}">{{ Str::upper('customer outstanding') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('driver_outstanding_report') && app('appSettings')['delivery_sale']->value == 'yes')
                                <li><a
                                        href="{{ url('admin/driver-outstanding') }}">{{ Str::upper('driver outstanding') }}</a>
                                </li>
                            @endif

                            @if (checkUserPermission('profit_loss_report'))
                                <li><a
                                        href="{{ url('admin/profit-loss') }}">{{ Str::upper('Profit Loss Report') }}</a>
                                </li>
                            @endif

                            {{-- @if (checkThemeUserPermission('payment_book')) --}}
                                <li><a
                                        href="{{ url('admin/payment-book') }}">{{ Str::upper('Payment Book') }}</a>
                            {{-- @endif --}}


                            {{-- @endif --}}

                            {{-- @if (checkUserPermission('logs'))
                                <li><a href="{{ url('admin/logs') }}">{{ Str::upper('Logs') }}</a></li>
                            @endif --}}
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="az-header-right animate__animatedd animate__flipInX">
                <h4 class="mt-2 text-right" style="max-width: 250px;">
                    @if (auth()->user()->branch)
                        <span class="d-block text-truncate"
                            title="">{{ Str::ucfirst(auth()->user()->branch->branch_name) }}</span>
                    @else
                        <select class="form-control rounded-10 onChange branch_select" id="branch_select"
                            name="branch_select">
                            <option value="">Select Branch</option>
                            <?php $branchList = branchList(); ?>
                            @foreach ($branchList as $branch)
                                <option value="{{ $branch->id }}"
                                    @if (getSessionBranch() == $branch->id) selected="selected" @endif>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                            {{-- <option value="1"
                            @if ('1' == optional($item)->item_type) selected="selected" @endif>
                                Salable
                        </option>
                        <option value="0"
                            @if ('0' == optional($item)->item_type) selected="selected" @endif>
                                Non Salable
                        </option> --}}
                        </select>
                    @endif
                </h4>
                <div class="dropdown az-profile-menu">
                    <a href="javascript:void(0)" class="az-img-user shadoww border rounded-10"><img
                            src="{{ url('assets/img/appicon.webp') }}" alt=""></a>
                    <div class="dropdown-menu">
                        <!-- <div class="az-dropdown-header d-sm-none">
                        <a href="javascript:void(0)" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div> -->
                        <div class="az-header-profile">
                            <div class="az-img-user shadoww border rounded-10">
                                <img src="{{ url('assets/img/appicon.webp') }}" alt="">
                            </div>
                            <h6>{{ Str::ucfirst(auth()->user()->name) }}</h6>
                            <span>{{ Str::ucfirst(auth()->user()->usertype) }}</span>
                        </div>
                        <a href="javascript:void(0)"
                            class="dropdown-item"
                            title="Change Password"
                            data-toggle="modal" data-target="#ChangePassword">
                            <span><i class="typcn typcn-pen"></i> Change Password</span>
                        </a>
                        <a href="{{ url('logout') }}" class="dropdown-item"><i
                                class="typcn typcn-power-outline"></i> Sign
                            Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="main-menu-mob"></div>
        <div class="main-menu-in">
            <!-- < ?php if ($_SESSION['SESS_ADMINTYP'] != 'admin') { ?> -->
            <!-- <a href="javascript:void(0)" class="btn btn-dark btn-block rounded-10 btn-lg py-3 newsale">NEW&nbsp;SALE</a> -->
            {{-- <a href="javascript:void(0)" class="btns rounded-10 btn-sale shadow newsale" title="New sale">
                <span>SALE</span>
            </a>
            <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 shadow dynamicPopup" data-pop="md"
                data-url="views/expenses.view.php?new" data-toggle="modal" data-target="#dynamicPopup-md"
                  title="Add expense">
                <span>EXPENSE</span>
            </a> --}}
            <!-- </a> <a href="javascript:void(0)" class="btns rounded-10 btn-lock mt-3 shadow">
                <span>LOCK</span>
            </a> -->
            {{-- <a href="javascript:void(0)" onclick="history.back();" class="btns rounded-10 btn-back mt-3 shadow"
                title="Go back to previous section">
                <!-- <span>BACK</span> -->
            </a> --}}
            {{-- <a href="javascript:void(0)" onclick="location.reload();" class="btns rounded-10 btn-reload mt-3 shadow"
                title="Relaod">
                <!-- <span>BACK</span> -->
            </a> --}}
            <!-- < ?php } ?> -->
        </div>
    </nav>
    <script>
        // $(".az-header").onSwipe(function(results) {
        //     // if (results.up == true)
        //     //     console.log("Up")
        //     if (results.right == true)
        //         $('body').toggleClass('az-header-menu-show');
        //     // if (results.down == true)
        //     //     console.log("Down")
        //     // if (results.left == true)
        //     //     console.log("Left")
        // });
        // $(".az-header").dblclick(function() {
        //     // $(".main-menu-in").focus();
        // });
    </script>
    <script>
        var input = document.getElementById("searchNav");
        var list = document.getElementById("navList");
        input.addEventListener("input", function() {
            var searchTerm = input.value.toLowerCase();
            searchTerm = searchTerm.trim();
            var items = list.getElementsByTagName("li");

            for (var i = 0; i < items.length; i++) {
                var text = items[i].textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    items[i].style.display = "block";
                } else {
                    items[i].style.display = "none";
                }
            }

            // Show/hide the list based on whether the search input has text
            list.style.display = searchTerm ? "block" : "none";
        });
    </script>

    @section('content')

    @show

    <div class="modal fade show" id="DeleteModel-md">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100"><span id="delete_message"></span></h5>
                </div>
                <form action="DELETE" id="delete-user" class="was-validated" autocomplete="off">
                    <input type="hidden" name="uuid" id="uuid" value="">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Are you sure you want to delete <span
                                                id="delete_name"></span> ..!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            {{-- <button type="submit"
                                class="btn btn-dark px-4 text-uppercase rounded-10 delete_user">Delete</button> --}}
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="newbranch" data-form="delete-user" data-type = "DELETE"
                                data-returnaction="reload" data-processing="Please wait, saving..."
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                id="delete-button">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade show" id="ChangePassword">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Change Password</h5>
                </div>
                <form id="ChangePasswordForm" class="was-validated" autocomplete="off">
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    @csrf
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Enter New Password</label>
                                        <div class="input-group mb-0">
                                            <input type="password" class="form-control" style="border-radius: 10px 0 0 10px;"
                                                id="password" name="password" placeholder="Enter your password" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-dark px-2 mt-0" type="button"
                                                    style="border-radius: 0 10px 10px 0;"
                                                    onclick="showHidePassword('pas', 'password')"><i class="fa fa-eye"
                                                        id="pas"></i></button>
                                            </div>
                                        </div>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Confirm Password</label>
                                        <div class="input-group mb-0">
                                            <input type="password" class="form-control" style="border-radius: 10px 0 0 10px;"
                                                id="password_confirmation" name="password_confirmation" placeholder="Enter your Confirm password" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-dark px-2 mt-0" type="button"
                                                    style="border-radius: 0 10px 10px 0;"
                                                    onclick="showHidePassword('pas', 'password_confirmation')"><i class="fa fa-eye"
                                                        id="pas"></i></button>
                                            </div>
                                        </div>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="adminedit" data-form="ChangePasswordForm" data-target="{{ url('admin/change-password') }}"
                                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dynamicPopup-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-sm"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-lg"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-xl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-xl"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-video" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered bg-transparent border-0">
            <div class="modal-content rounded-10 popupContent-video bg-dark border-0"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md2"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md3"> </div>
        </div>
    </div>

    <div id="if"></div>

    {{-- notification --}}
    <div class="col-notify">
        <div class="col-notify-in">
            <p id="notifyTxt"></p>
        </div>
    </div>
    {{-- notification --}}

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets/lib/notify/notify.min.js') }}"></script>
    <script src="{{ url('assets/js/azia.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- For data and time picker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- <script src="assets/js/main.min.js"></script> -->
    <script src="{{ url('assets/js/main.js?v=749508564') }}"></script>
    @if (Session::has('message'))
        <script>
            notifyme2("{{ Session::get('message') }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('#example').DataTable({
                language: {
                    search: '',
                    searchPlaceholder: "Search",
                    "emptyTable": "No Data found"
                },
                searching: false,
                paging: false,
                info: false,
                order: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        footer: true,
                        text: '<i class="fa fa-file-excel-o" style="font-size:1.2rem"></i>',
                        className: 'btn btn-dark px-3 rounded-10'
                    },
                    {
                        extend: 'pdf',
                        footer: true,
                        text: '<i class="fa fa-file-pdf-o" style="font-size:1.2rem"></i>',
                        className: 'btn btn-dark px-3 rounded-10',
                        exportOptions: {
                            columns: ':visible'
                        },
                        // customize: function(doc) {
                        //     // Set width to 100%
                        //     doc.content[1].table.widths = ['*', '*', '*'];
                        // },

                    }, {
                        extend: 'copy',
                        footer: true,
                        text: '<i class="fa fa-copy" style="font-size:1.2rem"></i>',
                        className: 'btn btn-dark px-3 rounded-10'
                    },
                    {
                        extend: 'print',
                        footer: true,
                        text: '<i class="fa fa-print" style="font-size:1.2rem"></i>',
                        className: 'btn btn-dark px-3 rounded-10'
                    }
                ]
            });
        });
    </script>

    <script>
        // $('#example').dataTable({
        //     "language": {
        //         "emptyTable": "No Data found"
        //     }
        // });



        function deletemodel(id, name, message, delete_url) {
            $('#uuid').val(id);
            $('#delete_name').text(name);
            $('#delete_message').text(message);
            $('#delete-button').attr('data-target', delete_url);
            $('#DeleteModel-md').modal('show');
        }

        $(document).on("change", ".branch_select", function(e) {
            let branch_id = $(this).val();

            $.ajax({
                url: "{{ url('admin/set-shop') }}",
                type: "GET",
                data: 'id=' + branch_id,
                dataType: "JSON",
                success: function(data) {
                    let result = JSON.parse(JSON.stringify(data));
                    if (result.status == 1) {
                        notifyme2(result.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            })
        });

        flatpickr(".datetimepicker", {
            enableTime: true,
            noCalendar: false,
            enableSeconds: true,
            dateFormat: "Y-m-d H:i:S",
            time_24hr: true,
            secondIncrement: 1,
            minuteIncrement: 1,
        });
    </script>
    @section('script')

    @show
</body>

</html>
