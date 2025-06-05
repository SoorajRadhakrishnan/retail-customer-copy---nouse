@extends('Admin.theme')

@section('title', 'INVENTORY MANAGEMENT')

@section('style')
<!-- Add any additional styles here -->
@endsection

@section('content')
<div class="az-content az-content-dashboard animate__animated animate__fadeIn">
    <div class="container-fluid">
        <div class="az-content-body">
            <div class="col-12">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Stock Adjustment</h2>
                        <p class="az-dashboard-text"></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form id="filter-form">
                                <div class="row">
                                    <div class="col-md-3 w-auto">
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2 addItem" id="price_id" name="price_id">
                                            <option value="">Select Item</option>
                                            @foreach ($itemList as $item_id)
                                            <?php
                                            if ($item_id->size_name === 'Unit price') {
                                                $item_id->size_name = '';
                                            }
                                            ?>
                                            <option value="{{ $item_id->price_id }}" data-name="{{ Str::ucfirst($item_id->item_name) }}" data-item_id="{{ $item_id->item_id }}" data-price_id="{{ $item_id->price_id }}" data-item_size="{{ $item_id->size_name }}" data-unit="{{ $item_id->unit_name }}" data-stock="{{ $item_id->stock }}" data-cost_price="{{ $item_id->cost_price }}">
                                                {{ Str::ucfirst($item_id->item_name) }}{{ $item_id->size_name ? ' - ' . $item_id->size_name : '' }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Barcode No.</label>
                                        <input type="text" value="{{ $barcode }}" name="barcode" id="barcodeSearch" class="form-control rounded-10">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="button" class="btn btn-dark rounded-10 px-3" id="filter-submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form id="inventory-form" action="{{ url('admin/inventory') }}" method="POST">
                @csrf
                <input type="hidden" name="branch_id" value="{{ getbranchid() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="customer" id="customer-name">
                <div class="col-12 mt-4" id="items-table-container" style="display: none;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <table id="example23" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Name</th>
                                                <th>Unit</th>
                                                <th>Stock</th>
                                                <th style="width: 20%">Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="item_body">
                                            <!-- Dynamic rows will be appended here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="az-dashboard-nav border-0">
                        {{-- @if (checkUserPermission('stock_update') && getbranchid()) --}}
                        <button type="button" class="btn btn-dark rounded-10 shadoww pull-right" id="confirmUpdate">
                            <i class="fa fa-plus-circle mr-1"></i> Update
                        </button>
                        {{-- @endif --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase text-center w-100" id="updateModalLabel">Confirm Update</h5>
            </div>
            <div class="modal-body">
                <form id='updatemodal123'>
                <label for="customer">Customer</label>
                <select name="customer" id="modal-customer-name" class="form-control rounded-10 select2">
                    <option value="0">Select Customer</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                    @endforeach
                </select></form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-dark px-4 text-uppercase rounded-10" id="confirmUpdate">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "bootstrap-5",
            dropdownParent: $("#updateModal")
        });

        $('#price_id, #category_id,.select2').select2({
            theme: "bootstrap-5",
        });

        // Handle item selection
        $(".addItem").on("change", function() {
            var rand = Math.floor(Math.random() * 100000);
            var item = $(this).find('option:selected');
            var found = true;
            $('#item_body .combo_ing_price_id').each(function() {
                if ($(this).val() == item.data('price_id')) {
                    found = false;
                }
            });
            if (item.val() != '' && found) {
                var item_name = item.data('name');
                var item_id = item.data('item_id');
                var price_id = item.data('price_id');
                var unit = item.data('unit');
                var stock = item.data('stock');
                let dynamicRowHTML = `
                    <tr class="tr` + rand + `">
                        <input type="hidden" class="combo_ing_price_id" value="` + price_id + `">
                        <input type="hidden" name="stock[` + item_id + `]" value="` + stock + `">
                        <td>` + ($('#item_body tr').length + 1) + `</td>
                        <td>` + item_name + `</td>
                        <td>` + unit + `</td>
                        <td>` + stock + `</td>
                        <td>
                            <input type="number" name="qty[` + item_id + `]" class="form-control rounded-10 qty-input col-md-6" placeholder="Enter Quantity" required>
                        </td>
                        <td>
                            <a class="btn btn-dark rounded-10" onclick="removeRow('` + rand + `')"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>`;
                $('#item_body').append(dynamicRowHTML);
                $('#items-table-container').show();
                $('.addItem').val('');
            }
        });

        // Handle barcode input
        $('#barcodeSearch').on('change', function(e) {
            if ($("#barcodeSearch").val().length > 0) {
                var barcode_id = $("#barcodeSearch").val();
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/barcode-search') }}",
                    data: { barcode: barcode_id },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.data.length > 0) {
                            data.data.forEach(function(item, index) {
                                var found = true;
                                $('#item_body .combo_ing_price_id').each(function() {
                                    if ($(this).val() == item.price_id) {
                                        found = false;
                                    }
                                });
                                if (found) {
                                    let dynamicRowHTML = `
                                        <tr class="tr` + index + `">
                                            <input type="hidden" class="combo_ing_price_id" value="` + item.price_id + `">
                                            <input type="hidden" name="stock[` + item.item_id + `]" value="` + item.item_stock + `">
                                            <td>` + ($('#item_body tr').length + 1) + `</td>
                                            <td>` + item.item_name + `</td>
                                            <td>` + item.unit_name + `</td>
                                            <td>` + item.item_stock + `</td>
                                            <td>
                                                <input type="number" name="qty[` + item.item_id + `]" class="form-control rounded-10 qty-input" placeholder="Enter Quantity">
                                            </td>
                                            <td>
                                                <a class="btn btn-dark rounded-10" onclick="removeRow('` + index + `')"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>`;
                                    $('#item_body').append(dynamicRowHTML);
                                    $('#items-table-container').show();
                                }
                            });
                            $('#barcodeSearch').val('');
                        } else {
                            alert("Please Enter Correct Barcode");
                            $('#barcodeSearch').val('');
                        }
                    }
                });
            }
        });

        // Function to remove a row
        window.removeRow = function(rand) {
            $(".tr" + rand).remove();
            if ($('#item_body tr').length == 0) {
                $('#items-table-container').hide();
            } else {
                // Update S.No for remaining rows
                $('#item_body tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
        }

        // Open modal on Enter key press
        $(document).on('keypress', function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#confirmUpdate').trigger('click'); // Trigger the confirm update button click
            }
        });

        // Handle the confirm update button click
        $('#confirmUpdate').click(function() {
            // Copy the modal input value to the hidden input in the form
            $('#customer-name').val($('#modal-customer-name').val());
            $('#inventory-form').submit();
        });    });
</script>
@endsection
