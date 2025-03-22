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
        <style>
            /* Align items horizontally in the header */
            .az-header-left {
                display: flex;
                align-items: center;
                justify-content: start;
                /* Align menu button and logo to the left */
            }

            /* Style for the menu button */
            .menu-button {
                margin-right: 10px;
                /* Add spacing between the menu button and logo */
            }

            /* Logo visibility */
            .logo-container {
                flex-shrink: 0;
                /* Prevent the logo from shrinking */
            }

            /* Ensure responsiveness */
            @media (max-width: 1199.98px) {
                .logo-container {
                    display: none;
                }

                /* Hide logo on mobile */
            }
        </style>
    @show
</head>

<body>
    <div class="az-header">
        <div class="container-fluid">
            <div class="az-header-left">
                <!-- Menu Button -->
                <a href="javascript:void(0)"
                    class="menu-button mt-1 btn rounded-10 mr-2 btn-dark animate__animatedd animate__flipInX">
                    <span class="material-symbols-outlined" id="home_show" aria-hidden="true"
                        onclick="toggleDives()">menu</span>
                    <span class="material-symbols-outlined" id="home_hide" aria-hidden="true" onclick="toggleDives()"
                        style="display:none;">close</span>
                </a>

                <!-- Logo -->
                <a href="{{ url('home') }}" class="az-logo mt-1 animate__animatedd animate__flipInX logo-container">
                    <img src="{{ url('assets/img/zaadDocs.png') }}" class="logo-large">
                </a>
            </div>
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="{{ url('home') }}" class="az-logo w-100">
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
                        <a href="javascript:void(0)" class="dropdown-item" title="Change Password" data-toggle="modal"
                            data-target="#ChangePassword">
                            <span><i class="typcn typcn-pen"></i> Change Password</span>
                        </a>
                        <a href="{{ url('logout') }}" class="dropdown-item"><i class="typcn typcn-power-outline"></i>
                            Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu overflow-hidden">
        <div class="main-menu-in" style="overflow-y: auto;overflow-x:hidden;">
            <div class="row">
                @if (checkUserPermission('opening_balance'))
                    <div class="px-2 py-1 ml-4 mt-3 mr-4 d-flex" style="width: 350px;">
                        <a class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-3 w-100 dynamicPopup"
                            title="Expense" data-url="{{ url('open-balance/create') }}" data-toggle="modal"
                            data-pop="md" data-target="#dynamicPopup-md"
                            data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <img src="https://retail.zaad1.com/assets/img/openingbal.svg" alt="Icon"
                                class="mr-3" style="width: 25px; height: 25px;">
                            <span style="font-size: 1.5rem;">OPENING&nbsp;BALANCE</span>
                        </a>
                    </div>

            </div>
            @endif
            {{-- <div class="row">
                @if (checkUserPermission('opening_balance'))
                    <div class="px-2 py-1 ml-4 mt-3 mr-4 d-flex" style="width: 350px;">
                        <a href="javascript:void(0)" class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-3 w-100 dynamicPopup"
                            title="Expense"
                            data-pop="md" data-url="{{ url('open-balance/create') }}" data-toggle="modal"
                            data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <img src="https://retail.zaad1.com/assets/img/openingbal.svg" alt="Icon"
                                class="mr-3" style="width: 25px; height: 25px;">
                                <span style="font-size: 1.5rem;">OPENING&nbsp;BALANCE</span>
                        </a>
                    </div>
                @endif --}}
                <div class="row">
                    @if (checkUserPermission('dashboard'))
                    <div class="px-2  py-1 ml-4 mr-4  d-flex" style="width:350px;">
                        <a href="{{ url('dashboard') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100" title="CRM">
                            <img src="https://retail.zaad1.com/assets/img/CRM.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">DASHBOARD</span>
                        </a>
                    </div>
                    @endif
                </div>
            <div class="row">
                @if (checkUserPermission('crm'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('crm') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100" title="CRM">
                            <img src="https://retail.zaad1.com/assets/img/CRM.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">CRM</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('counter_sale'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width: 350px;">
                        <a href="{{ url('home') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="New Sale">
                            <img src="https://retail.zaad1.com/assets/img/sale.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">SALE WINDOW</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('Recent_sales') )
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('recent-sale') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="Recent Sales">
                            <img src="https://retail.zaad1.com/assets/img/log.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">RECENT SALES</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('delivery_log') && app('appSettings')['delivery_sale']->value == 'yes')
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('delivery-log') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="Delivery Log">
                            <img src="https://retail.zaad1.com/assets/img/delivery.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">DELIVERY LOGS</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('credit_sale'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('credit-sale') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="Credit Sales">
                            <img src="https://retail.zaad1.com/assets/img/credit.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">CREDIT SALES</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('settle_sale'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('settle-sale') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="Settle Sale">
                            <img src="https://retail.zaad1.com/assets/img/expense.png" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">DAY CLOSING</span>
                        </a>
                    </div>
                @endif

            </div>
            <div class="row">

                @if (checkUserPermission('expense'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="javascript:void(0)"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100 dynamicPopup"
                            title="Expense" data-pop="md" data-url="{{ url('expense/create') }}"
                            data-toggle="modal" data-target="#dynamicPopup-md"
                            data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <img src="https://retail.zaad1.com/assets/img/expense.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">EXPENSE</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('pay_back'))
                    <div class="px-2  py-1 ml-4 mr-4 d-flex" style="width:350px;">

                        <a href="{{ url('pay-back') }}"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100"
                            title="Pay Back">
                            <img src="https://retail.zaad1.com/assets/img/money.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">PAY BACK</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (checkUserPermission('open_drawer'))
                    <div class="px-2  py-1 ml-4 mr-4 mb-3 d-flex rounded-10" style="width:350px;">

                        <a href="javascript:void(0)"
                            class="btn btn-dark rounded-10 d-flex align-items-center py-3 px-4 w-100 dynamicPopup"
                            title="Open Drawer" data-pop="md" data-url="{{ url('open-drawer/create') }}"
                            data-toggle="modal" data-target="#dynamicPopup-md"
                            data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <img src="https://retail.zaad1.com/assets/img/drawer.svg" alt="Icon" class="mr-2"
                                style="width: 30px; height: 30px;">
                            <span style="font-size: 1.5rem;">OPEN DRAWER</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    @section('content')

    @show

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
                                            <input type="password" class="form-control"
                                                style="border-radius: 10px 0 0 10px;" id="password" name="password"
                                                placeholder="Enter your password" required>
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
                                            <input type="password" class="form-control"
                                                style="border-radius: 10px 0 0 10px;" id="password_confirmation"
                                                name="password_confirmation" placeholder="Enter your Confirm password"
                                                required>
                                            <div class="input-group-append">
                                                <button class="btn btn-dark px-2 mt-0" type="button"
                                                    style="border-radius: 0 10px 10px 0;"
                                                    onclick="showHidePassword('pas', 'password_confirmation')"><i
                                                        class="fa fa-eye" id="pas"></i></button>
                                            </div>
                                        </div>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="adminedit" data-form="ChangePasswordForm"
                                data-target="{{ url('change-password') }}" data-returnaction="reload"
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                data-processing="Please wait, saving...">Save</button>
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
