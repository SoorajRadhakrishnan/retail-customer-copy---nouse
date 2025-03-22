<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
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
    </style>
</head>

<body>
    <div class="az-header">
        <div class="container-fluid">
            <div class="az-header-left">
                <a href="dashboard" class="az-logo mt-1 animate__animatedd animate__flipInX">
                    <img src="assets/img/zaadDocs.png" class="d-none d-xl-block">
                    <img src="assets/img/zaadDocs-m.png" class="d-block d-xl-none" style="width: 130px;">
                </a>
                <a href="javascript:void(0)" id="azMenuShow" class="az-header-menu-icon d-xl-none"><span></span></a>
            </div>
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="dashboard" class="az-logo w-100">
                        <img src="assets/img/zaadDocs-m.png" class="d-block d-xl-none px-3 mt-3 mt-2"
                            style="width: 100%;">
                        <span></span></a>
                    <h5 class="text-center mb-2 text-truncate">
                        BRANCH NAME
                    </h5>
                    <!-- <a href="javascript:void(0)" class="close">&times;</a> -->
                </div>
                <ul class="nav animate__animatedd animate__flipInX">
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="dashboard" class="nav-link nav-link-m">
                            <span class="material-symbols-outlined">
                                dashboard
                            </span> Dashboard</a>
                    </li>
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                class="material-symbols-outlined">
                                edit_square
                            </span>Master</a>
                        <div class="az-menu-sub px-0">
                            <div class="container">
                                <div>
                                    <nav class="nav">
                                        <a href="categories/all" class="nav-link">Categories</a>
                                        <a href="services/table" class="nav-link">Services</a>
                                        <a href="payment-methods/all" class="nav-link">Payment Methods</a>
                                        <a href="customer-groups/all" class="nav-link">Customer Groups</a>
                                        <a href="customers/all" class="nav-link">Customers</a>
                                        <a href="suppliers/all" class="nav-link">SUPPLIERS</a>
                                        <a href="agents/all" class="nav-link">Agents</a>
                                        <a href="branches/all" class="nav-link">BRANCHES</a>
                                        <!-- <a href="backup" class="nav-link">Data Backup</a> -->
                                        <a href="expense-categories/all" class="nav-link">Expense Categories</a>
                                        <a href="other-ledgers/all" class="nav-link">Other Ledgers</a>
                                        <!-- <a href="expense/all" class="nav-link">Expenses</a> -->
                                        <a href="users/all" class="nav-link">Users</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                class="material-symbols-outlined">
                                contract
                            </span>Transaction</a>
                        <div class="az-menu-sub px-0">
                            <div class="container">
                                <div>
                                    <nav class="nav">
                                        <a href="javascript:void(0)" class="nav-link newsale">New Sale</a>
                                        <a href="javascript:void(0)" class="nav-link dynamicPopup" data-pop="md"
                                            data-url="views/invoices.view.php?holdlist" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >On Hold</a>
                                        <a href="sales" class="nav-link">Sales</a>
                                        <a href="quotations" class="nav-link">Quotations</a>
                                        <a href="pending" class="nav-link">Pending</a>
                                        <a href="duplicates" class="nav-link">Duplicates</a>
                                        <a href="expenses" class="nav-link">Expenses</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                class="material-symbols-outlined">
                                contract
                            </span>Ledger</a>
                        <div class="az-menu-sub px-0">
                            <div class="container">
                                <div>
                                    <nav class="nav">
                                        <a href="javascript:void(0)"
                                            data-url="views/ledger.view.php?filter&type=customers"
                                            class="nav-link dynamicPopup" data-pop="md" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >Customer Ledger</a>
                                        <a href="javascript:void(0)"
                                            data-url="views/ledger.view.php?filter&type=agents"
                                            class="nav-link dynamicPopup" data-pop="md" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >Agent Ledger</a>
                                        <a href="javascript:void(0)"
                                            data-url="views/ledger.view.php?filter&type=suppliers"
                                            class="nav-link dynamicPopup" data-pop="md" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >Supplier Ledger</a>
                                        <a href="javascript:void(0)"
                                            data-url="views/ledger.view.php?filter&type=banks"
                                            class="nav-link dynamicPopup" data-pop="md" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >Payment Methods Ledger</a>
                                        <a href="javascript:void(0)"
                                            data-url="views/ledger.view.php?filter&type=other-ledgers"
                                            class="nav-link dynamicPopup" data-pop="md" data-toggle="modal"
                                            data-target="#dynamicPopup-md"
                                            >Other Ledger</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-item-m text-uppercase">
                        <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span
                                class="material-symbols-outlined">
                                summarize
                            </span>Reports</a>
                        <div class="az-menu-sub px-0">
                            <div class="container">
                                <div>
                                    <nav class="nav">
                                        <a href="report?type=day-close" class="nav-link">Day Wise Report</a>
                                        <a href="report?type=service-wise" class="nav-link">Service Wise</a>
                                        <a href="report?type=staff-wise" class="nav-link">Staff Wise</a>
                                        <a href="report?type=bill-wise" class="nav-link">Bill Wise</a>
                                        <a href="report?type=expense" class="nav-link">Expenses</a>
                                        <!-- <a href="report?type=profit-loss" class="nav-link">Profit & Loss</a> -->
                                        <a href="report?type=monthly" class="nav-link">Monthly Report</a>
                                        <a href="docs" class="nav-link">Customer Documents</a>
                                        <a href="report?type=customer-group" class="nav-link">Customer Group</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- <li class="nav-item nav-item-m text-uppercase">
                    <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                            summarize
                        </span>Reports</a>
                    <div class="az-menu-sub az-menu-sub-mega">
                        <div class="container">
                            <div>
                                <nav class="nav">
                                    <span>OTHER</span>
                                    <a href="report?type=day-close" class="nav-link">Day Wise Report</a>
                                    <a href="report?type=service-wise" class="nav-link">Service Wise</a>
                                    <a href="report?type=staff-wise" class="nav-link">Staff Wise</a>
                                    <a href="report?type=bill-wise" class="nav-link">Bill Wise</a>
                                    <a href="report?type=expense" class="nav-link">Expenses</a>
                                    <a href="report?type=profit-loss" class="nav-link">Profit & Loss</a>
                                </nav>
                            </div>
                            <div>
                                <nav class="nav">
                                    <span>&nbsp;</span>
                                    <a href="report?type=monthly" class="nav-link">Monthly Report</a>
                                    <a href="docs" class="nav-link">Customer Documents</a>
                                    <a href="report?type=customer-group" class="nav-link">Customer Group</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li> -->
                    <!-- <li class="nav-item nav-item-m text-uppercase">
                    <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                            summarize
                        </span>Reports</a>
                    <div class="az-menu-sub px-0">
                        <div class="container">
                            <div>
                                <nav class="nav">
                                    <a href="report?type=day-close" class="nav-link">Daily Report</a>
                                    <a href="report?type=service-wise" class="nav-link">Service Wise</a>
                                    <a href="report?type=staff-wise" class="nav-link">Staff Wise</a>
                                    <a href="report?type=bill-wise" class="nav-link">Bill Wise</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li> -->
                    <!-- <li class="nav-item nav-item-m text-uppercase">
                <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                        settings
                    </span>View</a>
                <div class="az-menu-sub px-0">
                    <div class="container">
                        <div>
                            <nav class="nav">
                                <a href="javascript:void(0)" class="nav-link changeview" data-changeto="1">
                                    Table
                                        echo '<i class="fa fa-check-circle text-success ml-2 float-right"></i>';
                                </a>
                                <a href="javascript:void(0)" class="nav-link changeview" data-changeto="2">
                                    Grid
                                        echo '<i class="fa fa-check-circle text-success ml-2 float-right"></i>';
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </li> -->
                    <!-- <li class="nav-item nav-item-m text-uppercase">
                    <a href="settings" class="nav-link nav-link-m">
                        <span class="material-symbols-outlined">
                            settings
                        </span>Settings</a>
                </li> -->
                    <li class="nav-item nav-item-m text-uppercase d-none">
                        <a href="javascript:void(0)" id="searchMenuBtn" class="nav-link nav-link-m dynamicPopup"
                            data-pop="md3" data-url="views/app.view.php?search" data-toggle="modal"
                            data-target="#dynamicPopup-md3">
                            <span class="material-symbols-outlined">
                                search
                            </span>Search</a>
                    </li>
                    <li class="searchLi">
                        <div id="searchContainer">
                            <!-- <input type="text" id="searchInput" placeholder="Search..."> -->
                            <input type="search" id="searchNav" placeholder="Search (ctrl+alt+f)"
                                class="form-control py-1 rounded-10" autocomplete="off">
                            <div id="searchIcon">
                                <span class="material-symbols-outlined">
                                    search
                                </span>
                                <!-- &#128269; -->
                            </div>
                        </div>
                        <ul id="navList" class="shadow">
                            <li class="border-top"><a href="dashboard">DASHBOARD</a></li>
                            <li><a href="suppliers/all">SUPPLIERS</a></li>
                            <li><a href="branches/all">BRANCHES</a></li>
                            <li><a href="categories/all">CATEGORIES</a></li>
                            <li><a href="services/all">SERVICES</a></li>
                            <li><a href="payment-methods/all">PAYMENT METHODS</a></li>
                            <li><a href="customer-groups/all">CUSTOMER GROUPS</a></li>
                            <li><a href="customers/all">CUSTOMERS</a></li>
                            <li><a href="agents/all">AGENTS</a></li>
                            <li><a href="expense-categories/all">EXPENSE CATEGORIES</a></li>
                            <li><a href="javascript:void(0)" class="newsale">NEW SALE</a></li>
                            <li><a href="javascript:void(0)" class="dynamicPopup" data-pop="md"
                                    data-url="views/invoices.view.php?holdlist" data-toggle="modal"
                                    data-target="#dynamicPopup-md"  >ON
                                    HOLD</a></li>
                            <li><a href="sales">SALES</a></li>
                            <li><a href="quotations">QUOTATIONS</a></li>
                            <li><a href="expenses">EXPENSES</a></li>
                            <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=customers"
                                    class="dynamicPopup" data-pop="md" data-toggle="modal"
                                    data-target="#dynamicPopup-md"
                                    >CUSTOMER LEDGER</a></li>
                            <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=agents"
                                    class="dynamicPopup" data-pop="md" data-toggle="modal"
                                    data-target="#dynamicPopup-md"  >AGENT
                                    LEDGER</a></li>
                            <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=suppliers"
                                    class="dynamicPopup" data-pop="md" data-toggle="modal"
                                    data-target="#dynamicPopup-md"
                                    >SUPPLIER LEDGER</a></li>
                            <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=banks"
                                    class="dynamicPopup" data-pop="md" data-toggle="modal"
                                    data-target="#dynamicPopup-md"
                                    >PAYMENT METHODS LEDGER</a></li>
                            <li><a href="report?type=day-close">DAY WISE REPORT</a></li>
                            <li><a href="report?type=service-wise">SERVICE WISE REPORT</a></li>
                            <li><a href="report?type=staff-wise">STAFF WISE REPORT</a></li>
                            <li><a href="report?type=bill-wise">BILL WISE REPORT</a></li>
                            <li><a href="report?type=expense">EXPENSES REPORT</a></li>
                            <li><a href="report?type=profit-loss">PROFIT & LOSS REPORT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="az-header-right animate__animatedd animate__flipInX">
                <h4 class="mt-2 text-right" style="max-width: 250px;">
                    <!-- <strong>< ?php echo strtoupper($titleClient) ?></strong> -->
                    <!-- < ?php echo strtoupper($titleClient) ?> -->
                    <span class="d-block text-truncate" title="">BRANCH NAME</span>
                </h4>
                <div class="dropdown az-profile-menu">
                    <a href="javascript:void(0)" class="az-img-user shadoww border rounded-10"><img
                            src="assets/img/appicon.webp" alt=""></a>
                    <div class="dropdown-menu">
                        <!-- <div class="az-dropdown-header d-sm-none">
                        <a href="javascript:void(0)" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div> -->
                        <div class="az-header-profile">
                            <div class="az-img-user shadoww border rounded-10">
                                <img src="assets/img/appicon.webp" alt="">
                            </div>
                            <h6>USER NAME</h6>
                            <span>USER TYPE</span>
                        </div>
                        <a href="settings" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Settings</a>
                        <a href="sign-out" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign
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
            <a href="javascript:void(0)" class="btns rounded-10 btn-sale shadow newsale" title="New sale">
                <span>SALE</span>
            </a>
            <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 shadow dynamicPopup" data-pop="md"
                data-url="views/expenses.view.php?new" data-toggle="modal" data-target="#dynamicPopup-md"
                  title="Add expense">
                <span>EXPENSE</span>
            </a>
            <!-- </a> <a href="javascript:void(0)" class="btns rounded-10 btn-lock mt-3 shadow">
                <span>LOCK</span>
            </a> -->
            <a href="javascript:void(0)" onclick="history.back();" class="btns rounded-10 btn-back mt-3 shadow"
                title="Go back to previous section">
                <!-- <span>BACK</span> -->
            </a>
            <a href="javascript:void(0)" onclick="location.reload();" class="btns rounded-10 btn-reload mt-3 shadow"
                title="Relaod">
                <!-- <span>BACK</span> -->
            </a>
            <!-- < ?php } ?> -->
        </div>
    </nav>
    <script>
        $(".az-header").onSwipe(function(results) {
            // if (results.up == true)
            //     console.log("Up")
            if (results.right == true)
                $('body').toggleClass('az-header-menu-show');
            // if (results.down == true)
            //     console.log("Down")
            // if (results.left == true)
            //     console.log("Left")
        });
        $(".az-header").dblclick(function() {
            // $(".main-menu-in").focus();
        });
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets/lib/notify/notify.min.js') }}"></script>
    <script src="{{ url('assets/js/azia.min.js') }}"></script>
    <!-- <script src="assets/js/main.min.js"></script> -->
    <script src="{{ url('assets/js/main.js?v=749508564') }}"></script>

    @section('script')

    @show
</body>

</html>
