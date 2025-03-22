@extends('Counter.Layout.theme')

@section('title', 'DRIVER WISE LOG')

@section('style')

@endsection

@section('content')

<?php $PaymentLists = PaymentList(auth()->user()->branch_id);?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Driver Wise Log</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right ">
                            <nav class="nav">
                                <a id="createbtn"
                                   class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center"
                                   href="{{ url('delivery-log') }}">
                                   Deliver Log
                                </a>
                            </nav>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Driver</label>
                                        <select class="form-control rounded-10 select2" id="driver_id" name="driver"
                                            onchange="this.form.submit()">
                                            <option value="">Choose</option>
                                            <?php $drivers = getDriverall(auth()->user()->branch_id); ?>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}"
                                                    @if ($driver->id == $driver_id) selected="selected" @endif>
                                                {{ Str::ucfirst($driver->driver_name) ." (".$driver->driver_code . ')'}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if (count($sale_orders) > 0)
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Select payment *</label>
                                            <select id="payment_type"
                                            class="form-control rounded-10" >
                                                <option value="">Select Payment Type</option>
                                                @foreach ($PaymentLists as $PaymentList)
                                                    @if ($PaymentList->payment_method_slug != 'credit')
                                                        <option value="{{ $PaymentList->payment_method_slug }}"
                                                            data-id="{{ $PaymentList->id }}">
                                                            {{ $PaymentList->payment_method_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
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

                <form action="{{ url('driver-order-close') }}" method="POST" id="driver-form">
                    @csrf
                    <div class="col-12 mt-4">
                        <div class="row p-2">
                            <div class="col-12">
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <table id="" class="table table-custom" style="width:100%">
                                            <input type="hidden" name="payment_type" class="payment_type">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class=" checkAll" id="checkAll"></th>
                                                    <th>Receipt No.</th>
                                                    <th>Customer Number</th>
                                                    <th>Discount</th>
                                                    <th>Amount</th>
                                                    <th>Ordered date</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($sale_orders) > 0)
                                                    @foreach ($sale_orders as $key => $delivery)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="checkDelivery[{{ $delivery->id }}]" class=" saleCheckbox" value="{{ $delivery->with_tax }}">
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt No.">
                                                                {{ Str::ucfirst($delivery->receipt_id) }}
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Customer Number">
                                                                {{ Str::ucfirst($delivery->customer_name)." (".$delivery->customer_number.")" }}
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Discount">
                                                                {{ showAmount($delivery->discount) }}
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Amount">
                                                                {{ showAmount($delivery->with_tax) }}
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Ordered date">
                                                                {{ dateFormat($delivery->ordered_date,1) }}
                                                            </td>
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Status">
                                                                {{ Str::ucfirst(str_replace('_', ' ',$delivery->status)) }}
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Items">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                        data-pop="lg"
                                                                        data-url="{{ url('recent-sale/create') }}?id={{ $delivery->id }}"
                                                                        data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                        data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                </div>
                                                                <?php $url = url('print') . '?id=' . $delivery->id . '&re=dashboard'; ?>
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Print">
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                        href="javascript:void(0)"
                                                                        onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                            class="fa fa-print"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="az-dashboard-nav border-0 amountshow">
                                            <h5>Total Amount: <span id="amount">{{ showAmount(0) }}</span></h5>
                                        </div>
                                        <div class="az-dashboard-nav border-0">
                                            <button type="submit" class="btn btn-dark rounded-10 shadoww pull-right" id="submitBtn">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="if"></div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('#driver_id, #payment_type').select2({
            theme: "bootstrap-5",
        });
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    document.getElementById('checkAll').addEventListener('change', function() {
        var total = 0;
        var saleCheckboxes = document.querySelectorAll('.saleCheckbox');

        saleCheckboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('checkAll').checked;
        });

        if (this.checked) {
            saleCheckboxes.forEach(function(checkbox) {
                total += parseFloat(checkbox.value);
            });
        }

        document.getElementById('amount').textContent = showAmt(total);
    });

    document.querySelectorAll('.saleCheckbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var total = 0;

            document.querySelectorAll('.saleCheckbox:checked').forEach(function(checkedBox) {
                total += parseFloat(checkedBox.value);
            });

            document.getElementById('amount').textContent = showAmt(total);
        });
    });

    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        var checkboxes = document.querySelectorAll('.saleCheckbox');
        var isChecked = false;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            notifyme2('Please check at least one sale to close.');
            return false;
        }


        var payment_type = document.getElementById('payment_type').value;
        if (payment_type === '') {
            notifyme2('Please Select Payment');
            return false;
        }
        $(".payment_type").val($("#payment_type").val());
        if (confirm("Are you sure, You want to close sale?")) {
            document.getElementById('driver-form').submit();
        }
        return false;
    });
</script>

@endsection
