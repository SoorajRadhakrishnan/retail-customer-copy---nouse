@extends('Admin.theme')

@section('title', 'EDIT REPORT ')

@section('style')

@endsection

@section('content')


    <?php

    // $receipt_id = (isset($_GET['receipt_id']) && $_GET['receipt_id'] != '') ? $_GET['receipt_id'] : '';
    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
    $settlecheck = getLastsettledate(1);
    $settle_date = null;
    if ($settlecheck != null) {
        $settle_date = getLastsettledate(1)->settle_date;
    }
    // $PaymentLists = PaymentList(auth()->user()->branch_id);
    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Sale Edit Report</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                        <input type="date" value="{{ $from_date }}" name="from_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date" value="{{ $to_date }}" name="to_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Customer</label>
                                        <select class="form-control rounded-10 select2" id="customer_id" name="customer"
                                            onchange="this.form.submit()">
                                            <option value="">Select Customer</option>
                                            <?php $customers = getCustomerall(auth()->user()->branch_id); ?>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if ($customer->id == $customer_id) selected="selected" @endif>
                                                    {{ $customer->customer_number . ' - ' . Str::ucfirst($customer->customer_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Payment Type</label>
                                        <select class="form-control rounded-10" id="payment_type" name="payment_type" onchange="this.form.submit()">
                                            <option value="">Select Type</option>
                                            <?php $PaymentLists = PaymentList(auth()->user()->branch_id); ?>
                                            @foreach ($PaymentLists as $PaymentList)
                                                <option value="{{ $PaymentList->payment_method_name }}"
                                                    @if ($PaymentList->payment_method_name == $payment_type) selected="selected" @endif>
                                                    {{ Str::ucfirst($PaymentList->payment_method_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Order Type</label>
                                        <select class="form-control rounded-10 select2" id="order_type" name="order_type"
                                            onchange="this.form.submit()">
                                            <option value="">Select Order Type</option>
                                            <option value="counter_sale"
                                                @if ('counter_sale' == $order_type) selected="selected" @endif>
                                                Counter Sale
                                            </option>
                                            <option value="delivery"
                                                @if ('delivery' == $order_type) selected="selected" @endif>
                                                Delivery Sale
                                            </option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Receipt No.</label>
                                        <input type="text" value="{{ $receipt_id }}" name="receipt_id"
                                            class="form-control rounded-10" onchange="this.form.submit()">
                                    </div> --}}
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
                <div class="col-12 mt-4">
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <table id="example" class="table table-custom" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.No</th>
                                                <th>Receipt ID</th>
                                                <th>Ordered Date</th>
                                                <th>Order Type</th>
                                                <th>Customer</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                                <th class="text-center">Previous Bill</th>
                                            </tr>
                                        </thead>
                                        <?php $total_credit = $total_debit = $total_balance = 0; ?>
                                        <tbody>
                                            @if (count($exchange) > 0)
                                                @foreach ($exchange as $key => $value)
                                                    <?php
                                                    $settle = $settle_date < $value->ordered_date;
                                                    $order_payment = '';
                                                    foreach ($value->sale_order_payments as $payment) {
                                                        $order_payment .= $order_payment ? ', ' : '';
                                                        $order_payment .= $payment->payment_type . ': ' . showAmount($payment->amount);
                                                    }
                                                    // $url = url('admin/print_dashboard') . '?id=' . $value->id . '&re=dashboard';
                                                    ?>
                                                    <tr>
                                                        <td style="width: 5%">{{ $key + 1 }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Receipt ID">{{ $value->receipt_id }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Ordered Date">{{ dateFormat($value->ordered_date, 1) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Order Type">
                                                            {{ Str::ucfirst(str_replace('_', ' ', $value->order_type)) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Customer">
                                                            {{ $value->customer_number ? Str::ucfirst($value->customer_name) . ' (' . $value->customer_number . ')' : '' }}
                                                        </td>




                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Gross Total">{{ showAmount($value->without_tax) }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Discount">{{ showAmount($value->discount) }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Net Total">
                                                            {{ showAmount($value->with_tax) }} <br> {{ $order_payment }}
                                                        </td>
                                                        <?php $url = url('print') . '?id=' . $value->id; ?>
                                                        <td class="text-center">
                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Items">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                    title="Open Drawer" data-pop="xl"
                                                                    data-url="{{ url('admin/sale-order/' . $value->id . '/edit') }}?sale_order_id={{ $value->id }}"
                                                                    data-toggle="modal" data-target="#dynamicPopup-xl"
                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                    <i class="fa fa-list"></i>
                                                                </a>
                                                            </div>
                                                            {{-- <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Print">
                                                                <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                    href="javascript:void(0)"
                                                                    onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                        class="fa fa-print"></i>
                                                                </a>
                                                            </div> --}}



                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="if"></div>
    <!-- Delete Confirmation Modal -->
    <!-- Delete Confirmation Modal -->


@endsection

@section('script')



@endsection
