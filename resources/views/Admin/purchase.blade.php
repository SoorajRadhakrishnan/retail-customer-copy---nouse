@extends('Admin.theme')

@section('title', 'PURCHASE')

@section('style')

@endsection

@section('content')

    <?php

    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
    $supplier = isset($_GET['supplier']) && $_GET['supplier'] != '' ? $_GET['supplier'] : '';

    ?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Purchase</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('purchase_create'))
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="xl"
                                    data-url="{{ url('admin/purchase/create') }}?shop={{ $shop_id }}"
                                    data-toggle="modal" data-target="#dynamicPopup-xl"
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif

                            <button id="loadDataBtn"
                                class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-toggle="modal"
                                data-target="#payModal">PAY</button>

                        </nav>
                    </div>
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                        <input type="date"
                                            value="{{ request()->input('from_date') ? date('Y-m-d', strtotime($from_date)) : '' }}"
                                            name="from_date" class="form-control rounded-10" onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date" value="{{ $to_date }}" name="to_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
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
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Payment Status</label>
                                        <select class="form-control rounded-10 select2" id="payment_status"
                                            name="payment_status" onchange="this.form.submit()">
                                            <option value="">Payment Status</option>
                                            <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid
                                            </option>
                                            <option value="un_paid" @if ($payment_status == 'un_paid') selected @endif>Unpaid
                                            </option>
                                            <option value="partial_paid" @if ($payment_status == 'partial_paid') selected @endif>
                                                Partial Paid</option>
                                            <option value="pending" @if ($payment_status == 'pending') selected @endif>
                                                Pending</option>
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Status</label>
                                        <select class="form-control rounded-10 select2" id="status" name="status"
                                            onchange="this.form.submit()">
                                            <option value="">Choose Statuses</option>
                                            <option value="ordered" @if (request()->input('status') == 'ordered') selected @endif>
                                                Ordered</option>
                                            <option value="pending" @if (request()->input('status') == 'pending') selected @endif>
                                                Pending</option>
                                            <option value="received" @if (request()->input('status') == 'received') selected @endif>
                                                Received</option>
                                            <!-- Add other statuses as needed -->
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Invoice Number</label>
                                        <input type="text" name="invoice_number" value="{{ request('invoice_number') }}"
                                            class="form-control rounded-10" placeholder="Search by Invoice Number">
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
                                @if ($purchases->isNotEmpty())
                                    <div class="float-right">
                                        <h5 class="font-weight-bold">Total Outstanding Amount: {{ $totalOutstanding }}
                                        </h5>
                                    </div>
                                @endif
                                <table id="example" class="table table-hover table-custom border-bottom-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            {{--  <th style="width: 5%">
                                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                                </th> --}}

                                            <th>S.No</th>
                                            @if (!auth()->user()->branch_id)
                                                <th>Branch</th>
                                            @endif
                                            <th>Supplier</th>
                                            <th>Invoice Number</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Payment Status</th>
                                            <th>VAT Amount</th>
                                            <th>Final Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Balance Amount</th>
                                            @if ((checkUserPermission('purchase_edit') || checkUserPermission('purchase_delete')) && getbranchid())
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($purchases) > 0)
                                            @foreach ($purchases as $key => $purchase)
                                            {{-- @dd($purchase) --}}
                                                <tr>
                                                    {{--   <td>
                                                            @if ($purchase->payment_status != 'paid')
                                                                <input type="checkbox" name="purchase_ids[]"
                                                                    value="{{ $purchase->id }}" class=" selectPurchase"
                                                                    data-invoice="{{ $purchase->invoice_no }}"
                                                                    onclick="selectCheckboxesByInvoice(this)">
                                                            @endif
                                                        </td> --}}
                                                    <td>{{ $key + 1 }}</td>
                                                    @if (!auth()->user()->branch_id)
                                                        <td>{{ Str::ucfirst($purchase->branch->branch_name) }}</td>
                                                    @endif
                                                    <td>{{ Str::ucfirst($purchase->supplier_name) }}</td>
                                                    <td>{{ Str::ucfirst($purchase->invoice_no) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($purchase->date_added)->format('Y-m-d') }}</td>
                                                    @if ($purchase->status != 'received')
                                                        <td>
                                                            <select class="form-control rounded-10 statusChange"
                                                                data-purchase="{{ $purchase->id }}"
                                                                data-shop="{{ $purchase->shop_id }}">
                                                                <option value="pending"
                                                                    @if ($purchase->payment_status == 'pending') selected @endif>
                                                                    Pending</option>
                                                                <option value="ordered"
                                                                    @if ($purchase->payment_status == 'ordered') selected @endif>
                                                                    Ordered</option>
                                                                <option value="received"
                                                                    @if ($purchase->payment_status == 'received') selected @endif>
                                                                    Received</option>
                                                            </select>
                                                        </td>
                                                    @else
                                                        <td>{{ Str::ucfirst($purchase->status) }}</td>
                                                    @endif
                                                    {{-- @if ($purchase->payment_status == 'un_paid')
                                                            <td>
                                                                <select name="delivery_sale"
                                                                    class="form-control w-auto rounded-10 paymentChange"
                                                                    data-purchase="{{ $purchase->id }}">
                                                                    <option value="un_paid"
                                                                        @if ($purchase->payment_status == 'un_paid') selected @endif>
                                                                        Un Paid</option>
                                                                    <option value="paid"
                                                                        @if ($purchase->payment_status == 'paid') selected @endif>
                                                                        Paid</option>
                                                                </select>
                                                            </td>
                                                        @else --}}
                                                    <td>{{ Str::ucfirst(str_replace('_', ' ', $purchase->payment_status)) }}
                                                    </td>
                                                    {{-- @endif --}}
                                                    <td>{{ showAmount($purchase->tax_amount) }}</td>
                                                    <td>{{ showAmount($purchase->total_amount) }}</td>
                                                    <td>{{ showAmount($purchase->paid_amount) }}</td>
                                                    <td>{{ showAmount($purchase->total_amount - $purchase->paid_amount) }}
                                                    </td>
                                                    {{-- <td>
                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Items">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                    title="Open Drawer" data-pop="lg"
                                                                    data-url="{{ url('admin/sale-order/create') }}?id={{ $purchase->id }}"
                                                                    data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                    <i class="fa fa-list"></i>
                                                                </a>
                                                            </div>
                                                        </td> --}}
                                                    <td>
                                                        <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Items">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                title="Item List" data-pop="lg"
                                                                data-url="{{ url('admin/purchase/' . $purchase->id) }}"
                                                                data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                <i class="fa fa-list"></i>
                                                            </a>

                                                            @if (
                                                                (checkUserPermission('category_edit') || checkUserPermission('category_delete')) &&
                                                                    getbranchid() &&
                                                                    $purchase->status != 'received')
                                                                @if (checkUserPermission('purchase_edit'))
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10 dynamicPopup"
                                                                        data-pop="xl"
                                                                        data-url="{{ url('admin/purchase/') . '/' . $purchase->id . '/edit' }}?shop={{ $purchase->shop_id }}"
                                                                        data-toggle="modal" data-target="#dynamicPopup-xl"
                                                                        data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endif

                                                                @if (checkUserPermission('purchase_delete'))
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                        href="javascript:void(0)"
                                                                        onclick="deletemodel('{{ $purchase->id }}','{{ $purchase->invoice_no }}','Delete Purchase','{{ url('admin/purchase') . '/' . $purchase->id }}')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            @if ($purchase->total_amount - $purchase->paid_amount)
                                                                <a class="btn btn-dark pt-2 px-3 rounded-10 PayModel"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Pay" id="PayModel"
                                                                    data-purchase_id="{{ $purchase->id }}"
                                                                    data-supplier_name="{{ $purchase->supplier_name }}"
                                                                    data-balance="{{ $purchase->total_amount - $purchase->paid_amount }}"
                                                                    data-total_amount="{{ $purchase->total_amount }}"><span>Pay</span>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                <form id="updatePaymentStatusForm">
                                    @foreach ($purchases as $purchase)
                                        <div style="display: none">
                                            <input type="checkbox" name="purchase_ids[]" value="{{ $purchase->id }}"
                                                class="form-check-input selectPurchase"
                                                data-invoice="{{ $purchase->invoice_no }}"
                                                onclick="selectCheckboxesByInvoice(this)">
                                            <!-- Click event calls function -->
                                            <label>{{ $purchase->invoice_no }}</label><br>
                                        </div>
                                    @endforeach

                                    {{--  <button
                                            class="btn btn-dark rounded-10 shadow mr-2 mb-2 d-flex justify-content-center align-items-center"
                                            type="button" onclick="updatePaymentStatus()">Mark as Paid</button> --}}
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="PayDetailsModel" tabindex="-1" role="dialog" aria-hidden="true">
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
                                data-target="{{ url('admin/purchase-pay-amount') }}" data-returnaction="reload"
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                data-processing="Please wait, saving...">Save</button>
                            {{-- <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 CreditPayBtn">Save</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Total Outstanding : {{ $totalOutstanding }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form id="paymentForm">
                    @csrf <!-- Include CSRF token for security -->
                    <div class="modal-body pb-0 pt-0" style="max-height: 70vh; overflow-x:auto">
                        <table class="table table-bordered" id="tableBal">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px;">
                                        <input type="checkbox" id="checkAllCheckbox" onclick="checkAllCheckboxes()">
                                    </th>
                                    <th>Supplier</th>
                                    <th>#</th>
                                    <th>Total</th>
                                    <th>Balance</th>
                                    <th>Paying</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    @if ($purchase->payment_status !== 'paid')
                                        <tr>
                                            <td class="text-center" style="width: 40px;">
                                                <input type="checkbox" class="checkMe" id="checkMe{{ $purchase->id }}"
                                                    name="checkMe[]" value="{{ $purchase->id }}"
                                                    onclick="togglePaymentFields({{ $purchase->id }})">
                                            </td>
                                            <td>{{ $purchase->supplier_name }}</td>
                                            <td>{{ $purchase->invoice_no }}</td>
                                            <td>{{ number_format($purchase->total_amount, 2) }}</td>
                                            <td>{{ number_format($purchase->total_amount - $purchase->paid_amount, 2) }}
                                            </td>
                                            <td class="p-1">
                                                <input class="form-control rounded-10" type="number" min="0"
                                                    max="{{ $purchase->total_amount - $purchase->paid_amount }}"
                                                    value="{{ $purchase->total_amount - $purchase->paid_amount }}"
                                                    id="payingNow{{ $purchase->id }}" name="amount[{{ $purchase->id }}]"
                                                    readonly>

                                                <!-- Hidden fields for required data -->
                                                <input type="hidden" name="purchase_id[]" value="{{ $purchase->id }}"
                                                    class="purchase-id-field">
                                                <input type="hidden" name="total_amount[{{ $purchase->id }}]"
                                                    value="{{ $purchase->total_amount }}" class="total-amount-field">
                                                <input type="hidden" name="balance[{{ $purchase->id }}]"
                                                    value="{{ $purchase->total_amount - $purchase->paid_amount }}"
                                                    class="balance-field">
                                                <input type="hidden" name="payment_type[{{ $purchase->id }}]"
                                                    value="cash" class="payment-type-field">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark pt-2 px-3 rounded-10"
                            id="submitPaymentButton"><span>Pay</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitPaymentButton').addEventListener('click', function() {
            // Enable only selected fields before form submission
            document.querySelectorAll('.checkMe').forEach((checkbox) => {
                const purchaseId = checkbox.value;
                const isChecked = checkbox.checked;
                toggleFieldStatus(purchaseId, isChecked);
            });

            const formData = new FormData(document.getElementById('paymentForm'));

            fetch('{{ route('admin.purchases.purchasePayMultiple') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    sessionStorage.setItem('successMessage', data.message);
                    window.location.reload();
                    $('#payModal').modal('hide');
                } else {
                    notifyme2('Error: ' + JSON.stringify(data.response));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                notifyme2('There was an error processing your request.');
            });
        });

        function togglePaymentFields(purchaseId) {
            const isChecked = document.getElementById(`checkMe${purchaseId}`).checked;
            toggleFieldStatus(purchaseId, isChecked);
        }

        function toggleFieldStatus(purchaseId, isChecked) {
            document.getElementById(`payingNow${purchaseId}`).readOnly = !isChecked;

            // Enable or disable hidden fields based on checkbox status
            document.querySelector(`input[name="purchase_id[]"][value="${purchaseId}"]`).disabled = !isChecked;
            document.querySelector(`input[name="total_amount[${purchaseId}]"]`).disabled = !isChecked;
            document.querySelector(`input[name="balance[${purchaseId}]"]`).disabled = !isChecked;
            document.querySelector(`input[name="payment_type[${purchaseId}]"]`).disabled = !isChecked;
        }

        function displayMessage() {
            const successMessage = sessionStorage.getItem('successMessage');
            if (successMessage) {
                notifyme2(successMessage);
                sessionStorage.removeItem('successMessage');
            }
        }

        window.onload = displayMessage;
    </script>
        </div>
    </div>
    </div>
    <script>
        function formatValue(value) {
            var formattedValue = parseFloat(value).toFixed(2);
            return formattedValue.slice(-3) === '.00' ? parseFloat(value).toFixed(0) : formattedValue;
        }

        function checkAllCheckboxes() {
            var checkAll = document.getElementById('checkAllCheckbox');
            var checkboxes = document.querySelectorAll('.checkMe');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
                var payingNowId = checkbox.id.replace('checkMe', 'payingNow');
                var payingNowInput = document.getElementById(payingNowId);
                payingNowInput.readOnly = !checkAll.checked;
                var minValue = parseFloat(payingNowInput.getAttribute('min'));
                var maxValue = parseFloat(payingNowInput.getAttribute('max'));
                var currentValue = parseFloat(payingNowInput.value);
                payingNowInput.value = formatValue(Math.max(minValue, Math.min(currentValue, maxValue)));
            });
            calculateSum();
        }

        function checkMe() {
            var checkAll = document.getElementById('checkAllCheckbox');
            var checkboxes = document.querySelectorAll('.checkMe');
            checkAll.checked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            calculateSum();
            checkboxes.forEach(function(checkbox) {
                var payingNowId = checkbox.id.replace('checkMe', 'payingNow');
                var payingNowInput = document.getElementById(payingNowId);
                payingNowInput.readOnly = !checkbox.checked;
                var minValue = parseFloat(payingNowInput.getAttribute('min'));
                var maxValue = parseFloat(payingNowInput.getAttribute('max'));
                var currentValue = parseFloat(payingNowInput.value);
                payingNowInput.value = formatValue(Math.max(minValue, Math.min(currentValue, maxValue)));
            });
        }

        function calculateSum() {
            var checkboxes = document.querySelectorAll('.checkMe:checked');
            var total = 0;
            var count = checkboxes.length;
            checkboxes.forEach(function(checkbox) {
                var payingNowId = checkbox.id.replace('checkMe', 'payingNow');
                var payingNowInput = document.getElementById(payingNowId);
                total += parseFloat(payingNowInput.value) || 0;
            });
            document.getElementById('amount_r').value = formatValue(total);
            document.getElementById('totalChecked').value = count;
        }
    </script>
    </div>

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
