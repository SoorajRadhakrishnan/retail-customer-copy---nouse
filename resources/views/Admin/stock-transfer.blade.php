@extends('Admin.theme')

@section('title', 'STOCK TRANSFER')

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
                            <h2 class="az-dashboard-title">Stock Transfer</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('stock_transfer_create') && getbranchid())
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="xl"
                                    data-url="{{ url('admin/stock-transfer/create') }}?shop={{ $branch_id }}"
                                    data-toggle="modal" data-target="#dynamicPopup-xl"
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
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Supplier</label>
                                        <select class="form-control rounded-10 select2" id="supplier" name="supplier"
                                            onchange="this.form.submit()">
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $suplier)
                                                <option value="{{ $suplier->id }}"
                                                    @if ($suplier->id == $supplier) selected="selected" @endif>
                                                    {{ $suplier->supplier_name . ' - ' . Str::ucfirst($suplier->supplier_company_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Payment Status</label>
                                        <select class="form-control rounded-10 select2" id="payment_status"
                                            name="payment_status" onchange="this.form.submit()">
                                            <option value="">Payment Status</option>
                                            <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid
                                            </option>
                                            <option value="pending" @if ($payment_status == 'pending') selected @endif>
                                                pending</option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Invoice Number</label>
                                        <input type="text" name="invoice_number" value="{{ request('invoice_number') }}"
                                            class="form-control rounded-10" placeholder="Search by Invoice Number">
                                    </div> --}}
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
                                            <th>Transaction Date</th>
                                            <th>Source Branch</th>
                                            <th>Destination Branch</th>
                                            <th>notes</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($stock_transfers) > 0)
                                            @foreach ($stock_transfers as $key => $stock_transfer)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ dateFormat($stock_transfer->transaction_date) }}</td>
                                                    <td>{{ Str::ucfirst($stock_transfer->getSourcebranch->branch_name) }}</td>
                                                    <td>{{ Str::ucfirst($stock_transfer->getDestinationbranch->branch_name) }}</td>
                                                    <td>{{ Str::ucfirst($stock_transfer->notes) }}</td>
                                                    <td>{{ Str::ucfirst($stock_transfer->status) }}</td>
                                                    <?php $show = 0; ?>
                                                    @if ($stock_transfer->source_branch_id == getbranchid() && $stock_transfer->status != 'received')
                                                        <?php $show = 1; ?>
                                                    @endif

                                                    @if ($stock_transfer->status == 'received')
                                                        <?php $show = 2; ?>
                                                    @endif
                                                    <td>
                                                        <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                title="Item List" data-pop="lg"
                                                                data-url="{{ url('admin/stock-transfer/' . $stock_transfer->id) }}?show={{ $show }}"
                                                                data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                <i class="fa fa-list"></i>
                                                            </a>

                                                            @if (
                                                                (checkUserPermission('stock_transfer_edit') || checkUserPermission('stock_transfer_delete')) &&
                                                                    getbranchid() &&
                                                                    $stock_transfer->status != 'received')
                                                                    @if ($show == '1')

                                                                        @if (checkUserPermission('stock_transfer_edit'))
                                                                            <a class="btn btn-dark pt-2 px-3 rounded-10 dynamicPopup"
                                                                                title="Edit" data-pop="xl"
                                                                                data-url="{{ url('admin/stock-transfer/') . '/' . $stock_transfer->id . '/edit' }}?shop={{ $stock_transfer->source_branch_id }}"
                                                                                data-toggle="modal" data-target="#dynamicPopup-xl"
                                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                        @endif

                                                                        @if (checkUserPermission('stock_transfer_delete'))
                                                                            <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                                title="Delete" href="javascript:void(0)"
                                                                                onclick="deletemodel('{{ $stock_transfer->id }}','{{ $stock_transfer->notes }}','Delete Transfer','{{ url('admin/stock-transfer') . '/' . $stock_transfer->id }}')">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        @endif

                                                                    @endif

                                                            @endif
                                                        </div>
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

    {{-- <div class="modal fade" id="PayDetailsModel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Enter Discount</h5>
                </div>
                <form id="CreditForm" class="was-validated" autocomplete="off">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <input type="hidden" name="purchase_id" id="purchase_id" value="">
                            <input type="hidden" name="total_amount" id="total_amount" value="">
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Supplier</label>
                                        <input type="text" class="form-control rounded-10" id="supplier_name"
                                            placeholder="" name="supplier_name" required="" autofocus=""
                                            value="" readonly>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Balance</label>
                                        <input type="text" class="form-control rounded-10" id="balance"
                                            placeholder="" name="balance" required="" autofocus="" value=""
                                            readonly>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Payment Type</label>
                                        <select class="form-control rounded-10 onChange" id="payment_type"
                                            name="payment_type" required="">
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
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Amount</label>
                                        <input type="text" class="form-control rounded-10" id="amount"
                                            placeholder="Enter Amount" name="amount" required="" autofocus=""
                                            value="">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="adminedit" data-form="CreditForm"
                                data-target="{{ url('admin/stock-transfer-pay-amount') }}" data-returnaction="reload"
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                data-processing="Please wait, saving...">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

@endsection

@section('script')

    <script>
        $(".PayModel").on('click', function() {
            $("#purchase_id").val($(this).data('purchase_id'));
            $("#supplier_name").val($(this).data('supplier_name'));
            $("#balance").val($(this).data('balance'));
            $("#total_amount").val($(this).data('total_amount'));
            $("#PayDetailsModel").modal('show');
        });

        $("#amount").on("keyup", function() {
            var amount = $(this).val();
            var balance = $("#balance").val();
            if (parseFloat(amount) > parseFloat(balance)) {
                $(this).val(balance);
            }
        });

        $(document).on("change", ".paymentChange", function(e) {
            var purchase = $(this).data("purchase");
            var status = $(this).val();

            if (purchase && confirm("Are you sure you want to change the Payment status?")) {
                $.ajax({
                    url: "{{ url('admin/change-payment-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        purchase_id: purchase,
                        status: status,
                    },
                    type: "POST", // Change this to POST for better security
                    success: function(response) {
                        if (response === "success") {
                            notifyme2("Payment Status Changed successfully");
                            location.reload();
                        } else {
                            console.error("Error Response:",
                                response); // Log the response for debugging
                            notifyme2("Something Went Wrong! please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error); // Log the error for debugging
                        notifyme2("An error occurred while updating the payment status.");
                    }
                });
            } else {
                return false;
            }
        });

        $(document).on("change", ".statusChange", function(e) {
            var purchase = $(this).data("purchase");
            var shop_id = $(this).data("shop");
            var status = $(this).val();
            if (purchase && confirm("Are you sure, You want to change Purchase status?")) {
                $.ajax({
                    url: "{{ url('admin/change-purchase-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        purchase_id: purchase,
                        shop_id: shop_id,
                        status: status,
                    },
                    type: "POST", // Change GET to POST
                    success: function(response) {
                        if (response == "success") {
                            notifyme2("Status Changed successfully");
                            location.reload();
                        } else {
                            notifyme2("Something Went Wrong! please try again.");
                        }
                    },
                    error: function(xhr) {
                        notifyme2("An error occurred: " + xhr.responseText); // Handle error response
                    }
                });
            } else {
                return false;
            }
        });

        $(document).ready(function() {
            $('#supplier, #payment_status').select2({
                theme: "bootstrap-5",
            });
        });
    </script>
    <script>
        function toggleSelectAll(selectAllCheckbox) {
            const checkboxes = document.querySelectorAll('input[name="purchase_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked; // Match state of the Select All checkbox
            });
        }

        function selectCheckboxesByInvoice(checkbox) {
            const invoiceNumber = checkbox.dataset.invoice; // Get the invoice number from the clicked checkbox
            const checkboxes = document.querySelectorAll('input[name="purchase_ids[]"]'); // Select all checkboxes

            checkboxes.forEach(currentCheckbox => {
                // Check if the current checkbox's associated invoice number matches
                if (currentCheckbox.dataset.invoice === invoiceNumber) {
                    currentCheckbox.checked = checkbox.checked; // Toggle the state of matching checkboxes
                }
            });
        }

        function updatePaymentStatus() {
            let formData = $('#updatePaymentStatusForm').serialize(); // Collect selected purchase IDs

            // Check if at least one checkbox is checked
            if (!$('input[name="purchase_ids[]"]:checked').length) {
                alert('Please select at least one purchase to mark as paid.');
                return;
            }

            if (confirm("Are you sure you want to mark the selected purchases as paid?")) {
                $.ajax({
                    url: '{{ route('admin.purchases.updatePaymentStatus') }}', // Define your route here
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Payment status updated successfully!');
                        location.reload(); // Reload the page after success
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the payment status. Please try again.');
                    }
                });
            }
        }
    </script>
@endsection
