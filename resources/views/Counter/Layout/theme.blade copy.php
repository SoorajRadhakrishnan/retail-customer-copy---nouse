<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="POS Web Application for Retail ">
    <meta name="author" content="zaadPlatform">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - ZaadRetail</title>
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.webp') }}" />
    {{-- <link rel="shortcut icon" href="{{ url('assets/css/font-awesome.css') }}" />
    <link rel="shortcut icon" href="{{ url('assets/css/font-awesome-material-symbol.css') }}" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="{{ url('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/typicons.font/typicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/responsive-datatable.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/button-datatable.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ url('assets/css/azia.css?v=166274628') }}">
    <link href="{{ url('assets/lib/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/lib/select2/dist/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/style.css?v=283086245') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style-pos.css?v=283086245') }}">
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}
    <script src="{{ url('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/lib/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/swipe.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{ url('assets/css/toast.css') }}"> --}}
    @section('style')
    @show
</head>

<body>
    <div class="az-header">
        <div class="container-fluid">
            <div class="az-header-left">
                <a href="javascript:void(0)" class="az-logo mt-1 animate__animatedd animate__flipInX">
                    <i class="fa fa-bars" id="home_show" aria-hidden="true" onclick="toggleDives()" style="display:block;"></i>
                    <i class="fa fa-close" id="home_hide" aria-hidden="true" onclick="toggleDives()"
                        style="display:none;"></i>
                </a>
                <a href="{{ url('dashboard') }}" class="az-logo mt-1 animate__animatedd animate__flipInX">
                    <img src="{{ url('assets/img/zaadDocs.png') }}" class="d-none d-xl-block">
                    <img src="{{ url('assets/img/zaadDocs-m.png') }}" class="d-block d-xl-none" style="width: 130px;">
                </a>
                <a href="javascript:void(0)" id="azMenuShow" class="az-header-menu-icon d-xl-none"><span></span></a>
            </div>
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="{{ url('dashboard') }}" class="az-logo w-100">
                        <img src="{{ url('assets/img/zaadDocs-m.png') }}" class="d-block d-xl-none px-3 mt-3 mt-2"
                            style="width: 100%;">
                        <span></span></a>
                    <h5 class="text-center mb-2 text-truncate">
                        {{ Str::ucfirst(auth()->user()->branch->branch_name) }}
                    </h5>
                </div>
            </div>
            <div class="az-header-right animate__animatedd animate__flipInX">
                <h4 class="mt-2 text-right" style="max-width: 250px;">
                    <span class="d-block text-truncate"
                        title="">{{ Str::ucfirst(auth()->user()->branch->branch_name) }}</span>
                </h4>
                <div class="dropdown az-profile-menu">
                    <a href="javascript:void(0)" class="az-img-user shadoww border rounded-10"><img
                            src="{{ url('assets/img/appicon.webp') }}" alt=""></a>
                    <div class="dropdown-menu">
                        <div class="az-header-profile">
                            <div class="az-img-user shadoww border rounded-10">
                                <img src="{{ url('assets/img/appicon.webp') }}" alt="">
                            </div>
                            <h6>{{ Str::ucfirst(auth()->user()->name) }}</h6>
                            <span>{{ Str::ucfirst(auth()->user()->usertype) }}</span>
                        </div>
                        {{-- <a href="settings" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Settings</a> --}}
                        <a href="{{ url('logout') }}" class="dropdown-item"><i class="typcn typcn-power-outline"></i>
                            Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="main-menu-in">
            <div class="row">
                @if (checkUserPermission('opening_balance'))
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 mb-2 shadow dynamicPopup"
                        title="Expense"
                        style="background-image:url({{ url('assets/img/openingbal.svg') }});height: 100px !important"
                        data-pop="md" data-url="{{ url('open-balance/create') }}" data-toggle="modal"
                        data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}">
                        <span>OPENING&nbsp;BALANCE</span>
                    </a>
                </div>
                @endif

                @if (checkUserPermission('crm'))
                    <div class="col-md-4">
                        <a href="{{ url('crm') }}" class="btns rounded-10 btn-sale mt-3 mb-2 shadow"
                            title="CRM"
                            style="background-image:url({{ url('assets/img/CRM.svg') }});height: 100px !important">
                            <span>CRM</span>
                        </a>
                    </div>
                @endif

                {{-- </div>
            <div class="row"> --}}
                @if (checkUserPermission('counter_sale'))
                    <div class="col-md-4">
                        <a href="{{ url('home') }}" class="btns rounded-10 btn-sale mt-3 mb-2 shadow"
                            title="New Sale"
                            style="background-image:url({{ url('assets/img/sale.svg') }});height: 100px !important">
                            <span>SALE</span>
                        </a>
                    </div>
                @endif

                @if (checkUserPermission('sale_log'))
                    <div class="col-md-4">
                        <a href="{{ url('recent-sale') }}" class="btns rounded-10 btn-expense mt-3 mb-2 shadow"
                            title="Recent Sales"
                            style="background-image:url({{ url('assets/img/log.svg') }});height: 100px !important">
                            <span>LOGS</span>
                        </a>
                    </div>
                @endif

                @if (checkUserPermission('sale_log'))
                    <div class="col-md-4">
                        <a href="{{ url('delivery-log') }}" class="btns rounded-10 btn-expense mt-3 mb-2 shadow"
                            title="Delivery Log"
                            style="background-image:url({{ url('assets/img/deliverylog.svg') }});height: 100px !important">
                            <span>DELIVERY&nbsp;LOGS</span>
                        </a>
                    </div>
                @endif
                {{-- </div>
            <div class="row"> --}}
                @if (checkUserPermission('credit_sale'))
                    <div class="col-md-4">
                        <a href="{{ url('credit-sale') }}" class="btns rounded-10 btn-expense mt-3 mb-2 shadow"
                            title="Credit Sales"
                            style="background-image:url({{ url('assets/img/credit.svg') }});height: 100px !important">
                            <span>CREDIT</span>
                        </a>
                    </div>
                @endif

                @if (checkUserPermission('settle_sale'))
                    <div class="col-md-4">
                        <a href="{{ url('settle-sale') }}" class="btns rounded-10 btn-expense mt-3 mb-2 shadow"
                            title="Settle Sale"
                            style="background-image:url({{ url('assets/img/expense.png') }});height: 100px !important">
                            <span>SETTLE&nbsp;SALES</span>
                        </a>
                    </div>
                @endif
                {{-- </div>
            <div class="row"> --}}

                @if (checkUserPermission('expense'))
                    <div class="col-md-4">
                        <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 mb-2 shadow dynamicPopup"
                            title="Expense"
                            style="background-image:url({{ url('assets/img/expense.svg') }});height: 100px !important"
                            data-pop="md" data-url="{{ url('expense/create') }}" data-toggle="modal"
                            data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <span>EXPENSE</span>
                        </a>
                    </div>
                @endif

                @if (checkUserPermission('pay_back'))
                    <div class="col-md-4">
                        <a href="{{ url('pay-back') }}" class="btns rounded-10 btn-expense mt-3 mb-2 shadow"
                            title="Pay Back"
                            style="background-image:url({{ url('assets/img/money.svg') }});height: 100px !important">
                            <span>PAY&nbsp;BACK</span>
                        </a>
                    </div>
                @endif
                {{-- </div>
            <div class="row"> --}}
                @if (checkUserPermission('open_drawer'))
                    <div class="col-md-4">
                        <a href="javascript:void(0)" class="btns rounded-10 btn-expense mt-3 mb-2 shadow dynamicPopup"
                            title="Open Drawer"
                            style="background-image:url({{ url('assets/img/drawer.svg') }});height: 100px !important"
                            data-pop="md" data-url="{{ url('open-drawer/create') }}" data-toggle="modal"
                            data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <span>OPEN&nbsp;DRAWER</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    @section('content')

    @show

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
        <div class="modal-dialog modal-lg modal-dialog-centered">
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

    {{-- notification --}}
    <div class="col-notify">
        <div class="col-notify-in">
            <p id="notifyTxt"></p>
        </div>
    </div>
    {{-- notification --}}

    <script src="{{ url('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script> --}}
    <script src="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/js/dataTables.responsive.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script> --}}
    <script src="{{ url('assets/lib/notify/notify.min.js') }}"></script>
    <script src="{{ url('assets/js/azia.min.js') }}"></script>
    <script src="{{ url('assets/js/main.js?v=23346382') }}"></script>
    {{-- <script src="{{ url('assets/js/toast.js') }}"></script> --}}
    @if (Session::has('message'))
        <script>
            notifyme2("{{ Session::get('message') }}");
        </script>
    @endif
    <script>

        const showDive = document.getElementById('home_show');
        const hideDive = document.getElementById('home_hide');

        function toggleDives() {
            var menu = document.querySelector('.main-menu');
            if (showDive.style.display === 'block') {
                showDive.style.display = 'none';
                hideDive.style.display = 'block';
                menu.classList.toggle('expanded');
            } else {
                showDive.style.display = 'block';
                hideDive.style.display = 'none';
                menu.classList.remove('expanded');
            }
        }

        function handleClickOutside(event) {
            if (hideDive.style.display === 'block' && !showDive.contains(event.target)) {
                var menu = document.querySelector('.main-menu');
                showDive.style.display = 'block';
                hideDive.style.display = 'none';
                menu.classList.remove('expanded');
            }
        }

        // Attach event listener to document to detect clicks outside of showDive
        document.addEventListener('click', handleClickOutside);

        // $(document).ready(function() {
        //     $(document).click(function(event) {
        //         if ($('#home_hide').css('display') === 'block') {
        //             if (!$(event.target).closest('#home_hide').length) {
        //                 alert($('#home_hide').css('display'));
        //                 toggleButtonRemove();
        //             }
        //         }
        //     });
        // });

        // function toggleButton() {
        //     var menu = document.querySelector('.main-menu');
        //     menu.classList.toggle('expanded');
        //     document.getElementById('home_show').style.display = 'none';
        //     document.getElementById('home_hide').style.display = 'block';
        // }

        // function toggleButtonRemove() {
        //     var menu = document.querySelector('.main-menu');
        //     menu.classList.remove('expanded');
        //     document.getElementById('home_show').style.display = 'block';
        //     document.getElementById('home_hide').style.display = 'none';
        // }

        //For Decimal Point
        function showAmt(amt) {
            var decimal_point = "{{ app('appSettings')['decimal_point']->value }}";
            var amt = parseFloat(amt).toFixed(decimal_point);
            return amt;
        }

        $('#example').dataTable({
            "language": {
                "emptyTable": "No Data found"
            }
        });
        //toastalert();
    </script>
    @section('script')
    @show
</body>

</html>
