@extends('Counter.Layout.theme')

@section('title', 'RECENT SALES')

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

    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Recent Sales</h2>
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
                                    <div class="w-auto ml-3">
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
                                    </div>
                                  <div class="w-auto ml-3">
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
                                    </div>
                                    <div class="w-auto ml-3">
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
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Receipt No.</label>
                                        <input type="text" value="{{ $receipt_id }}" name="receipt_id"
                                            class="form-control rounded-10" onchange="this.form.submit()">
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
                                                <th>Payment Type</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <?php $total_credit = $total_debit = $total_balance = 0; ?>
                                        <tbody>
                                            @if (count($sale_orders) > 0)
                                                @foreach ($sale_orders as $key => $value)
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

                                                        @if (checkUserPermission('sale_payment_change') && $settle && getbranchid())
                                                            <td>
                                                                <select name="payment_change"
                                                                    class="form-control w-auto rounded-10 payment_change"
                                                                    data-sale_id="{{ $value->id }}"
                                                                    data-receipt_id="{{ $value->receipt_id }}">
                                                                    <option value="">Change Payment</option>
                                                                    @foreach ($PaymentLists as $PaymentList)
                                                                        @if ($PaymentList->payment_method_slug != 'credit')
                                                                            <option
                                                                                value="{{ $PaymentList->payment_method_slug }}"
                                                                                @if ($value->payment_type == $PaymentList->payment_method_slug) selected @endif>
                                                                                {{ $PaymentList->payment_method_name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        @else
                                                            <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Payment Type">{{ $value->payment_type }}</td>
                                                        @endif


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
                                                                    data-pop="lg"
                                                                    data-url="{{ url('recent-sale/create') }}?id={{ $value->id }}"
                                                                    data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                    <i class="fa fa-list"></i>
                                                                </a>
                                                            </div>
                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Print">
                                                                <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                    href="javascript:void(0)"
                                                                    onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                        class="fa fa-print"></i>
                                                                </a>
                                                            </div>
                                                            @if (checkUserPermission('sale_delete') && $settle)
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Delete">
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                        href="javascript:void(0)"
                                                                        onclick="showActionModal('delete', '{{ $value->uuid }}')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            @endif


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
    <div id="actionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 id="actionModalTitle" class="modal-title text-uppercase text-center w-100"></h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="max-height: 70vh !important; overflow-y: auto">
                    <form id="actionForm">
                        <input type="hidden" id="actionType"> <!-- Indicates 'delete' or 'payment_change' -->
                        <input type="hidden" id="recordId"> <!-- For UUID or Sale ID -->
                        <input type="hidden" id="receiptId"> <!-- Only for payment change -->

                        <!-- Reason Field -->
                        <div class="form-group">
                            <label for="reason" class="font-weight-bold">Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" required>
                        </div>

                        @if (app('appSettings')['staff_pin']->value == 'yes')
                            <div class="form-group" id="staffPinField" style="display: none;">
                                <label for="staff_pin" class="font-weight-bold">Staff PIN</label>
                                <input type="password" class="form-control" id="staff_pin" name="staff_pin">
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="actionButton"
                        class="btn btn-danger px-4 text-uppercase rounded-10"></button>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')


<script>
    function showActionModal(action, id, receiptId = null) {
        $('#actionType').val(action); // Set action type (delete or payment_change)
        $('#recordId').val(id); // Set record ID (UUID or Sale ID)
        $('#receiptId').val(receiptId); // Set receipt ID (for payment change only)

        if (action === 'delete') {
            $('#actionModalTitle').text('Confirm Deletion');
            $('#actionButton').text('Delete').removeClass('btn-primary').addClass('btn-danger');
            $('#staffPinField').show(); // Show staff PIN for delete if required
        } else if (action === 'payment_change') {
            $('#actionModalTitle').text('Confirm Payment Change');
            $('#actionButton').text('Change Payment').removeClass('btn-danger').addClass('btn-primary');
            $('#staffPinField').hide(); // Hide staff PIN for payment change
        }

        $('#actionModal').modal('show');
    }

    // Handle delete or payment change actions
    $('#actionButton').on('click', function() {
        const action = $('#actionType').val();
        const recordId = $('#recordId').val();
        const reason = $('#reason').val();
        const staffPin = $('#staff_pin').val();
        const receiptId = $('#receiptId').val();

        if (!reason) {
            alert("Please provide a reason.");
            return;
        }

        if (action === 'delete') {
            $.ajax({
                url: '/recent-sale/' + recordId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    reason: reason,
                    staff_pin: staffPin
                },
                success: function(response) {
                    if (response.status === 1) {
                        alert("Record deleted successfully.");
                        location.reload();
                    } else {
                        alert(response.message || "An error occurred while deleting the record.");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("An error occurred while deleting the record.");
                }
            });
        }
        else if (action === 'payment_change') {
    const selectedPaymentType = $('select[name="payment_change"]').val(); // Get the selected payment type

    $.ajax({
        url: "{{ route('changePaymentType') }}",
        type: "POST",
        data: {
            'id': recordId,
            'reason': reason,
            'payment_type': selectedPaymentType, // Include the selected payment type here
            '_token': "{{ csrf_token() }}",
        },
        dataType: "JSON",
        success: function(data) {
            if (data.status == 1) {
                alert(data.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                alert(data.message || 'Error updating payment type.');
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('An error occurred. Please try again.');
        }
    });
}


        $('#actionModal').modal('hide');
    });

    // Event listener for payment type change
    $(document).on('change', '.payment_change', function() {
        const selectedPaymentType = $(this).val();
        const saleId = $(this).data('sale_id');
        const receiptId = $(this).data('receipt_id');

        if (selectedPaymentType) {
            showActionModal('payment_change', saleId, receiptId);
        }
    });
</script>

@endsection
