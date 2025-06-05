@extends('Counter.Layout.theme')

@section('title', 'QUOTATION')

@section('style')

@endsection

@section('content')


    <?php

    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
    $supplier = isset($_GET['supplier']) && $_GET['supplier'] != '' ? $_GET['supplier'] : '';
    $shop_id = isset($_GET['shop']) && $_GET['shop'] != '' ? $_GET['shop'] : auth()->user()->branch_id;
    ?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Quotation</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            {{-- @if (checkUserPermission('quotation_create')) --}}
                            <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="xl" data-url="{{ url('quotation/create') }}?shop={{ $shop_id }}"
                                data-toggle="modal" data-target="#dynamicPopup-xl"
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                    class="fa fa-plus-circle mr-1"></i> Create</button>
                            {{-- @endif --}}



                        </nav>
                    </div>
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                        <input type="date"
                                            name="from_date"
                                            class="form-control rounded-10"
                                            value="{{ request('from_date', date('Y-m-d')) }}"
                                            onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date"
                                            name="to_date"
                                            class="form-control rounded-10"
                                            value="{{ request('to_date', date('Y-m-d')) }}"
                                            onchange="this.form.submit()">
                                    </div>
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Supplier</label>
                                        <select class="form-control rounded-10 select2" id="supplier" name="supplier"
                                            onchange="this.form.submit()">
                                            <option quotation="">Select Supplier</option>
                                            @foreach ($suppliers as $suplier)
                                                <option quotation="{{ $suplier->id }}"
                                                    @if ($suplier->id == $supplier) selected="selected" @endif>
                                                    {{ $suplier->supplier_name . ' - ' . Str::ucfirst($suplier->supplier_company_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Quotation Number</label>
                                        <input type="text" name="quot_id" quotation="{{ request('quot_id') }}"
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
                                {{-- @if ($quotations->isNotEmpty())
                                    <div class="float-right">
                                        <h5 class="font-weight-bold">Total Outstanding Amount: {{ $totalOutstanding }}
                                        </h5>
                                    </div>
                                @endif --}}
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
                                            <th>Customer</th>
                                            <th>Quotation Number</th>
                                            <th>Date</th>
                                            <th>VAT Amount</th>
                                            <th>Final Amount</th>
                                            <th>Discount Amount</th>
                                            {{-- <th>Payment Status</th> --}}
                                            {{-- @if (checkUserPermission('quotation_edit') || checkUserPermission('quotation_delete')) --}}
                                            {{-- <th>Action</th> --}}
                                            {{-- @endif --}}
                                            {{-- @if ((checkUserPermission('quotation_edit') || checkUserPermission('quotation_delete')) && getbranchid()) --}}
                                            <th>Action</th>
                                            {{-- @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($quotations) > 0)
                                            @foreach ($quotations as $key => $quotation)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    @if (!auth()->user()->branch_id)
                                                        <td>{{ isset($quotation->branch_name) ? Str::ucfirst($quotation->branch_name) : '' }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $quotation->customer_id ? getCustomerDetById($quotation->customer_id) : '' }}
                                                    </td>
                                                    <td>{{ $quotation->quotation_no }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('Y-m-d') }}
                                                    </td>
                                                    <td>{{ showAmount($quotation->total_vat) }}</td>
                                                    <td>{{ showAmount($quotation->total_price) }}</td>
                                                    <td>{{ showAmount($quotation->total_discount) }}</td>
                                                    <?php $url = url('print-quote') . '?id=' . $quotation->id; ?>
                                                    <td class="text-center">
                                                      <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Items">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                title="Item List" data-pop="lg"
                                                                data-url="{{ url('quotation/' . $quotation->id) }}"
                                                                data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                <i class="fa fa-list"></i>
                                                            </a>
                                                        </div>
                                                        <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Add to Cart">
                                                            <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                href="javascript:void(0)"
                                                                onclick="addToCartByQuotation('{{ $quotation->id }}', '{{ $quotation->quotation_no }}');">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </a>
                                                        </div>
                                                        <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Print">
                                                            <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                href="javascript:void(0)"
                                                                onclick="openPrintPreview('{{ $url }}');">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                        </div>
                                                        <div class="btn-group rounded-10" role="group"
                                                            aria-label="Basic example" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete">
                                                            <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                href="javascript:void(0)"
                                                                onclick="showDeleteModal('{{ $quotation->id }}','{{ $quotation->quotation_no }}');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                {{-- <form id="updatePaymentStatusForm">
                                    @foreach ($quotations as $quotation)
                                        <div style="display: none">
                                            <input type="checkbox" name="quotation_ids[]" quotation="{{ $quotation->id }}"
                                                class="form-check-input selectquotation"
                                                data-invoice="{{ $quotation->invoice_no }}"
                                                onclick="selectCheckboxesByInvoice(this)">
                                            <!-- Click event calls function -->
                                            <label>{{ $quotation->invoice_no }}</label><br>
                                        </div>
                                    @endforeach --}}

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

    <script>
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
    </div>

@endsection

@section('script')
<script>
function openPrintPreview(url) {
    // Create a hidden iframe for print preview
    let iframeId = "printPreviewFrame";
    // Remove any previous iframe
    let existing = document.getElementById(iframeId);
    if (existing) existing.remove();

    let iframe = document.createElement('iframe');
    iframe.id = iframeId;
    iframe.style.position = "fixed";
    iframe.style.right = "0";
    iframe.style.bottom = "0";
    iframe.style.width = "0";
    iframe.style.height = "0";
    iframe.style.border = "0";
    iframe.src = url;
    document.body.appendChild(iframe);

    iframe.onload = function() {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    };
}

function showDeleteModal(id, quotation_no) {
    if (confirm('Are you sure you want to delete quotation #' + quotation_no + '?')) {
        $.ajax({
            url: "{{ url('quotation') }}/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 1) {
                    alert('Quotation deleted successfully.');
                    location.reload();
                } else {
                    alert(response.message || 'Failed to delete quotation.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while deleting the quotation.');
            }
        });
    }
}

// Add all items to cart and redirect to home page
function addToCartByQuotation(quotationId, quotationNo) {
    $.ajax({
        url: "{{ url('quotation/add-to-cart') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            quotation_id: quotationId
        },
        success: function(cartResp) {
            if (cartResp.status === 1 && cartResp.redirect_to) {
                window.location.href = cartResp.redirect_to;
            } else {
                alert('No items found for this quotation.');
            }
        },
        error: function(xhr) {
            alert('Failed to add items to cart.');
        }
    });
}
</script>
@endsection
