@extends('Counter.Layout.theme')

@section('title', 'DELIVERY SALE LOG')

@section('style')

@endsection

@section('content')

<?php $PaymentLists = PaymentList(auth()->user()->branch_id); ?>

<div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
    <div class="container-fluid">
        <div class="az-content-body">
            <div class="col-12">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Delivery Sale Log</h2>
                        <p class="az-dashboard-text"></p>
                    </div>
                    <div class="az-content-header-right ">
                        <nav class="nav">
                            <a id="createbtn"
                                class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center"
                                href="{{ url('driver-log') }}"> Driver Log</a>
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
                                    <label class="mb-0 d-block small font-weight-bold">Customer</label>
                                    <select class="form-control rounded-10 select2" id="customer_id" name="customer"
                                        onchange="this.form.submit()">
                                        <option value="">Select Customer</option>
                                        <?php $customers = getCustomerall(auth()->user()->branch_id); ?>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" @if ($customer->id == $customer_id)
                                            selected="selected" @endif>
                                            {{ $customer->customer_number . ' - ' .
                                            Str::ucfirst($customer->customer_name) }}
                                        </option>
                                        @endforeach
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
                                            <th>S.No</th>
                                            <th>Receipt No.</th>
                                            <th>Customer</th>
                                            <th>Driver</th>
                                            <th>Discount</th>
                                            <th>Amount</th>
                                            <th>Ordered date</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($sale_orders) > 0)
                                        @foreach ($sale_orders as $key => $delivery)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt No.">
                                                {{ Str::ucfirst($delivery->receipt_id) }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Customer">
                                                {{ Str::ucfirst($delivery->customer_name) . ' (' .
                                                $delivery->customer_number . ')' }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Driver">
                                                {{ Str::ucfirst(getDriverByID($delivery->driver_id)->driver_name) }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Discount">
                                                {{ showAmount($delivery->discount) }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Amount">
                                                {{ showAmount($delivery->with_tax) }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Ordered date">
                                                {{ dateFormat($delivery->ordered_date, 1) }}
                                            </td>
                                            <td>
                                                <select name="delivery_sale" id=""
                                                    class="form-control rounded-10 changedeliverystatus"
                                                    data-sale_id="{{ $delivery->id }}" data-key="{{ $key }}"
                                                    data-total="{{ $delivery->with_tax }}">
                                                    {{-- onchange="changedeliverystatus('{{ $delivery->id }}',{{ $key
                                                    }})"> --}}
                                                    <option value="pending" @if ($delivery->status == 'pending')
                                                        selected @endif>
                                                        Pending</option>
                                                    <option value="out_for_delivery" @if ($delivery->status ==
                                                        'out_for_delivery') selected @endif>
                                                        Out for delivery</option>
                                                    <option value="delivered" @if ($delivery->status == 'delivered')
                                                        selected @endif>
                                                        Delivered</option>
                                                    <option value="reject" @if ($delivery->status == 'reject') selected
                                                        @endif>
                                                        Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="payment_type" id=""
                                                    class="form-control w-auto rounded-10 payment_type{{ $key }}">
                                                    {{-- <option value="">Select Payment Type</option> --}}
                                                    @foreach ($PaymentLists as $PaymentList)
                                                    @if ($PaymentList->payment_method_slug != 'credit')
                                                    <option value="{{ $PaymentList->payment_method_slug }}"
                                                        data-id="{{ $PaymentList->id }}">
                                                        {{ $PaymentList->payment_method_name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
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
                                                    </a>
                                                </div>
                                                <?php $url = url('print') . '?id=' . $delivery->id . '&re=dashboard'; ?>

                                                <button type="button" title="Print"
                                                    onclick="printrec('t37556b55-13e1-4b12-90b7-e96c892e4b2d', 'banks');"
                                                    class="btn btn-dark pt-2 pb-1 px-3 border-left rounded-10-2">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                                @if ($delivery->status == 'pending')
                                                <button type="button"
                                                    class="btn btn-dark dropdown-toggle border-left rounded-10-2 dropdown-toggle-split pt-2 pb-1 px-3"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu rounded-10-2">
                                                    <a class="dropdown-item"
                                                        href="{{ url('home') . '/' . $delivery->uuid . '/edit' }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger deleteSale"
                                                        href="javascript:void(0)" data-sale_id="{{ $delivery->id }}">
                                                        Delete
                                                    </a>
                                                </div>
                                                @endif
                                            </td>

                                            <!-- Modal HTML Structure -->
                                            <div class="modal fade" id="dynamicPopup-lg" tabindex="-1"
                                                aria-labelledby="dynamicPopupLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="dynamicPopupLabel">
                                                                Items</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Modal content will be loaded dynamically from data-url -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <div id="if"></div>


    @endsection

    @section('script')

    <script>
        $(document).ready(function () {
            $('#customer_id').select2({
                theme: "bootstrap-5",
            });
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // function changedeliverystatus(sale_id,key)
        // {
        $(document).on("change", ".changedeliverystatus", function (e) {
            var sale_id = $(this).data("sale_id");
            var key = $(this).data("key");
            var status = $(this).val();
            var total = $(this).data("total");
            var payment_type = $(".payment_type" + key).val();
            if (sale_id && confirm("Are you sure, You want to change status?")) {
                $.ajax({
                    url: "{{ url('change-delivery-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sale_id: sale_id,
                        status: status,
                        type: 'status',
                        total: total,
                        payment_type: payment_type,
                    },
                    type: "post",
                    success: function (response) {
                        if (response == "success") {
                            notifyme2("Status Changed succesfully");
                            location.reload();
                        } else {
                            notifyme2("Something Went Wrong! please try again.");
                        }
                    },
                });
            } else {
                return false;
            }
            // }
        });

        $(document).on("click", ".deleteSale", function (e) {
            var sale_id = $(this).data("sale_id");
            var returnaction = 'reload';
            if (sale_id && confirm("Are you sure, You want to delete?")) {
                $.ajax({
                    url: "{{ url('change-delivery-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sale_id: sale_id,
                        type: 'delete',
                    },
                    type: "post",
                    success: function (response) {
                        if (response == "success") {
                            notifyme2("Deleted succesfully");
                            if (returnaction == "reload") {
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                        } else {
                            notifyme2("Something Went Wrong! please try again.");
                        }
                    },
                });
            } else {
                return false;
            }
            // }
        });
    </script>

    @endsection
