@extends('Counter.Layout.theme')

@section('title', 'POS SALE')

@section('style')

    <style>
        .paymodel_gt {
            font-size: 70px;
        }

        .dropdown-content {
            border-radius: 10px;
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            z-index: 1;
            width: 32%;
        }

        .dropdown-content ul {
            list-style-type: none;
        }

        .dropdown-content li {
            padding: 8px;
            cursor: pointer;
            list-style-type: none;
        }

        .dropdown-content li:hover {
            background-color: #f1f1f1;
            list-style-type: none;
        }

        .dropdown-content-item {
            border-radius: 10px;
            display: none;
            /* position: absolute; */
            background-color: white;
            border: 1px solid #ddd;
            z-index: 1;
            width: 100%;
        }

        .dropdown-content-item ul {
            list-style-type: none;
        }

        .dropdown-content-item li {
            padding: 8px;
            cursor: pointer;
            list-style-type: none;
        }

        .dropdown-content-item li:hover {
            background-color: #f1f1f1;
            list-style-type: none;
        }

        #checkButton.checked {
            background-color: lightgray;
            color: #2d374b
        }

        .openli {
            display: block;
        }

        .closedli {
            display: none;
        }

        .discount_model {
            cursor: pointer;
            font-size: 16px;
        }

        .active-cat {
            color: white !important;
        }

        .parent-div {
            position: relative;
            /* Ensures the child can be centered */
        }

        .expiry_message {
            width: 50%;
            /* Set the width of the message div */
            background-color: #ed6b6b;
            /* Example background color */
            padding: 20px;
            /* Padding inside the message div */
            text-align: center;
            /* Center the text inside the div */
            position: absolute;
            /* Position the div relative to the parent */
            top: 50%;
            /* Vertically center the div */
            left: 50%;
            /* Horizontally position the left edge in the center */
            transform: translate(-50%, -50%);
            /* Offset by half the div's width and height */
            border: 1px solid #ff0000;
            /* Example border */
            box-sizing: border-box;
            /* Ensures padding and border are included in width */
            animation: blink 3s infinite;
            font-weight: 700;
            font-size: 20px;
            border-radius: 10px;
        }

        @keyframes blink {

            0%,
            100% {
                color: #ed6b6b;
            }

            50% {
                color: white;
            }
        }

        .image-wrapper {
            width: 100%;
            padding-bottom: 100%;
            /* 1:1 aspect ratio */
            position: relative;
            overflow: hidden;
        }

        .image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
  <style>
    /* Container to control absolute positioning */
    .item-container {
        position: relative;
    }
    /* Default styling for normal screen sizes */
    .responsive-margin {
        position: absolute;
        right: 3px; /* Set initial right position to keep the element on the right */
        top: 142px; /* Adjust vertical alignment */
        max-width: 80px; /* Control width to avoid overflow */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    /* Responsive styling for 1366x768 screen size */
    @media (max-width: 1366px) and (max-height: 768px) {
        .responsive-margin {
            right: 3px; /* Shift further left on smaller screens */
            top: 120px; /* Adjust vertical alignment for smaller screen */
            max-width: 70px; /* Adjust width if needed */
        }
    }
</style>

<style>
        /* Container to control absolute positioning */
        .item-container {
            position: relative;
        }
        /* Default styling for normal screen sizes */
        .responsive-margin {
            position: absolute;
            right: 3px; /* Set initial right position to keep the element on the right */
            top: 142px; /* Adjust vertical alignment */
            max-width: 80px; /* Control width to avoid overflow */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        /* Responsive styling for 1366x768 screen size */
        @media (max-width: 1366px) and (max-height: 768px) {
            .responsive-margin {
                right: 3px; /* Shift further left on smaller screens */
                top: 120px; /* Adjust vertical alignment for smaller screen */
                max-width: 70px; /* Adjust width if needed */
            }
        }
    </style>

@endsection

@section('content')


    @if (Session::has('print'))
        <iframe id="contentFrame" src="{{ url('print') }}?id={{ Session::get('print_id') }}&re={{ Session::get('re') }}"
            style="width: 100%; height: 400px; border: 1px solid #ccc;display:none"></iframe>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
            integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const iframe = document.getElementById('contentFrame');
            const iframeWindow = iframe.contentWindow;

            // Open the print dialog for the iframe content
            iframeWindow.focus(); // Ensure the iframe is in focus
            iframeWindow.print();
        </script>
    @endif


    <?php
    $branch_id = auth()->user()->branch_id;
    $readonly = '';
    if (app('appSettings')['unit_price']->value == 'no') {
        $readonly = 'readonly';
    }
    $action = 'add';
    $paymodel_gt = $itemCount = 0;
    $PaymentLists = PaymentList($branch_id);
    $paymentCount = count($PaymentLists);
    $sale_order_id = '';
    $net_total = optional($sale_orders)->with_tax ? optional($sale_orders)->with_tax : '0';
    $gross_total = optional($sale_orders)->without_tax ? optional($sale_orders)->without_tax : '0';
    $customer_id = optional($sale_orders)->customer_id ? optional($sale_orders)->customer_id : '';
    $customer_uuid = optional($sale_orders)->customer_uuid ? optional($sale_orders)->customer_uuid : '';
    $customer_name = optional($sale_orders)->customer_name ? optional($sale_orders)->customer_name : '';
    $customer_number = optional($sale_orders)->customer_number ? optional($sale_orders)->customer_number : '';
    $customer_gender = optional($sale_orders)->customer_gender ? optional($sale_orders)->customer_gender : '';
    $customer_address = optional($sale_orders)->customer_address ? optional($sale_orders)->customer_address : '';
    $customer_email = optional($sale_orders)->customer_email ? optional($sale_orders)->customer_email : '';
    $order_type = optional($sale_orders)->order_type ? optional($sale_orders)->order_type : 'counter_sale';
    if ($customer !== null) {
        $customer_id = $customer->id ? $customer->id : '';
        $customer_uuid = $customer->uuid ? $customer->uuid : '';
        $customer_name = $customer->customer_name ? $customer->customer_name : '';
        $customer_number = $customer->customer_number ? $customer->customer_number : '';
        $customer_gender = $customer->customer_gender ? $customer->customer_gender : '';
        $customer_address = $customer->customer_address ? $customer->customer_address : '';
        $customer_email = $customer->customer_email ? $customer->customer_email : '';
    }
    if ($sale_orders) {
        $action = 'edit';
        $itemCount = optional($sale_orders)->sale_order_items->count();
    }
    $branch_data = auth()->user()->branch;
    $expiry_date = strtotime($branch_data->expiry_date);
    $validate = false;
    $timeDifference = $expiry_date - time();

    // Convert the difference to days
    $daysDifference = floor($timeDifference / (60 * 60 * 24));
    if ($daysDifference <= 15 && $daysDifference >= 0) {
        $validate = true;
    }
    ?>
    <input type="hidden" name="paymentCount" id="paymentCount" value="{{ $paymentCount }}">
    <input type="hidden" name="js_branch_vat" id="js_branch_vat" value="{{ getVat($branch_id)->vat_percent }}">
    <input type="hidden" name="branchvat" id="branchvat" value="{{ getVat($branch_id)->vat }}">
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn pb-0">
        <div class="container-fluid">
            <div class="az-content-body pos">
                <div class="row">
                    @if ($validate)
                        <div class="col-12 mt-1 mb-1 text-center parent-div">
                            <div class="expiry_message">
                                Renew Your Subscription to Continue Enjoying Our Services!
                            </div>
                        </div>
                    @endif
                    <div class="col-12 p-0">
                        <div class="az-dashboard-nav border-0 mb-0">
                            <nav class="nav">
                                <?php if($action == 'add'){?>
                                <button id="hold_frm" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2">
                                    <img src="{{ url('assets/img/hold.png') }}" alt="Hold"
                                        style="width: 15px; height: 12px;">
                                    <b>HOLD</b></button>
                                <?php } else {
                                  if($action == 'edit'){ ?>
                                <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2" id="rehold_frm">
                                    <img src="{{ url('assets/img/hold.png') }}" alt="Hold"
                                        style="width: 15px; height: 12px;">
                                    <b>SAVE
                                        HOLD</b></button>
                                <?php } } ?>
                                <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                    data-pop="xl" data-url="{{ url('hold-list') }}" data-toggle="modal"
                                    data-target="#dynamicPopup-xl" data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="mr-1"></i>
                                    <img src="{{ url('assets/img/gestures.png') }}" alt="Hold"
                                        style="width: 15px; height: 12px;">
                                    <b>HOLD LIST</b>
                                </button>
                                @if (app('appSettings')['delivery_sale']->value == 'yes')
                                    <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2" id="checkButton">
                                        <img src="{{ url('assets/img/motorbike.png') }}" alt="Hold"
                                            style="width: 15px; height: 12px;">
                                        <b>DELIVERY</b></button>
                                    {{-- <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                        data-pop="xl" data-url="{{ url('delivery-list') }}" data-toggle="modal"
                                        data-target="#dynamicPopup-xl"
                                        data-image="{{ url(config('constant.LOADING_GIF')) }}" ><i
                                            class="fa fa-plus-circle mr-1"></i> <b>DELIVERY LIST</b></button> --}}
                                @endif
                                <a class="nav-link rounded-10 mr-2 d-none" href="#"><i
                                        class="fas fa-ellipsis-h"></i></a>
                            </nav>
                        </div>
                    </div>
                    <input type="radio" name="order_type_val" value="counter_sale" id="radio1" style="display:none"
                        checked>
                    <input type="radio" name="order_type_val" value="delivery" id="radio2" style="display:none">

                    <div class="col-4 mb-2 p-0 pr-1">
                        {{-- mt-2  --}}
                        <div class="card card-body shadow rounded-10 mb-0 p-0 pos-cart-section">
                            <form id="formListItem" method="post" class="form-horizontal"
                                action="{{ url('order-post') }}">
                                @csrf
                                <div class="pos-cart-section-table">
                                    <table class="table table-striped table-borderless item_list">

                                        <thead>
                                            <tr>
                                                <th class="py-2 bg-transparent" style="width:35%">Items</th>
                                                <th class="py-2 bg-transparent text-center" style="width: 15%;">Qty</th>
                                                <th class="py-2 bg-transparent text-center" style="width: 15%;">U.Price</th>
                                                {{-- <th class="py-2 bg-transparent text-center" style="width: 15%;">Dis
                                                    ({{ app('appSettings')['currency']->value }})</th> --}}
                                                {{-- <th class="py-2 bg-transparent text-center" style="width: 100px;">Dis (%)
                                                </th> --}}
                                                <th class="py-2 bg-transparent text-right" style="width:35%">Price</th>
                                                <th class="py-2 bg-transparent text-right" style="width:35%">remove</th>

                                            </tr>
                                        </thead>

                                        <input type="hidden" name="PostForm" value="1" />
                                        <input type="hidden" name="order_type" id="order_type"
                                            value="{{ $order_type }}">
                                        <input type="hidden" name="customer_id" id="customer_id_form"
                                            value="{{ $customer_id }}">
                                        <input type="hidden" name="customer_uuid" id="customer_uuid_form"
                                            value="{{ $customer_uuid }}">
                                        <input type="hidden" name="customer_number" id="customer_number_form"
                                            value="{{ $customer_number }}">
                                        <input type="hidden" name="customer_name" id="customer_name_form"
                                            value="{{ $customer_name }}">
                                        <input type="hidden" name="customer_email" id="customer_email_form"
                                            value="{{ $customer_email }}">
                                        <input type="hidden" name="customer_address" id="customer_address_form"
                                            value="{{ $customer_address }}">
                                        <input type="hidden" name="customer_gender" id="customer_gender_form"
                                            value="{{ $customer_gender }}">
                                        <input type="hidden" name="grand_total" id="grand_total_form" value="0.0">

                                        <input type="hidden" name="amount_given" id="amount_given_form"
                                            value="{{ optional($sale_orders)->amount_given }}">

                                        <input type="hidden" name="payment_type" id="payment_type_form"
                                            value="{{ optional($sale_orders)->payment_type }}">

                                        <input type="hidden" name="discount" id="discount_form"
                                            value="{{ optional($sale_orders)->discount }}">

                                        <input type="hidden" name="discount_per" id="discount_per_form"
                                            value="{{ optional($sale_orders)->discount_per }}">

                                        <input type="hidden" name="pay_bill" id="pay_bill" value="no">

                                        <input type="hidden" name="payment_id" id="payment_id_form" value="">

                                        <input type="hidden" name="enter_amount" id="enter_amount_form" value="">

                                        <input type="hidden" name="credit" id="credit_id" value="">

                                        <input type="hidden" name="hold" id="hold_form" value="0">

                                        <input type="hidden" name="status" id="status_form" value="pending">

                                        <input type="hidden" name="payment_status" id="payment_status_form"
                                            value="{{ optional($sale_orders)->payment_status }}">

                                        <input type="hidden" name="sale_order_id"
                                            value="{{ optional($sale_orders)->id }}">

                                        <input type="hidden" name="staff_id" id="staff_id_form"
                                            value="{{ optional($sale_orders)->staff_id }}">

                                        <input type="hidden" name="driver_id" id="driver_id_form"
                                            value="{{ optional($sale_orders)->driver_id }}">

                                        <input type="hidden" name="gross_total" id="gross_total_form"
                                            value="{{ optional($sale_orders)->without_tax }}">

                                        <input type="hidden" name="tax_amount" id="tax_amount_form"
                                            value="{{ optional($sale_orders)->tax_amount }}">

                                        <input type="hidden" name="net_total" id="net_total_form"
                                            value="{{ $net_total }}">

                                        <input type="hidden" name="balance_amount" id="balance_amount_form"
                                            value="">

                                        <input type="hidden" id="item_total_amount" value="">
                                        <tbody id="item_append">
                                            @if ($itemCount > 0)

                                                @foreach ($sale_orders->sale_order_items as $key => $item)
                                                    <tr>
                                                        <td class="align-content-center" style="width:35%"><b>
                                                                {{ $item->item_name }}</b>
                                                            <span class="d-block text-dark discount_model"
                                                                style="font-size:16px"
                                                                onclick="discount_model('{{ $key + 1 }}')"><i
                                                                    class="fa fa-info-circle"></i></span>
                                                            <input type='hidden' name='price_id[]' class='price_id'
                                                                id='price_id' value="{{ $item->price_size_id }}">

                                                            <input type='hidden' name='category_id[]'
                                                                class='category_id' id='category_id'
                                                                value="{{ $item->category_id }}">

                                                            <input type='hidden' name='item_id[]' class='item_id'
                                                                id='item_id' value="{{ $item->item_id }}">

                                                            <input type='hidden' name='item_name[]' class='item_name'
                                                                value='{{ $item->item_name }}'>

                                                            <input type='hidden' name='item_price[]' id='item_price'
                                                                value='{{ $item->price }}'>

                                                            <input type='hidden' name='final_item_price[]'
                                                                class='final_item_price'
                                                                value='{{ $item->item_unit_price }}'>

                                                            <input type='hidden' name='item_stock[]' id='item_stock'
                                                                value="{{ currentItemPriceDetails($item->price_size_id)->stock }}">

                                                            <input type='hidden' name='tax_percent[]' id='tax_percent'
                                                                value='{{ getVat($branch_id)->vat_percent }}'>

                                                            <input type='hidden' name='tax_amt[]' class='tax_amt'
                                                                value='{{ $item->tax_amt }}'>

                                                            <input type='hidden' name='tax_amt_not_round[]'
                                                                class='tax_amt_not_round'
                                                                value='{{ $item->tax_amt_not_round }}'>

                                                            <input type='hidden' name='stock_applicable[]'
                                                                id='stock_applicable'
                                                                value='{{ currentItemDetails($item->item_id)->stock_applicable }}'>

                                                            <input type='hidden' name='total_price[]'
                                                                class='total_price' value='{{ $item->total_price }}'>

                                                            <input type='hidden' name='sale_order_item_id[]'
                                                                class='sale_order_item_id' value='{{ $item->id }}'>

                                                            <input type='hidden' name='item_price_cost_price[]'
                                                                class='item_price_cost_price'
                                                                value='{{ $item->cost_price }}'>

                                                            <input type="hidden" class="discount-percent"
                                                                name="discount_percent[]"
                                                                value="{{ $item->discount_percent }}">

                                                            <input type="hidden" class="discount-amount"
                                                                name="discount_amount[]"
                                                                value="{{ $item->discount_amount }}">

                                                            <input type="hidden" name="notes[]" class="notes"
                                                                value="{{ $item->notes }}">

                                                            <input type="hidden" name="old_quantity[]"
                                                                class="old_quantity" value="{{ $item->qty }}">
                                                        </td>
                                                        <td class="align-content-center p-0 py-1" style="width:15%">
                                                            <div class="input-group input-group-sm shadow rounded-10"
                                                                style="width: 80px;">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-dark minH0 reduce_btn"
                                                                        type="button"><i
                                                                            class="fa fa-minus"></i></button>
                                                                </div>
                                                                <input type="number"
                                                                    class="form-control py-3 border-0 text-center pos-qty qty"
                                                                    value="{{ $item->qty }}" name="qty[]"
                                                                    style="padding:0px">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-dark minH0 increase_btn"
                                                                        type="button"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-content-center p-0 py-1" style="width:15%">
                                                            <input type="number"
                                                                class="form-control py-3 border-0 text-center unit-price"
                                                                value="{{ formatToDecimals($item->item_unit_price) }}"
                                                                name="unit-price[]"
                                                                style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;padding:0px"
                                                                onfocus="this.select()" {{ $readonly }}>
                                                        </td>
                                                        {{-- <td class="align-content-center p-0 py-1">
                                                            <input type="number"
                                                                class="form-control py-3 border-0 text-center pos-qty discount-percent"
                                                                value="{{ $item->discount_percent }}"
                                                                name="discount_percent[]"
                                                                style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
                                                        </td>
                                                        <td class="align-content-center p-0 py-1">
                                                            <input type="number"
                                                                class="form-control py-3 border-0 text-center pos-qty discount-amount"
                                                                value="{{ $item->discount_amount }}"
                                                                name="discount_amount[]"
                                                                style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
                                                        </td> --}}
                                                        <td class="text-right align-content-center row_total"
                                                            style="width:35%;font-weight:600">
                                                            {{ formatToDecimals($item->total_price) }}
                                                        </td>
                                                       <td>
                                                            <button class="btn  remove-row-btn"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div id="scroll_list_item"></div>
                                </div>
                            </form>
                            @if ($itemCount > 0)
                                <?php $style = 'display:block'; ?>
                            @else
                                <?php $style = 'display:none !important'; ?>
                            @endif
                            <div class="d-block pos-cart-section-save rounded-10 p-3">
                                <h5 class="d-block">
                                    <span>Total <span class="small">(<span id="itemsCount">{{ $itemCount }}</span>
                                            Items)</span></span>
                                    <span class="float-right total_amount_show">{{ showAmount($net_total, 1) }}</span>
                                </h5>
                                <div class="btn-group w-100">
                                    {{-- <button type="button" class="btn btn-lg btn-outline-dark rounded-10"
                                        onclick="toggleButton()" style="width: 60px;"><i class="fa fa-bars"></i></button> --}}
                                    <button type="button"
                                        class="btn btn-lg btn btn-dark rounded-10 shadoww w-100 save-button amountcount"
                                        data-toggle="modal" data-target="#AmountPayModel"
                                        style="{{ $style }}">Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 p-0">
                        <div class="card card-body shadow rounded-10 mb-0 p-2 pos-category-section">
                            <div class="row px-3">
                                <button
                                    class="btn btn-white btn-block border text-dark rounded-10 shadow mb-2 mt-0 px-2 catlinks"
                                    style="height: 50px;" onclick="openCategory(event, 'all_cat')" id="defaultOpen">
                                    <h6 class="mb-0 text-left text-truncate">ALL </h6>
                                    <h5 class="mb-0 text-right text-truncate"></h5>
                                </button>
                                <?php $row = 1; ?>
                                @foreach ($categorys as $category)
                                    {{-- @if ($category->items->count() > 0) @if ($row == '1') id="defaultOpen" @endif --}}
                                    <button
                                        class="btn btn-white btn-block border text-dark rounded-10 shadow mb-2 mt-0 px-2 catlinks"
                                        style="height: 50px;"
                                        onclick="openCategory(event, '{{ $category->category_slug }}')">
                                        <h6 class="mb-0 text-left text-truncate">
                                            {{ Str::ucfirst($category->category_name) }}</h6>
                                        <h5 class="mb-0 text-right text-truncate">{{ $category->other_name }}</h5>
                                    </button>
                                    <?php $row++; ?>
                                    {{-- @endif --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php $barcode_style = 'col-md-6 pr-1'; ?>
                    @if (app('appSettings')['barcode']->value == 'no')
                        <?php $barcode_style = 'col-md-12'; ?>
                    @endif
                    <div class="col-6 p-0 pl-1">
                        <div class="card card-body shadow mb-2 p-2 pos-items-section-search">
                            <div class="row">
                                <div class="{{ $barcode_style }}">
                                    <input type="search" class="form-control" placeholder="type here to search items"
                                        id="ItemSearch">
                                    <ul id="dropdownItemSearch" class="dropdown-content-item"></ul>
                                    <!-- Dropdown items will be inserted here -->
                                </div>
                                @if (app('appSettings')['barcode']->value == 'yes')
                                    <div class="col-md-6 pl-1">
                                        <input type="search" class="form-control" placeholder="Scan Barcode Here"
                                            id="barcodeSearch">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card card-body shadow rounded-10 mb-2 p-2 pos-items-section">
                           <div class="d-flex flex-wrap align-items-start align-items-stretch" id="fetch-item-append">

                                @foreach ($items as $item)
                                    <div class="pos-item p-1 itemcontent {{ $item->category_slug }}">
                                        <button
                                            class="btn btn-block p-0 btn-white border text-dark rounded-10 shadow text-left pos-item-btn h-100 item-click"
                                            data-id="{{ $item->id }}"
                                            data-price_size_id="{{ $item->price_size_id }}"
                                            data-item_name="{{ $item->item_name }}"
                                            data-item_other_name="{{ $item->item_other_name }}"
                                            data-category_id="{{ $item->category_id }}"
                                            data-item_stock="{{ $item->item_stock }}" data-tax="{{ $item->tax }}"
                                            data-tax_percent="{{ $item->tax_percent }}"
                                            data-unit_id="{{ $item->unit_id }}"
                                            data-item_price_cost_price="{{ $item->item_price_cost_price }}"
                                            data-price="{{ $item->price }}"
                                            data-stock_applicable="{{ $item->stock_applicable }}"
                                            data-price_id="{{ $item->price_id }}">
                                            <p class="mb-0 px-2  py-1 text-right pos-item-price z-index-10"><b>
                                                    {{ showAmount($item->price, 1) }}</b>
                                            </p>
                                          <div class="item-container">
                                            <p class="mb-0 px-2 py-1 text-right pos-item-price z-index-10 responsive-margin">
                                                <b>{{ $item->item_stock }}</b>
                                            </p>
                                        </div>

                                        

                                            @if ($item->image)
                                                <div class="image-wrapper">
                                                    <img src="{{ url('storage/item_image') . '/' . optional($item)->image }}"
                                                        alt="{{ $item->item_name }}" class="img-fluid"
                                                        onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp') }}';">
                                                </div>
                                            @else
                                                <div class="img-wrapper">
                                                    <img src="{{ url('assets/img/error-image.webp') }}"
                                                        alt="{{ $item->item_name }}" class="img-fluid">
                                                </div>
                                            @endif
                                            <?php
                                            $stock = '';
                                            if (app('appSettings')['stock_show']->value == 'yes') {
                                                $stock = $item->stock_applicable ? ' ( ' . $item->item_stock . ' )' : '';
                                            }
                                            ?>
                                            <div class="desc">
                                                @if ($item->size_name === 'Unit price')
                                                    {{ '' }}
                                                @else
                                                    {{ $item->size_name }}
                                                @endif

                                          {{--      <p class="mb-1 border-bottom text-truncate"
                                                    title="{{ $item->item_stock }}">
                                                    {{ getPriceName(auth()->user()->branch_id, $item->price_size_id) }}
                                                </p>--}}
                                                <p class="mb-0 d-flex align-items-center justify-content-between"
                                                    style="height: 23px !important;  "
                                                    title="{{ Str::ucfirst($item->item_name) }}">
                                                    <b class="flex-grow-1 ">{{ Str::ucfirst($item->item_name) }}</b>
                                                </p>
                                                <p class="mb-0 d-flex align-items-center justify-content-between text-right"
                                                    style="height: 23px !important;  "
                                                    title="{{ $item->item_other_name }}">
                                                    <b class="flex-grow-1 ">{{ $item->item_other_name }}</b>
                                                </p>

                                            </div>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AmountPayModel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-lg">
                <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="material-symbols-outlined">
                                                            close
                                                        </span>
                                                    </button> -->
                    <div class="row">
                        <div class="col-sm-12 text-center mb-3 px-3 pt-0">
                            <div class="card rounded-10 bg-dark">
                                <div class="card-body">
                                    <h5 class="mb-0 text-uppercase text-white">TOTAL</h5>
                                    <h1 style="font-size: 4rem;" class="fw-bolder text-white mb-0">
                                        <span
                                            style="font-size: 1.5rem;">{{ app('appSettings')['currency']->value }}</span>
                                        <span class="paymodel_gt"
                                            style="display: none">{{ showAmount($gross_total) }}</span>
                                        <span class="paymodel_gt_total">{{ showAmount($gross_total) }}</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-0">
                                <input type="number" class="form-control px-3 h-auto form-control-lg"
                                    style="border-radius: 10px 0 0 0;" name="customer_number"
                                    placeholder="Contact Number" id="customer_number" value="{{ $customer_number }}">
                                <input type="text" class="form-control px-3 h-auto form-control-lg rounded-0"
                                    name="customer_name" placeholder="Name" id="customer_name"
                                    value="{{ $customer_name }}">
                                <input type="text" class="form-control px-3 h-auto form-control-lg"
                                    style="border-radius: 0 10px 0 0;" name="customer_email" placeholder="Email"
                                    value="{{ $customer_email }}" id="customer_email">

                            </div>
                            <ul id="dropdown" class="dropdown-content"></ul>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <select class="form-control border-top-0 px-3 h-auto form-control-lg"
                                    style="border-radius: 0 0 0 10px;width:33.33%" name="customer_gender"
                                    id="customer_gender">
                                    <option value="">Choose Gender</option>
                                    <option value="male" @if ($customer_gender == 'male') selected @endif>
                                        Male</option>
                                    <option value="female" @if ($customer_gender == 'female') selected @endif>
                                        Female</option>
                                </select>
                                <input type="text" class="form-control border-top-0 h-auto px-3 form-control-lg"
                                    style="border-radius: 0 0 10px 0;width:66.67%" name="customer_address"
                                    placeholder="Address" id="customer_address" value="{{ $customer_address }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4 pr-1 float-left">
                                    <h5 class="text-center d-block">Discount by Amount</h5>
                                    {{-- <input type="number" step="any"
                                        class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark" id=""
                                        style="font-size: 2rem;"> --}}
                                    <input type="number" step="any"
                                        class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark discount_in_amt"
                                        id="discount_in_amt" style="font-size: 2rem;" name="discount_in_amt">
                                </div>
                                <div class="col-4 px-1 float-left">
                                    <h5 class="text-center d-block">Discount by %</h5>
                                    <input type="number" step="any"
                                        class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark discount_in_percentage"
                                        id="discount_in_percentage" name="discount_in_percentage"
                                        style="font-size: 2rem;" value="">
                                </div>
                                <div class="col-4 pl-1 pr-1 float-left">
                                    <h5 class="text-center d-block">Amount Payable</h5>
                                    <input type="number" step="any"
                                        class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark amount_payable"
                                        style="font-size: 2rem;" readonly value="{{ showAmount($net_total) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row justify-content-center" id="tpaymenbody">
                                <?php $no = 1; ?>
                                @foreach ($PaymentLists as $PaymentList)
                                    @if (
                                        $PaymentList->payment_method_slug == 'cash' ||
                                            $PaymentList->payment_method_slug == 'card' ||
                                            $PaymentList->payment_method_slug == 'credit')
                                        <?php
                                        $pay = null;
                                        if (optional($sale_orders)->id) {
                                            $pay = getPaymentByID($sale_orders->id, $PaymentList->payment_method_slug);
                                            if ($pay) {
                                                $pay = $pay->amount;
                                            }
                                        }

                                        ?>
                                        <div class="col-3 pr-1 float-left">
                                            <h5 class="text-center d-block">
                                                {{ Str::upper($PaymentList->payment_method_name) }}</h5>
                                            <input type="number" step="any"
                                                class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark enter_amount"
                                                id="enter_amount{{ $no }}" style="font-size: 2rem;"
                                                name="enter_amount[]" data-id="{{ $PaymentList->id }}"
                                                data-method="{{ $PaymentList->payment_method_slug }}"
                                                value="{{ $pay }}">
                                        </div>
                                        @if ($no == '1')
                                            <?php $no++; ?>
                                        @endif
                                    @endif
                                @endforeach
                                <!-- Show this section if payment method is not CASH, CARD, or CREDIT -->
                                <div class="col-1 pl-1 pr-1 float-left" id="addButton">
                                    <h5 class="text-center d-block">&nbsp;</h5>
                                    <button type="button"
                                        class="btn btn-lg btn-outline-dark rounded-10 btn-block py-2"><i
                                            class="fa fa-plus-square"></i></button>
                                </div>
                                <!-- Show this section if payment method is not CASH, CARD, or CREDIT -->
                            </div>
                            <!-- Show this section onclick PLUS button -->
                            <div class="row justify-content-center mt-2 otherPaymentMethod" style="display: none;">
                                <div class="col-3 pr-1 float-left">
                                    <select class="form-control px-3 h-auto py-2 rounded-10" name=""
                                        id="other_payment_id">
                                        <option value="">Choose Method</option>
                                        @foreach ($PaymentLists as $PaymentList)
                                            @if (
                                                $PaymentList->payment_method_slug != 'cash' &&
                                                    $PaymentList->payment_method_slug != 'card' &&
                                                    $PaymentList->payment_method_slug != 'credit')
                                                <option value="{{ $PaymentList->payment_method_slug }}"
                                                    data-id="{{ $PaymentList->id }}">
                                                    {{ $PaymentList->payment_method_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 px-1 float-left">
                                    <input type="number" step="any"
                                        class="form-control rounded-10 bg-white text-center text-dark enter_amount"
                                        style="font-size: 2rem;" name="enter_amount[]" id="other_enter_amount">
                                </div>
                                <div class="col-1 pl-1 pr-1 float-left" id="removeButton">
                                    <button type="button" class="btn btn-outline-danger pt-2 rounded-10 btn-block"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- Show this section onclick PLUS button -->
                            <div class="row mt-3" id="deliveryBody" style="display: none;">
                                <h5 class="text-center d-block w-100">SELECT DRIVER</h5>
                                <div class="col-12 d-flex pb-3 justify-content-center overflow-auto scrollable-element">
                                    @foreach ($drivers as $driver)
                                        <div class="d-flex w-auto mr-2">
                                            <div class="form-group mt-0 mb-0 border rounded-10">
                                                <div class="form-check">
                                                    <input class="form-check-input mt-0" style="height: 18px;width:18px;"
                                                        type="radio" name="driver" id="{{ $driver->id }}"
                                                        value="{{ $driver->id }}"
                                                        @if (optional($sale_orders)->driver_id == $driver->id) @checked(true) @endif>
                                                    <label class="form-check-label d-block p-2 pr-3"
                                                        for="{{ $driver->id }}">
                                                        {{ Str::ucfirst($driver->driver_name) . ' (' . $driver->driver_code . ')' }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Show this section onclick PLUS button -->
                            @if (app('appSettings')['staff_pin']->value == 'yes')
                                <div class="row justify-content-center mt-2">
                                    <div class="col-3 pr-1 float-left">
                                        <h5 class="text-center d-block">Staff Pin</h5>
                                        <input type="password" step="any"
                                            class="form-control form-control-lg py-4 rounded-10 bg-white text-center text-dark pin_number"
                                            style="font-size: 2rem;" name="pin_number" id="pin_number">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark rounded-10 px-4 text-uppercase rounded-10 submit-form"
                        id="submit-form">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="AmountPayModel" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-10 popupContents-xl">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Pay Amount
                        ({{ app('appSettings')['currency']->value }}) </h5>
                </div>
                <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                    <h5 class="text-center"><span class="paymodel_gt">{{ showAmount($net_total) }}</span></h5>
                    <div class="row">
                        <div class="col-12 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Discount %</label>
                                <input type="number" class="form-control rounded-10 discount_in_percentage"
                                    id="discount_in_percentage" placeholder="" name="discount_in_percentage"
                                    required="" autofocus="" value="{{ optional($sale_orders)->discount_per }}">
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Customer Number</label>
                                <input type="number" class="form-control rounded-10" id="customer_number"
                                    placeholder="" name="customer_number" required="" autofocus=""
                                    value="{{ $customer_number }}">
                                <ul id="dropdown" class="dropdown-content">
                                </ul>
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Customer Name</label>
                                <input type="text" class="form-control rounded-10" id="customer_name" placeholder=""
                                    name="customer_name" required="" autofocus="" value="{{ $customer_name }}">
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Customer Email</label>
                                <input type="text" class="form-control rounded-10" id="customer_email" placeholder=""
                                    name="customer_email" required="" autofocus="" value="{{ $customer_email }}">
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Customer Gender</label>
                                <select class="form-control rounded-10" id="customer_gender" placeholder=""
                                    name="customer_gender" required="">
                                    <option value="male" @if ($customer_gender == 'male') selected @endif>
                                        Male</option>
                                    <option value="female" @if ($customer_gender == 'female') selected @endif>
                                        Female</option>
                                </select>
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-8 mt-2 mb-2">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Customer Address</label>
                                <input type="text" class="form-control rounded-10" id="customer_address"
                                    placeholder="" name="customer_address" required="" autofocus=""
                                    value="{{ $customer_address }}">
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-12" id="tpaymenbody">
                            <div class="row">
                                <input type="hidden" name="auto_inc" id="auto_inc" value="1">
                                <div class="col-5 mt-2 mb-2 hidePaymentID">
                                    <label class="mb-0">Select Payment</label>
                                    <select class="form-control rounded-10 onChange payment_id" id="payment_id1"
                                        name="payment_id[]" required="" data-index="1">
                                        @foreach ($PaymentLists as $PaymentList)
                                            <option value="{{ $PaymentList->payment_method_slug }}"
                                                data-id="{{ $PaymentList->id }}">
                                                {{ $PaymentList->payment_method_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                                <div class="col-5 mt-2 mb-2 hideEnterAmount">
                                    <label class="mb-0">Enter Amount</label>
                                    <input type="number" class="form-control rounded-10 enter_amount" id="enter_amount1"
                                        placeholder="" name="enter_amount[]" required="" autofocus=""
                                        value="" data-index="1">
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                                <div class="col-2 mt-2 mb-2 hideAddBtn">
                                    <label class="mb-0">Add Another</label>
                                    <div>
                                        <button class="btn btn-dark px-3" id="addBtn" type="button"
                                            style="border-radius:10px;">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="deliveryBody" style="display: none;">
                            <label class="mb-0">Select Driver</label>
                            <div class="row">
                                @foreach ($drivers as $driver)
                                    <div class="col-md-4 mt-2 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="driver"
                                                id="<?php //echo $driver->id;
                                                ?>" value="<?php //echo $driver->id;
                                                ?>"
                                                @if (optional($sale_orders)->driver_id == $driver->id) @checked(true) @endif>
                                            <label class="form-check-label" for="<?php //echo $driver->id;
                                            ?>">
                                                {{ Str::ucfirst($driver->driver_name) . ' (' . $driver->driver_code . ')' }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (app('appSettings')['staff_pin']->value == 'yes')
                            <div class="col-12 mt-2 mb-2">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Staff Pin</label>
                                    <input type="password" class="form-control rounded-10 pin_number" id="pin_number"
                                        placeholder="" name="pin_number" required="" autofocus="">
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 mt-2 mb-2" id="paymodel_bm_show">
                            <h4 class="mb-0">Balance Amount: <span class="paymodel_bm"> 0.00</span></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark rounded-10 px-4 text-uppercase rounded-10 submit-form"
                        id="submit-form">Sumbit</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="discount_popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Enter Discount</h5>
                </div>
                <div class="col-12 p-0">
                    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                        <input type="hidden" name="item_count" class="item_count">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-2">Discount ({{ app('appSettings')['currency']->value }})</label>
                                    <input type="number" class="form-control rounded-10 discount_model_amount"
                                        id="discount_model_amount" placeholder="" name="discount_model_amount"
                                        required="" autofocus="" value="" onfocus="this.select()">
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-2">Discount (%)</label>
                                    <input type="number" class="form-control rounded-10 discount_model_percent"
                                        id="discount_model_percent" placeholder="" name="discount_model_percent"
                                        autofocus="" value="" onfocus="this.select()">
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-2">Notes</label>
                                    <input type="text" class="form-control rounded-10 discount_model_notes"
                                        id="discount_model_notes" placeholder="" name="discount_model_notes"
                                        autofocus="" value="">
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-2 bg-transparent text-center">Discount
                                        ({{ app('appSettings')['currency']->value }})</th>
                                    <th class="py-2 bg-transparent text-center">Discount (%)
                                    </th>
                                    <th class="py-2 bg-transparent text-center">Notes
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 bg-transparent text-center">Discount
                                        ({{ app('appSettings')['currency']->value }})</td>
                                    <td class="py-2 bg-transparent text-center">Discount (%)
                                    </td>
                                    <td class="py-2 bg-transparent text-center">Notes
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 bg-transparent text-center">
                                        <input type="number"
                                            class="form-control py-3 border-0 text-center pos-qty discount_model_amount"
                                            value="" name="discount_model_amount"
                                            style="margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
                                    </td>
                                    <td class="py-2 bg-transparent text-center">
                                        <input type="number"
                                            class="form-control py-3 border-0 text-center pos-qty discount_model_percent"
                                            value="" name="discount_model_percent"
                                            style="margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
                                    </td>
                                    <td class="py-2 bg-transparent text-center">
                                        <input type="text"
                                            class="form-control py-3 border-0 text-center pos-qty discount_model_percent"
                                            value="" name="discount_model_percent"
                                            style="margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    {{-- </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                            data-dismiss="modal">Close</button>
                        {{-- <button type="submit"
                            class="btn btn-dark px-4 text-uppercase rounded-10 submit_discount">Save</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    @if (app('appSettings')['barcode']->value == 'yes')
        <script>
            focustoid("barcodeSearch");
        </script>
    @endif
    <script>
          $(document).ready(function () {
            // $('#ajax-loader').fadeIn(); // Fade in loader
            $.ajax({
                url: "{{ url('fetch-items') }}",
                type: 'GET',
                success: function (res) {
                    $('#fetch-item-append').append(res.html);
                    $('#remaining-items-loader').remove();
                },
                error: function () {
                    alert('Something went wrong while loading items. Please try again.');
                },
                complete: function () {
                    // $('#ajax-loader').fadeOut();
                }
            });
        });
        function discount_model(item_count) {
            $(".item_count").val(item_count);
            var amount = parseFloat($("tr:nth-child(" + item_count + ") td:nth-child(1) input.discount-amount").val());
            var percent = parseFloat($("tr:nth-child(" + item_count + ") td:nth-child(1) input.discount-percent").val());
            var notes = $("tr:nth-child(" + item_count + ") td:nth-child(1) input.notes").val();
            if (amount <= 0 || amount == '') {
                amount = '';
            }
            if (percent <= 0 || percent == '') {
                percent = '';
            }
            $('.discount_model_amount').val(amount);
            $('.discount_model_percent').val(percent);
            $('.discount_model_notes').val(notes);
            $("#discount_popup").modal('show');
        }

        // $('.submit_discount').on('click', function() {
        //     var item_count = $(".item_count").val();
        //     var amount = $('.discount_model_amount').val();
        //     var percent = $('.discount_model_percent').val();
        //     // var amount = parseFloat($("tr:nth-child(" + item_count + ") td:nth-child(1) input.discount-amount").val(amount));
        //     // var percent = parseFloat($("tr:nth-child(" + item_count + ") td:nth-child(1) input.discount-percent").val(percent));
        //     var item_count = $(".item_count").val('');
        //     var amount = $('.discount_model_amount').val('');
        //     var percent = $('.discount_model_percent').val('');
        //     sb_total();
        //     $("#discount_popup").modal('hide');
        // })

        document.addEventListener('click', function(event) {
            let openItems = document.querySelectorAll('ul');
            openItems.forEach(function(item) {
                if (!item.contains(event.target)) {
                    item.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('ul').forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });


        function changeDeliverystatus(sale_id) {
            // $(document).on("change", ".changedeliverystatus", function (e) {
            var sale_id = $(this).data("sale_id");
            var status = $(this).val();
            if (sale_id && confirm("Are you sure, You want to change status?")) {
                $.ajax({
                    url: "{{ url('change-delivery-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sale_id: sale_id,
                        status: status,
                    },
                    type: "post",
                    success: function(response) {
                        if (response == "success") {
                            notifyme2("Status Changed succesfully");
                            // window.location.href = "{{ url('home') }}";
                        } else {
                            notifyme2("Something Went Wrong! please try again.");
                        }
                    },
                });
            } else {
                return false;
            }
        }
        // });
        if ("{{ app('appSettings')['delivery_sale']->value }}" == "yes") {
            document.addEventListener('DOMContentLoaded', (event) => {
                const button = document.getElementById('checkButton');
                const radio1 = document.getElementById('radio1');
                const radio2 = document.getElementById('radio2');
                // const paymentBody = document.getElementById('tpaymenbody');
                const deliveryBody = document.getElementById('deliveryBody');
                // const paymodel_bm_show = document.getElementById('paymodel_bm_show');

                button.addEventListener('click', () => {
                    if (!radio1.checked && !radio2.checked) {
                        notifyme2("Delivery Sale Disabled");
                        radio2.checked = false;
                        radio1.checked = true;
                        button.classList.remove('checked');
                        button.classList.add('btn-dark');
                        // paymentBody.style.display = 'block';
                        deliveryBody.style.display = 'none';
                        // paymodel_bm_show.style.display = 'block';
                        $('#order_type').val('counter_sale');
                    } else if (radio1.checked) {
                        notifyme2("Delivery Sale Enabled");
                        radio1.checked = false;
                        radio2.checked = true;
                        button.classList.remove('btn-dark');
                        button.classList.add('checked');
                        // paymentBody.style.display = 'none';
                        deliveryBody.style.display = 'block';
                        // paymodel_bm_show.style.display = 'none';
                        $('#order_type').val('delivery');
                    } else {
                        notifyme2("Delivery Sale Disabled");
                        radio2.checked = false;
                        radio1.checked = true;
                        button.classList.remove('checked');
                        button.classList.add('btn-dark');
                        // paymentBody.style.display = 'block';
                        deliveryBody.style.display = 'none';
                        // paymodel_bm_show.style.display = 'block';
                        $('#order_type').val('counter_sale');
                    }
                });
            });
        }

        if ('{{ $action }}' == 'edit' && '{{ $order_type }}' == 'delivery') {
            const button = document.getElementById('checkButton');
            const radio1 = document.getElementById('radio1');
            const radio2 = document.getElementById('radio2');
            const paymentBody = document.getElementById('tpaymenbody');
            const deliveryBody = document.getElementById('deliveryBody');
            const paymodel_bm_show = document.getElementById('paymodel_bm_show');
            radio1.checked = false;
            radio2.checked = true;
            button.classList.remove('btn-dark');
            button.classList.add('checked');
            // paymentBody.style.display = 'none';
            deliveryBody.style.display = 'block';
            paymodel_bm_show.style.display = 'none';
            $('#order_type').val('delivery');
            button.disabled = true;
        }

        function openCategory(evt, catSlug) {
            var i, itemcontent, catlinks;
            itemcontent = document.getElementsByClassName("itemcontent"); //item

            for (i = 0; i < itemcontent.length; i++) {
                if (catSlug != 'all_cat') {
                    itemcontent[i].style.display = "none";
                } else {
                    itemcontent[i].classList.add("all_cat_items");
                }
            }

            catlinks = document.getElementsByClassName("catlinks"); //category
            for (i = 0; i < catlinks.length; i++) {
                catlinks[i].className = catlinks[i].className.replace(" active-cat btn-dark", "");
            }

            $("." + catSlug).css('display', 'block');
            if (catSlug == 'all_cat') {
                $(".all_cat_items").css('display', 'block');
            }
            evt.currentTarget.className += " active-cat btn-dark";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click(); //category

        $("#addButton").on("click", function() {
            $(".otherPaymentMethod").css('display', '');
        });

        $("#removeButton").on("click", function() {
            $(".otherPaymentMethod").css('display', 'none');
            $("#other_enter_amount").val('');
            $("#other_payment_id").val('');
            calculate_payable_amount();
        });

        $("#other_payment_id").on("change", function() {
            var payment_type = $(this).val();
            $('#other_enter_amount').data('method', payment_type);
        });

        var paymentCount = $('#paymentCount').val();
        $(document).ready(() => {
            var auto_inc = $('#auto_inc').val();
            var i = parseInt(auto_inc) + parseInt(1);
            var count = 1;
            $('#addBtn').click(function() {
                let dynamicRowHTML = `
                <div class="row removePayment` + count + `">
                    <div class="col-5 mt-2 mb-2 >
                        <label class="mb-0">Select Payment</label>
                        <select class="form-control rounded-10 onChange payment_id" id="payment_id` + count + `" name="payment_id[]"
                            required="" data-index="` + count + `">
                            @foreach ($PaymentLists as $PaymentList)
                                <option value="{{ $PaymentList->payment_method_slug }}" data-id="{{ $PaymentList->id }}">
                                    {{ $PaymentList->payment_method_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                    <div class="col-5 mt-2 mb-2">
                        <label class="mb-0">Enter Amount</label>
                        <input type="number" class="form-control rounded-10 enter_amount" id="enter_amount` + count + `" placeholder=""
                            name="enter_amount[]" required="" autofocus=""
                            value="" data-index="` + count + `">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                    <div class="col-2 mt-2 mb-2">
                        <label class="mb-0">Remove</label>
                        <div>
                            <button onclick='removetr(` + count + `)' class="btn btn-outline-dark px-3" style="border-radius:10px;">
                                <i class="fa fa-minus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>`;
                // if (paymentCount == count) {
                //     notifyme2("Maximum Payment method row added");
                //     return false;
                // }
                $('#tpaymenbody').append(dynamicRowHTML);
                count++;
            })
        });

        function removetr(count) {
            $(".removePayment" + count).remove();
            calculate_payable_amount();
        }
    </script>

    @include('Counter.salejs')
@endsection
