
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="author" content="">
<title>DASHBOARD - TEST VERSION</title>
<base href="https://totest.zaad1.com/">
<link rel="shortcut icon" href="assets/img/favicon.png" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<!-- <link href="../assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet"> -->
<link href="../assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="../assets/lib/typicons.font/typicons.min.css" rel="stylesheet">
<link href="../assets/lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
<link href="../assets/lib/dataTables.bootstrap4/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css"> -->
<link rel="stylesheet" href="../assets/css/azia.css?v=1259703031">
<link href="../assets/lib/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="../assets/lib/select2/dist/css/select2-bootstrap-5-theme.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css?v=1393687077">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="../assets/lib/jquery/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="../assets/lib/select2/dist/js/select2.min.js"></script>
<script src="../assets/js/swipe.js"></script>
<style>
    @media print {
        * {
            font-size: 14pt;
        }

        .small {
            font-size: 12pt;
        }
    }
</style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                    <!-- <a href="javascript:void(0)" onclick="history.back();" class="mr-2 text-dark"><i class="fa fa-arrow-left fa-2x"></i></a> -->
                                <!-- <a href="dashboard" class="az-logo mt-1"><span></span> < ?php echo ($titleBrand) ?></a> -->
                <a href="dashboard" class="az-logo mt-1 animate__animatedd animate__flipInX">
                    <img src="../assets/img/zaadDocs.png" class="d-none d-xl-block">
                    <img src="../assets/img/zaadDocs-m.png" class="d-block d-xl-none" style="width: 130px;">
                </a>
                <a href="javascript:void(0)" id="azMenuShow" class="az-header-menu-icon d-xl-none"><span></span></a>
            </div>
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="dashboard" class="az-logo w-100">
                        <img src="../assets/img/zaadDocs-m.png" class="d-block d-xl-none px-3 mt-3 mt-2" style="width: 100%;">
                        <span></span></a>
                    <h5 class="text-center mb-2 text-truncate">
                                                    TEST VERSION                                            </h5>
                    <!-- <a href="javascript:void(0)" class="close">&times;</a> -->
                </div>
                                    <ul class="nav animate__animatedd animate__flipInX">
                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="../dashboard" class="nav-link nav-link-m">
                                <span class="material-symbols-outlined">
                                    dashboard
                                </span> Dashboard</a>
                        </li>
                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                                    edit_square
                                </span>Master</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">
                                            <a href="../categories/all" class="nav-link">Categories</a>
                                            <a href="../services/table" class="nav-link">Services</a>
                                            <a href="../payment-methods/all" class="nav-link">Payment Methods</a>
                                            <a href="../customer-groups/all" class="nav-link">Customer Groups</a>
                                            <a href="../customers/all" class="nav-link">Customers</a>
                                            <a href="../suppliers/all" class="nav-link">SUPPLIERS</a>
                                            <a href="../agents/all" class="nav-link">Agents</a>
                                                                                            <a href="../branches/all" class="nav-link">BRANCHES</a>
                                                <!-- <a href="../backup" class="nav-link">Data Backup</a> -->
                                                                                        <a href="../expense-categories/all" class="nav-link">Expense Categories</a>
                                            <a href="../other-ledgers/all" class="nav-link">Other Ledgers</a>
                                            <!-- <a href="../expense/all" class="nav-link">Expenses</a> -->
                                            <a href="../users/all" class="nav-link">Users</a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                                    contract
                                </span>Transaction</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">
                                            <a href="javascript:void(0)" class="nav-link newsale">New Sale</a>
                                            <a href="javascript:void(0)" class="nav-link dynamicPopup" data-pop="md" data-url="views/invoices.view.php?holdlist" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">On Hold</a>
                                            <a href="../sales" class="nav-link">Sales</a>
                                            <a href="../quotations" class="nav-link">Quotations</a>
                                                                                        <!-- <a href="../pending" class="nav-link">Pending</a> -->
                                                                                        <a href="../expenses" class="nav-link">Expenses</a>
                                            <a href="../pending-jobs" class="nav-link">Action Hub</a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                                    contract
                                </span>Ledger</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">
                                            <a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=customers" class="nav-link dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">Customer</a>
                                            <a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=agents" class="nav-link dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">Agent</a>
                                            <a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=suppliers" class="nav-link dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">Supplier</a>
                                            <a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=banks" class="nav-link dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">Payment Methods</a>
                                            <a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=other-ledgers" class="nav-link dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">Other</a>
                                                                                    </nav>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-item-m text-uppercase">
                            <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                                    summarize
                                </span>Reports</a>
                            <div class="az-menu-sub px-0">
                                <div class="container">
                                    <div>
                                        <nav class="nav">
                                            <a href="../report?type=day-close" class="nav-link">Day<!-- Wise Report --></a>
                                            <a href="../report?type=service-wise" class="nav-link">Service<!-- Wise --></a>
                                            <a href="../report?type=staff-wise" class="nav-link">Staff<!-- Wise --></a>
                                            <a href="../report?type=bill-wise" class="nav-link">Bill<!-- Wise --></a>
                                            <a href="../report?type=expense" class="nav-link">Expenses</a>
                                            <!-- <a href="../report?type=profit-loss" class="nav-link">Profit & Loss</a> -->
                                            <a href="../report?type=monthly" class="nav-link">Monthly<!-- Report --></a>
                                                                                        <a href="../report?type=customer-group" class="nav-link">Customer Group</a>
                                            <a href="../outstanding?type=supplier" class="nav-link">Supplier Outstanding</a>
                                            <a href="../outstanding?type=customer" class="nav-link">Customer Outstanding</a>
                                            <a href="../log?type=sales-edit-history" class="nav-link">Sales Edit History</a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="nav-item nav-item-m text-uppercase">
                        <a href="javascript:void(0)" class="nav-link nav-link-m with-sub"><span class="material-symbols-outlined">
                                summarize
                            </span>Reports</a>
                        <div class="az-menu-sub px-0">
                            <div class="container">
                                <div>
                                    <nav class="nav">
                                        <a href="../report?type=day-close" class="nav-link">Daily Report</a>
                                        <a href="../report?type=service-wise" class="nav-link">Service Wise</a>
                                        <a href="../report?type=staff-wise" class="nav-link">Staff Wise</a>
                                        <a href="../report?type=bill-wise" class="nav-link">Bill Wise</a>
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
                                        <i class="fa fa-check-circle text-success ml-2 float-right"></i>                                    </a>
                                    <a href="javascript:void(0)" class="nav-link changeview" data-changeto="2">
                                        Grid
                                                                            </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li> -->
                        <!-- <li class="nav-item nav-item-m text-uppercase">
                        <a href="../settings" class="nav-link nav-link-m">
                            <span class="material-symbols-outlined">
                                settings
                            </span>Settings</a>
                    </li> -->
                        <li class="nav-item nav-item-m text-uppercase d-none">
                            <a href="javascript:void(0)" id="searchMenuBtn" class="nav-link nav-link-m dynamicPopup" data-pop="md3" data-url="views/app.view.php?search" data-toggle="modal" data-target="#dynamicPopup-md3">
                                <span class="material-symbols-outlined">
                                    search
                                </span>Search</a>
                        </li>
                        <li class="searchLi">
                            <div id="searchContainer">
                                <!-- <input type="text" id="searchInput" placeholder="Search..."> -->
                                <input type="search" id="searchNav" placeholder="Search (ctrl+alt+f)" class="form-control py-1 rounded-10" autocomplete="off">
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
                                <li><a href="../expense-categories/all">EXPENSE CATEGORIES</a></li>
                                <li><a href="javascript:void(0)" class="newsale">NEW SALE</a></li>
                                <li><a href="javascript:void(0)" class="dynamicPopup" data-pop="md" data-url="views/invoices.view.php?holdlist" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">ON HOLD</a></li>
                                <li><a href="../sales">SALES</a></li>
                                <li><a href="../quotations">QUOTATIONS</a></li>
                                <li><a href="../expenses">EXPENSES</a></li>
                                <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=customers" class="dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">CUSTOMER</a></li>
                                <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=agents" class="dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">AGENT</a></li>
                                <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=suppliers" class="dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">SUPPLIER</a></li>
                                <li><a href="javascript:void(0)" data-url="views/ledger.view.php?filter&type=banks" class="dynamicPopup" data-pop="md" data-toggle="modal" data-target="#dynamicPopup-md" data-backdrop="static" data-keyboard="false">PAYMENT METHODS</a></li>
                                <li><a href="../report?type=day-close">DAY WISE REPORT</a></li>
                                <li><a href="../report?type=service-wise">SERVICE WISE REPORT</a></li>
                                <li><a href="../report?type=staff-wise">STAFF WISE REPORT</a></li>
                                <li><a href="../report?type=bill-wise">BILL WISE REPORT</a></li>
                                <li><a href="../report?type=expense">EXPENSES REPORT</a></li>
                                <li><a href="../report?type=profit-loss">PROFIT & LOSS REPORT</a></li>
                            </ul>
                        </li>
                    </ul>
                            </div>
            <div class="az-header-right animate__animatedd animate__flipInX">
                <h4 class="mt-2 text-right" style="max-width: 250px;">
                                            <span class="d-block text-truncate" title="TEST VERSION">TEST VERSION                                                    </span>
                                    </h4>
                <div class="dropdown az-profile-menu">
                    <a href="javascript:void(0)" class="az-img-user shadoww border rounded-10"><img src="../assets/img/avatar.png" alt=""></a>
                    <div class="dropdown-menu">
                        <div class="az-header-profile">
                            <div class="az-img-user shadoww border rounded-10">
                                <img src="../assets/img/avatar.png" alt="">
                            </div>
                            <h6 title="ADMIN">ADMIN</h6>
                            <span>
                                App Admin                            </span>
                        </div>
                        <a href="../settings" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Settings</a>
                        <a href="../sign-out" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="main-menu-mob"></div>
        <div class="main-menu-in">
            <a href="javascript:void(0)" class="btns rounded-10 btn-sale shadow newsale" title="New sale">
                <span>SALE</span>
            </a>
                            <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 shadow dynamicPopup" data-pop="lg" data-url="views/expenses.view.php?new" data-toggle="modal" data-target="#dynamicPopup-lg" data-backdrop="static" data-keyboard="false" title="Add expense">
                    <span>EXPENSE</span>
                </a>
                        <a href="javascript:void(0)" onclick="history.back();" class="btns rounded-10 btn-back mt-3 shadow" title="Go back to previous section"></a>
            <a href="javascript:void(0)" onclick="location.reload();" class="btns rounded-10 btn-reload mt-3 shadow" title="Relaod"></a>
        </div>
    </nav>
    <script>
        $(".az-header").onSwipe(function(results) {
            if (results.right == true)
                $('body').toggleClass('az-header-menu-show');
        });
        $(".az-header").dblclick(function() {});
        if ($('#searchNav').length) {
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

                list.style.display = searchTerm ? "block" : "none";
            });
        }
    </script>
  <div class="az-content az-content-dashboard">
    <div class="container-fluid">
              <div class="row mb-4">
          <div class="col-12">
            <div class="card rounded-10 shadow">
              <div class="card-header">
                <form>
                  <div class="row d-flex flex-wrap">
                    <div class="w-auto ml-3">
                      <label class="mb-0 d-block small font-weight-bold">From Date</label>
                      <input type="date" value="2024-01-12" name="from_date" class="form-control rounded-10" required onchange="this.form.submit()">
                    </div>
                    <div class="w-auto ml-3">
                      <label class="mb-0 d-block small font-weight-bold">To Date</label>
                      <input type="date" value="2024-08-01" name="to_date" class="form-control rounded-10" required onchange="this.form.submit()">
                    </div>
                    <div class="w-auto ml-3">
                      <label class="mb-0 d-block small font-weight-bold">Branch</label>
                      <select name="branch" id="changebranch" class="form-control rounded-10" required onchange="changeBranch('changebranch')">
                        <option value="tc7305c26-3228-45c2-b735-fbaca2d4838e">TEST VERSION</option>
                                              </select>
                    </div>
                    <div class="w-auto ml-3">
                      <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                      <button type="submit" class="btn btn-dark rounded-10 px-3">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-0">
          <div class="col-xl-12">
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card rounded-10 shadow">
                  <div class="card-body card-body-bg-icon">
                    <img src="assets/img/aed.png" alt="">
                    <h5>TOTAL SALE</h5>
                    <h4 class="mb-0">AED&nbsp;78,541.90</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card rounded-10 shadow">
                  <div class="card-body card-body-bg-icon">
                    <img src="assets/img/aed.png" alt="">
                    <h5>TOTAL CASH SALE</h5>
                    <h4 class="mb-0">AED&nbsp;42,995.90</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card rounded-10 shadow">
                  <div class="card-body card-body-bg-icon">
                    <img src="assets/img/aed.png" alt="">
                    <h5>TOTAL CARD SALE</h5>
                    <h4 class="mb-0">AED&nbsp;571.00</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card rounded-10 shadow">
                  <div class="card-body card-body-bg-icon">
                    <img src="assets/img/aed.png" alt="">
                    <h5>TOTAL CREDIT SALE</h5>
                    <h4 class="mb-0">AED&nbsp;34,975.00</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>TOTAL OTHER SALE</h5>
                  <h4 class="mb-0">AED&nbsp;0.00</h4>
                </div>
              </div>
            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card rounded-10 shadow">
                  <div class="card-body card-body-bg-icon">
                    <img src="assets/img/aed.png" alt="">
                    <h5>EXPENSE</h5>
                    <h4 class="mb-0">AED&nbsp;29,490.82</h4>
                  </div>
                </div>
              </div>
              <div class="col-12"></div>
              <!-- <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>CASH BALANCE</h5>
                  <h4 class="mb-0">AED&nbsp;25,140.34</h4>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>CARD BALANCE</h5>
                  <h4 class="mb-0">AED&nbsp;2,571.00</h4>
                </div>
              </div>
            </div> -->
                            <!-- <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>CREDIT OUTSTANDING</h5>
                  <h4 class="mb-0">AED&nbsp;-41,000.00</h4>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>CREDIT PAYABLE</h5>
                  <h4 class="mb-0">AED&nbsp;-5,920.00</h4>
                </div>
              </div>
            </div> -->
                            <!-- <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
              <div class="card rounded-10 shadow">
                <div class="card-body card-body-bg-icon">
                  <img src="assets/img/aed.png" alt="">
                  <h5>P & L</h5>
                  <h4 class="mb-0 text-danger">AED&nbsp;-106,160.85</h4>
                </div>
              </div>
            </div> -->
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-lg-3">
            <div class="row mb-4">
              <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                  <div class="card-header">
                    <h4 class="mb-0 text-center">TOP SERVICES</h4>
                  </div>
                  <div class="card-body" id="myPieChartDiv">
                    <canvas id="myPieChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="row">
              <div class="col-lg-6 mb-4">
                <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                  <div class="card-header">
                    <h4 class="mb-0 text-center">MONTHLY SALES</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myBarChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 mb-4">
                <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                  <div class="card-header">
                    <h4 class="mb-0 text-center">MONTHLY EXPENSE</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myBarChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-xl-6 mb-4">
            <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
              <div class="card-header">
                <h4 class="mb-0 text-center">DAY WISE SALES</h4>
              </div>
              <div class="card-body overflow-auto">
                <canvas id="chLine"></canvas>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
              <div class="card-header">
                <h4 class="mb-0 text-center">RECENT SALES</h4>
              </div>
              <div class="card-body overflow-auto">
                <input type="hidden" id="controller" value="sales.controller.php">
                <input type="hidden" id="customer2" name="customer" value="">
                <input type="hidden" id="dated2" name="dated" value="2024-08-01">
                <input type="hidden" id="sale_no2" name="sale_no" value="">
                <input type="hidden" id="notes2" name="notes" value="">
                <table id="datatable" class="table table-hover table-stripedd table-custom displayy mb-0 mt-3" style="width:100%">
                  <thead>
                    <tr>
                      <!-- <th>Dated</th> -->
                      <th>#</th>
                      <th>Customer</th>
                      <th>Services</th>
                      <th>Notes</th>
                      <th>Total</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
          </div>

    <div class="modal fade" id="dynamicPopup-sm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-sm"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-md" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-md"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-lg" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-lg"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-xl" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-xl"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-video" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered bg-transparent border-0">
        <div class="modal-content rounded-10 popupContent-video bg-dark border-0"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-md2" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-md2"> </div>
    </div>
