@extends('Admin.theme')

@section('title', 'PAYMENT TRANSFER')

@section('style')

@endsection

@section('content')

    <?php

    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');

    ?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Payment Transfer</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('stock_transfer_create') && getbranchid())
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="md"
                                    data-url="{{ url('admin/payment-transfer/create') }}?shop={{ $branch_id }}"
                                    data-toggle="modal" data-target="#dynamicPopup-md"
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif
                        </nav>
                    </div>
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                        <input type="date"
                                            value="{{ $from_date }}"
                                            name="from_date" class="form-control rounded-10" onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date" value="{{ $to_date }}" name="to_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Payment Method</label>
                                        <select class="form-control rounded-10 select2" id="payMethod" name="payMethod"
                                            onchange="this.form.submit()">
                                            <option value="">Select Payment</option>
                                            @foreach ($paymentMethods as $paymentMethod)
                                                @if (strtolower($paymentMethod->payment_method_name) !== 'credit')
                                                    <option value="{{ $paymentMethod->payment_method_slug }}"
                                                        @if ($paymentMethod->id == $payMethod) selected="selected" @endif>
                                                        {{ $paymentMethod->payment_method_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-dark rounded-10 px-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-12">


                        <div class="card rounded-10 shadow">
                            <div class="card-body overflow-auto">
                                <table id="example" class="table table-hover table-custom border-bottom-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Transfer Date</th>
                                            <th>From Payment</th>
                                            <th>To Payment</th>
                                            <th>notes</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($paymentTransfers) > 0)
                                            @foreach ($paymentTransfers as $key => $paymentTransfer)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ dateFormat($paymentTransfer->transaction_date) }}</td>
                                                    <td>{{ Str::ucfirst($paymentTransfer->source_payment_type) }}</td>
                                                    <td>{{ Str::ucfirst($paymentTransfer->destination_payment_type) }}</td>
                                                    <td>{{ Str::ucfirst($paymentTransfer->notes) }}</td>
                                                    <td>{{ showAmount($paymentTransfer->amount) }}</td>
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

@endsection

@section('script')

@endsection