</div>
<div class="modal fade" id="dynamicPopup-md3" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content rounded-10 popupContent-md3"> </div>
    </div>
</div>
<div id="if"></div>    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/lib/dataTables.bootstrap4/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="../assets/lib/notify/notify.min.js"></script>
<script src="../assets/js/azia.min.js"></script>
<script src="../assets/js/main.min.js?v=2"></script>      <script>
                  // Sample data for the pie chart
          var data = {
            labels: ['HEALTH INSURANCE ICP','STAMPING','MEDICAL EHS','OTHER SERVICE','INSURANCE B CATE','ILOE INSURANCE NEW',],
            datasets: [{
              data: [40.00,38.00,24.00,20.00,17.00,16.00,],
              backgroundColor: ['rgba(59, 72, 99, 0.9)','rgba(59, 72, 99, 0.8)','rgba(59, 72, 99, 0.7)','rgba(59, 72, 99, 0.6)','rgba(59, 72, 99, 0.5)','rgba(59, 72, 99, 0.4)',]
            }]
          };

          // Get the context of the canvas element
          var ctx = document.getElementById('myPieChart').getContext('2d');

          // Create the pie chart
          var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
              // You can add additional options here
            }
          });
              </script>
            <script>
        // Sample data for the bar chart
        var data = {
          labels: ['Mar 24','Apr 24','May 24','Jun 24','Jul 24','Aug 24',],
          datasets: [{
            label: 'TEST VERSION',
            data: [,,,,269514.50,1200.00,],
            backgroundColor: [
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
            ],
            borderColor: [
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
            ],
            borderWidth: 1
          }]
        };

        // Get the context of the canvas element
        var ctx = document.getElementById('myBarChart').getContext('2d');

        // Create the bar chart
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
            // You can add additional options here
          }
        });


        var data2 = {
          labels: ['Mar 24','Apr 24','May 24','Jun 24','Jul 24','Aug 24',],
          datasets: [{
            label: 'TEST VERSION',
            data: [,,,,29490.82,,],
            backgroundColor: [
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
            ],
            borderColor: [
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
              'rgba(59, 72, 99, 0.7)',
            ],
            borderWidth: 1
          }]
        };
        // Get the context of the canvas element
        var ctx = document.getElementById('myBarChart2').getContext('2d');

        // Create the bar chart
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data2,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
            // You can add additional options here
          }
        });
      </script>


      <script type="text/javascript">
        var colors = ['#3b4863', '#28a745', '#EC5FE7', "#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"];
        var chLine = document.getElementById("chLine");
        var chartData = {
          labels: ['03-07-2024','04-07-2024','05-07-2024','06-07-2024','08-07-2024','09-07-2024','10-07-2024','11-07-2024','12-07-2024','13-07-2024','15-07-2024','16-07-2024','17-07-2024','18-07-2024','20-07-2024','21-07-2024','22-07-2024','23-07-2024','24-07-2024','25-07-2024','26-07-2024','29-07-2024','31-07-2024','01-08-2024',],
          datasets: [{
            label: 'TEST VERSION',
            data: [5910.00,14335.00,1620.00,20830.00,11395.00,11845.00,3070.00,14348.00,7072.50,18710.00,6745.00,3230.00,9505.00,27078.00,150.00,5559.00,21080.00,48668.00,31719.00,780.00,1115.00,2400.00,2400.00,1200.00,],
            borderColor: colors[0],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
          }, ]
        };
        if (chLine) {
          new Chart(chLine, {
            type: 'line',
            data: chartData,
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: false
                  }
                }]
              },
              legend: {
                display: true
              }
            }
          });
        }
      </script>
        <script src="../js/sales2-popup.js?v=13"></script>
</body>

</html>
