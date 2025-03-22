{{-- <style>
    .cost-price-blurred {
        filter: blur(1px); /* Apply blur effect */
        pointer-events: none; /* Prevent interactions until focused */
    }
</style> --}}



<?php $branch_id = auth()->user()->branch ? auth()->user()->branch->id : getbranchid(); ?>
<div class="modal-header">
    @if (optional($purchase)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Purchase</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Purchase</h5>
    @endif
</div>
<form id="PurchaseForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="id" value="{{ optional($purchase)->id }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-3 pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Supplier</label>
                        <div class="input-group">
                            <select class="form-control rounded-10 onChange" id="supplier_id" name="supplier_id"
                                required="">
                                <option value="">Select Supplier</option>
                                <?php $getSupplier = getSupplier($branch_id); ?>
                                @foreach ($getSupplier as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        @if ($supplier->id == optional($purchase)->supplier_id) selected="selected" @endif>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-append">
                                    <button class="btn btn-dark rounded-left rounded-10" type="button"
                                        data-toggle="modal" data-target="#createSupplierModal">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-3 pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Invoice Number</label>
                        <input type="text" class="form-control rounded-10" id="invoice_no" placeholder=""
                            name="invoice_no" required="" autofocus=""
                            value="{{ optional($purchase)->invoice_no }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                {{-- <div class="col-3 pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Payment Status</label>
                        <select class="form-control rounded-10 onChange" id="payment_status" name="payment_status"
                            required="">
                            <option value="">Select Payment Status</option>
                            <option value="paid" @if (optional($purchase)->payment_status == 'paid') selected @endif>Paid</option>
                            <option value="un_paid" @if (optional($purchase)->payment_status == 'un_paid') selected @endif>Un Paid</option>
                        </select>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div> --}}
                <div class="col-3">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Status</label>
                        <select class="form-control rounded-10 onChange" id="status" name="status" required="">
                            <option value="">Select Status</option>
                            <option value="pending" @if (optional($purchase)->status == 'pending') selected @endif>Pending</option>
                            <option value="ordered" @if (optional($purchase)->status == 'ordered') selected @endif>Ordered</option>
                            <option value="received" @if (optional($purchase)->status == 'received') selected @endif>Received</option>
                        </select>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-3 pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Purchase Date</label>
                        <input type="date" class="form-control rounded-10" id="purchase_date" name="purchase_date"
                            required value="{{ old('purchase_date', optional($purchase)->date_added) }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Select Item</label>
                        <div class="input-group">
                            <select class="form-control w-auto rounded-10 select2 addITem" id="items" name="items"
                                required="">
                                <option value="">Select Item</option>

                                @foreach ($items as $item)
                                    <option value="{{ $item->price_id }}" data-price_id="{{ $item->price_id }}"
                                        data-item_id="{{ $item->item_id }}" data-name="{{ $item->item_name }}"
                                        data-item_size="{{ $item->size_name }}"
                                        data-cost_price="{{ $item->item_price_cost_price }}">{{ $item->item_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-dark rounded-left rounded-10" type="button" data-toggle="modal"
                                    data-target="#createItemModal">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-custom" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Cost Price</th>
                            <th>Total Amount</th>
                            <th>Discount Amount </th>
                            <th>Tax %</th>
                            <th>Tax Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="item_body">
                        @if ($purchse_items != null)
                            @foreach ($purchse_items as $key => $pur_item)
                                <tr class="tr{{ $key + 1 }}">
                                    <input type="hidden" class="price_id" name="price_id[]"
                                        value="{{ $pur_item->price_id }}">
                                    <input type="hidden" class="item_id" name="item_id[]"
                                        value="{{ $pur_item->item_id }}">
                                    <input type="hidden" class="item_name" name="item_name[]"
                                        value="{{ $pur_item->product_name }}">
                                    <td class=" t-1">{{ $pur_item->product_name }}</td>
                                    <td class=" t-1"><input type="number" class="form-control rounded-10"
                                            placeholder="" name="qty[]" required="" autofocus=""
                                            value="{{ $pur_item->qty }}" id="qty{{ $key + 1 }}"
                                            onkeyup="changeQty('{{ $key + 1 }}')"></td>
                                    <td class="t-1">
                                        <input type="number" class="form-control rounded-10 cost-price-blurred"
                                            placeholder="" name="cost_price[]" required="" autofocus=""
                                            value="{{ $pur_item->unit_price }}" id="cost_price{{ $key + 1 }}"
                                            onfocus="unblurCostPrice('cost_price{{ $key + 1 }}')"
                                            onkeyup="changeCostPrice('{{ $key + 1 }}')">
                                    </td>

                                    <td class=" t-1"><input type="number"
                                            class="form-control rounded-10 total_price" placeholder=""
                                            name="total_price[]" required="" autofocus=""
                                            value="{{ $pur_item->total_amount }}"
                                            id="total_price{{ $key + 1 }}" readonly></td>
                                    <td class=" t-1">
                                        <input type="number" class="form-control rounded-10" placeholder=""
                                            name="discount[]" value="{{ $pur_item->discount ?? '' }}"
                                            id="discount{{ $key + 1 }}"
                                            onkeyup="changeDiscount('{{ $key + 1 }}')">
                                    </td>
                                    <td class=" t-1"><input type="number" class="form-control rounded-10"
                                            placeholder="" name="tax[]" required="" autofocus=""
                                            value="{{ $pur_item->tax }}" id="tax{{ $key + 1 }}"
                                            onkeyup="changeTax('{{ $key + 1 }}', '1')"></td>
                                    <td class=" t-1"><input type="number"
                                            class="form-control rounded-10 tax_amount" placeholder=""
                                            name="tax_amount[]" required="" autofocus=""
                                            value="{{ $pur_item->tax_amount }}" id="tax_amount{{ $key + 1 }}"
                                            onkeyup="changeTax('{{ $key + 1 }}', '2')" readonly></td>
                                    <td class=" t-1">
                                        <a class="btn btn-dark rounded-10"
                                            onclick="removeRow('{{ $key + 1 }}')"><i
                                                class="fa fa-remove"></i></a>
                                    </td>
                                </tr>;
                            @endforeach


                        @endif
                    </tbody>
                </table>
                <div class="form-group mt-0 mb-0 col-3">

                    <label class="mb-0 font-weight-bold">Total Discount </label>

                    <input type="number" class="form-control rounded-10" name="total_discount" id="total_discount"
                        value="{{ optional($purchase)->total_discount }}" onkeyup="updateTotal()">
                </div>

            </div>

            <h5 class=" mt-3">Grand Total Amount: <span
                    id="net_total">{{ showAmount(optional($purchase)->total_amount) }}</span>
            </h5>
            <h5>Tax Amount: <span id="tax_amount">{{ showAmount(optional($purchase)->tax_amount) }}</span>
            </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="PurchaseForm" data-target="{{ url('admin/purchase') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<div class="modal fade" id="createSupplierModal" tabindex="-1" role="dialog"
    aria-labelledby="createSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase text-center w-100">Create Supplier</h5>
            </div>
            <form id="unitForm" class="was-validated" autocomplete="off">
                <input type="hidden" name="uuid" value="">
                <input type="hidden" name="branch_id"
                    value="{{ auth()->user()->branch ? auth()->user()->branch->id : getbranchid() }}">
                @csrf
                <div class="col-12 p-0">
                    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Supplier Name</label>
                                    <input type="text" class="form-control rounded-10" id="supplier_name"
                                        name="supplier_name" required autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Company Name</label>
                                    <input type="text" class="form-control rounded-10" id="supplier_company_name"
                                        name="supplier_company_name" required autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Supplier Email</label>
                                    <input type="email" class="form-control rounded-10" id="supplier_email"
                                        name="supplier_email" autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Supplier Company Email</label>
                                    <input type="email" class="form-control rounded-10" id="supplier_company_email"
                                        name="supplier_company_email" autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Supplier Phone</label>
                                    <input type="text" class="form-control rounded-10" id="supplier_phone"
                                        name="supplier_phone" required autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Supplier Address</label>
                                    <input type="text" class="form-control rounded-10" id="supplier_address"
                                        name="supplier_address" autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose modalCloseThis"
                        onclick="closeCreateSupplierModal()">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                        data-method="admincreate" data-form="unitForm" data-target="{{ url('admin/supplier') }}"
                        data-returnaction="createSupplierModal"
                        data-image="{{ url(config('constant.LOADING_GIF')) }}"
                        data-processing="Please wait, saving...">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase text-center w-100">Create Item</h5>
            </div>
            <form id="ItemForm" class="was-validated" autocomplete="off">
                <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                @csrf
                <div class="modal-body" style="max-height: 70vh !important; overflow-y: auto; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mt-0 mb-3">
                                <label class="mb-0 w-100 text-center">Change Item Image</label>
                                <label class="text-center w-100">
                                    <input type="file" class="form-control rounded-10" id="image"
                                        name="image" accept="image/x-png, image/gif, image/jpeg"
                                        style="display: none;" onchange="previewImage(event)">
                                    <div class="row d-flex justify-content-center imageHover">
                                        <div class="col-lg-4 col-md-3 col-sm-3 col-4 rounded-10"
                                            style="border: 1px solid #3b4863 !important; overflow: hidden; position: relative;">
                                            <img src="{{ url('assets/img/placeholder1.png') }}"
                                                class="rounded-10 w-100 h-100" id="imgPreview"
                                                onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp') }}';">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-group mt-0 mb-0">Item Type</label>
                            <select class="form-control rounded-10" id="item_type" name="item_type" required>
                                <option value="">Select Item Type</option>
                                <option value="1">Salable</option>
                                @if (app('appSettings')['production']->value == 'yes')
                                    <option value="2">Raw Material</option>
                                @endif

                            </select>
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>

                        <div class="col-6">
                            <label class="form-group mt-0 mb-0">Select Category</label>
                            <select class="form-control rounded-10" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php $categorys = categoryList($branch_id); ?>
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                        <div class="col-6">
                            <label class="form-group mt-0 mb-0">Select Unit</label>
                            <select class="form-control rounded-10" id="unit_id" name="unit_id" required>
                                <option value="">Select Unit</option>
                                <?php $units = unitList($branch_id); ?>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                        @if (app('appSettings')['Minimum-stock']->value == 'yes')
                            <div class="col-6">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Minimum Stock Quantity</label>
                                    <input type="number" class="form-control rounded-10" id="minimum_qty"
                                        placeholder="" name="minimum_qty" autofocus>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                        @endif

                        <div class="col-6">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Item Name</label>
                                <input type="text" class="form-control rounded-10" id="item_name" placeholder=""
                                    name="item_name" required autofocus>
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-0 mb-0">
                                <label class="mb-0">Item Other Name</label>
                                <input type="text" class="form-control rounded-10" id="item_other_name"
                                    placeholder="" name="item_other_name" autofocus>
                                <div class="valid-feedback">&nbsp;</div>
                                <div class="invalid-feedback">&nbsp;</div>
                            </div>
                        </div>

                        <?php
                        $price_sizes = getPriceSize($branch_id);
                        $count_price_size = count($price_sizes);
                        $class = $count_price_size == 2 || $count_price_size == 3 ? 'col-md-6 ' : 'col-6'; // Numeric comparison
                        ?>

                        <div class="row mx-0 ingredient_show"> <!-- Remove default margins from the row -->
                            @foreach ($price_sizes as $key => $price_size)
                                <!-- Unit Price Column -->
                                <div class="{{ $class }}">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-1">
                                            @if ($key == 0)
                                                Unit Price
                                            @endif
                                            {{ Str::ucfirst($price_size->size_name) }}
                                        </label>
                                        <input type="number" class="form-control rounded-10"
                                            @if ($key == '0') id="item_price" @endif
                                            placeholder="Enter unit price" name="item_price[{{ $price_size->id }}]"
                                            value="0" required onfocus="this.select()">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>


                                @if (app('appSettings')['barcode']->value == 'yes')
                                    <!-- Barcode Column -->
                                    <div class="{{ $class }}">
                                        <div class="form-group mt-0 mb-0">
                                            <label class="mb-1">Barcode
                                                {{ Str::ucfirst($price_size->size_name) }}</label>
                                            <input type="text" class="form-control rounded-10"
                                                @if ($key == '0') id="item_barcode" @endif
                                                placeholder="Enter barcode"
                                                name="item_barcode[{{ $price_size->id }}]"
                                                value="{{ trim(generateBarcode()) }}" required
                                                onfocus="this.select()">
                                            <div class="valid-feedback">&nbsp;</div>
                                            <div class="invalid-feedback">&nbsp;</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if ($count_price_size == '0')
                            <div class="col-12">
                                <div class="form-group mt-0 mb-0">
                                    <label class="mb-0">Please Contact Zaad Platform to add Price Size</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 px-2 ">
                    <div class="d-flex flex-wrap">
                        @if (app('appSettings')['production']->value == 'yes')
                            <div class="ingredient_show">
                                <div class="w-auto mr-2  d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                                    <div class="d-flex mr-2 align-items-center justify-content-start">
                                        <input type="checkbox" class="rounded-10 me-2 " id="ingredient"
                                            name="ingredient" @if (isset($item) && optional($item)->ingredient == '1') checked @endif
                                            value="1" onclick="toggleStockApplicable()">
                                        <label for="ingredient" class="mt-0 mx-1 mb-0">Add Ingredient</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="stock_applicable"
                                    name="stock_applicable" @if (isset($item) && optional($item)->stock_applicable == '1') checked @endif
                                    value="1">
                                <label for="stock_applicable" class="mt-0 mx-1 mb-0">Stock Applicable</label>
                            </div>
                        </div>

                        <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="active" name="active"
                                    @if (isset($item) && optional($item)->active == '1') checked @endif value="1">
                                <label for="active" class="mt-0 mx-1 mb-0">Hide In POS</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10"
                        data-bs-dismiss="modal" onclick="closeCreateItemModal()">Close</button>
                    <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10"
                        data-method="admincreate" data-form="itemForm" data-target="{{ url('admin/item') }}"
                        data-returnaction="createItemModal" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                        data-processing="Please wait, saving...">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imgPreview = document.getElementById('imgPreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset to the default image if no file is selected
            imgPreview.src = "{{ url('assets/img/placeholder1.png') }}";
        }
    }
</script>

<script>
    function handleValidationErrors(errors) {
        for (let key in errors) {
            if (errors.hasOwnProperty(key)) {
                const error = errors[key];
                const inputField = $("#" + key);
                inputField.focus().select();
                notifyme(inputField, error[0], "error", "bottom"); // Show the first error message
            }
        }
    }

    function closeCreateSupplierModal() {
        console.log('this');
        var modal = document.getElementById('createSupplierModal');
        $(modal).modal('hide');
        document.getElementById('unitForm').reset();
    }

    function closeCreateItemModal() {
        console.log('this');
        var modal = document.getElementById('createItemModal');
        $(modal).modal('hide');
        document.getElementById('itemForm').reset();
    }
</script>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("supplier_id");
        $('#items').select2({
            theme: "bootstrap-5",
        });
        $('#supplier_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>


<script>
    // Preview Image Function
    function previewImage(event) {
        let imgPreview = document.getElementById('imgPreview');
        imgPreview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>


<script>
    // Handle Form Submission with AJAX
    document.getElementById('ItemForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading the page

        let form = this;
        let formData = new FormData(form);
        formData.append('is_modal', '1'); // Corrected formData append

        // Get the item dropdown
        let itemIdElement = document.getElementById(
            'items'); // Assuming 'items' is the select dropdown for item_id
        let selectedItemId = parseInt(itemIdElement.value); // Convert the item_id to an integer
        formData.append('item_id[]', selectedItemId); // Append the integer item_id as part of an array

        let submitButton = form.querySelector('button[type="submit"]');
        let actionUrl = submitButton.getAttribute(
            'data-target'); // Get form action URL from the button's data-target attribute
        let loadingGif = submitButton.getAttribute('data-image'); // Loading gif

        // Disable the submit button to prevent multiple submissions
        submitButton.disabled = true;
        submitButton.innerHTML = `<img src="${loadingGif}" alt="Loading..." width="20" height="20"> Saving...`;

        // AJAX Request
        fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Add CSRF Token
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Save';

                if (data.status === 1) {
                    $('#createItemModal').modal('hide');
                    form.reset();

                    // Append new option to the select dropdown with id 'items'
                    let itemsDropdown = document.getElementById('items');
                    let newOption = new Option(data.name, data.id, false, false);
                    newOption.setAttribute("data-price_id", data.price_id);
                    newOption.setAttribute("data-item_id", data.id);
                    newOption.setAttribute("data-name", data.name);
                    newOption.setAttribute("data-item_size", data.size_name);
                    newOption.setAttribute("data-cost_price", data.item_price_cost_price);
                    itemsDropdown.appendChild(newOption);

                    // Trigger select2 update without reinitializing select2 completely
                    if ($(itemsDropdown).hasClass("select2-hidden-accessible")) {
                        // Just trigger an update instead of reapplying select2
                        $(itemsDropdown).trigger('change');
                    }

                    // Add the new item to the item list (if applicable)
                    let newItemRow = `
                      <tr>
                          <td class="t-1">${data.name}</td>
                          <td class="t-1">${data.price_id}</td>
                          <td class="t-1">${data.size_name ? data.size_name : 'N/A'}</td>
                          <td class="t-1">${data.item_price_cost_price ? data.item_price_cost_price : 'N/A'}</td>
                      </tr>`;

                    let itemList = document.getElementById('itemList');
                    if (itemList) {
                        itemList.insertAdjacentHTML('beforeend', newItemRow);
                    } else {
                        console.error('itemList not found!');
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred: ' + error.message);

                submitButton.disabled = false;
                submitButton.innerHTML = 'Save';
            });
    });
</script>
<style>
    .cost-price-blurred {
        filter: blur(1px);
        /* Apply blur effect */
        /* pointer-events: ; Prevent interactions until focused */
    }
</style>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("supplier_id");
        $('#items').select2({
            theme: "bootstrap-5",
        });
        $('#supplier_id').select2({
            theme: "bootstrap-5",
        });
    });

    $(".addITem").on("change", function() {
        var rand = Math.floor(Math.random() * 100000);
        var item = $(this).find('option:selected');
        var found = true;

        $('#item_body .price_id').each(function() {
            if ($(this).val() == item.data('price_id')) {
                found = false;
            }
        });

        if (item.val() != '' && found) {
            var item_name = item.data('name');
            var item_id = item.data('item_id');
            var price_id = item.data('price_id');
            var item_size = (item.data('item_size') === 'Unit price' || item.data('item_size') === '1') ? '' :
                item.data('item_size');
            var cost_price = item.data('cost_price');

            // Create the dynamic row HTML
            let dynamicRowHTML = `
                <tr class="tr` + rand + `">
                    <input type="hidden" class="price_id" name="price_id[]" value="` + price_id + `">
                    <input type="hidden" class="item_id" name="item_id[]" value="` + item_id + `">
                    <input type="hidden" class="item_name" name="item_name[]" value="` + item_name + " - " +
                item_size + `">
                    <td class="t-1">` + item_name + `</td>
                    <td class="t-1"><input type="number" class="form-control rounded-10" placeholder="" name="qty[]" required="" autofocus="" value=""
                        id="qty` + rand + `" onkeyup="changeQty('` + rand +
                `')"></td>
                    <td class="t-1"><input type="number" class="form-control rounded-10 cost-price-blurred" placeholder="" name="cost_price[]" required="" autofocus="" value="` +
                cost_price + `" id="cost_price` + rand + `" onfocus="unblurCostPrice('cost_price` + rand +
                `')" onkeyup="changeCostPrice('` + rand +
                `')"></td>
                    <td class="t-1"><input type="number" class="form-control rounded-10 total_price" placeholder="" name="total_price[]" required="" autofocus="" value="" id="total_price` +
                rand + `" readonly></td>

                    <td class="t-1">
                        <input type="number" class="form-control rounded-10" placeholder=""
                            name="discount[]"
                            value="" id="discount` + rand + `" onkeyup="changeDiscount('` + rand + `')">
                    </td>
                    <td class="t-1"><input type="number" class="form-control rounded-10" placeholder="" name="tax[]" required="" autofocus="" value="5"
                        id="tax` + rand + `" onkeyup="changeTax('` + rand +
                `', '1')"></td>
                    <td class="t-1"><input type="number" class="form-control rounded-10 tax_amount" placeholder="" name="tax_amount[]" required="" autofocus="" value="" id="tax_amount` +
                rand + `" readonly onkeyup="changeTax('` + rand + `', '2')"></td>
                    <td class="t-1">
                        <a class="btn btn-dark rounded-10" onclick="removeRow('` + rand + `')"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>`;

            // Append the dynamic row to the table body
            $('#item_body').append(dynamicRowHTML);
            $('.addITem').val('');
        }
    });

    // JavaScript function to remove the blur effect when focused
    function unblurCostPrice(id) {
        document.getElementById(id).classList.remove('cost-price-blurred');
        document.getElementById(id).style.pointerEvents = "auto"; // Allow interactions
    }

    function updateTotal() {
        let totalAmount = 0;
        let totalTaxAmount = 0;

        // Calculate total amount from individual item total prices
        document.querySelectorAll('.total_price').forEach(function(item) {
            totalAmount += parseFloat(item.value) || 0;
        });

        // Calculate total tax amount from individual item tax amounts
        document.querySelectorAll('.tax_amount').forEach(function(item) {
            totalTaxAmount += parseFloat(item.value) || 0;
        });

        // Get the total discount value
        let totalDiscount = parseFloat(document.getElementById('total_discount').value) || 0;

        // Calculate net total after applying discount
        let netTotal = (totalAmount) - totalDiscount;

        // Update the displayed totals
        document.getElementById('net_total').innerText = netTotal.toFixed(2);
        document.getElementById('tax_amount').innerText = totalTaxAmount.toFixed(2);
    }

    function changeDiscount(rand) {
        var qty = parseFloat($('#qty' + rand).val());
        var cost_price = parseFloat($('#cost_price' + rand).val());
        var discount = parseFloat($('#discount' + rand).val());

        qty = !isNaN(qty) ? qty : 0;
        cost_price = !isNaN(cost_price) ? cost_price : 0;
        discount = !isNaN(discount) ? discount : 0;

        // Calculate total price with discount for the specific item
        var total = (qty * cost_price) - discount;
        $('#total_price' + rand).val(total.toFixed(2));

        // Update the grand total when the item discount changes
        updateTotal();
    }


    function changeQty(rand) {
        var qty = $("#qty" + rand).val();
        var cost_price = $("#cost_price" + rand).val();
        var tax = $("#tax" + rand).val();

        qty = !isNaN(qty) ? qty : 0;
        cost_price = !isNaN(cost_price) ? cost_price : 0;

        calculate_amount(qty, cost_price, tax, rand);
    }

    function changeCostPrice(rand) {
        var cost_price = $("#cost_price" + rand).val();
        var qty = $("#qty" + rand).val();
        var tax = $("#tax" + rand).val();
        // alert(parseFloat(cost_price) * parseFloat(qty));
        qty = !isNaN(qty) ? qty : 0;
        cost_price = !isNaN(cost_price) ? cost_price : 0;

        calculate_amount(qty, cost_price, tax, rand);
    }

    function changeTax(rand, type) {
        var cost_price = $("#cost_price" + rand).val();
        var qty = $("#qty" + rand).val();
        let tax = 0;
        let tax_amount = 0;
        cost_price = !isNaN(cost_price) ? cost_price : 0;
        qty = !isNaN(qty) ? qty : 0;
        tax = $("#tax" + rand).val();

        if (type == '1') {
            tax = $("#tax" + rand).val();
        } else {
            tax_amount = $("#tax_amount" + rand).val();
            if (cost_price != 0) {
                tax = (tax_amount * 100) / cost_price;
            }
            $("#tax" + rand).val(tax);
        }
        calculate_amount(qty, cost_price, tax, rand);




    }

    function calculate_amount(qty, cost_price, tax, rand) {
        var tot_amount = parseFloat(cost_price) * parseFloat(qty)

        var vat_div = parseFloat(tax) + parseFloat(100);
        var vat_amounts = (parseFloat(tot_amount * tax) / parseFloat(vat_div)).toFixed(
            "{{ app('appSettings')['decimal_point']->value }}");

        $("#total_price" + rand).val(tot_amount);
        $("#tax_amount" + rand).val(vat_amounts);

        var tax_amounts = 0;
        var total_prices = 0;

        // Loop through each element with the class 'qty'
        $('.tax_amount').each(function() {
            var tax_amount = parseFloat($(this).val()); // Get the value and convert to a float
            if (!isNaN(tax_amount)) { // Check if the value is a valid number
                tax_amounts += tax_amount;
            }
        });

        $('.total_price').each(function() {
            var total_price = parseFloat($(this)
                .val()); //alert(total_price); // Get the value and convert to a float
            if (!isNaN(total_price)) { // Check if the value is a valid number
                total_prices += total_price;
            }
        });
        $("#tax_amount").html(parseFloat(tax_amounts).toFixed("{{ app('appSettings')['decimal_point']->value }}"));
        $("#net_total").html(parseFloat(total_prices).toFixed("{{ app('appSettings')['decimal_point']->value }}"));

    }


    function removeRow(rand) {
        $(".tr" + rand).remove();
    }





    $(document).ready(function() {
        // When the "Save Supplier" button is clicked
        $('#saveSupplier').on('click', function() {
            var formData = $('#addSupplierForm').serialize();

            $.ajax({
                url: '{{ url('admin/supplier/store') }}', // Change to your store route
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Assuming the response contains the new supplier ID and name
                    if (response.success) {
                        $('#supplier_id').append(new Option(response.supplier_name, response
                            .supplier_id));
                        $('#supplier_id').val(response.supplier_id).trigger(
                            'change'); // Set the newly added supplier
                        $('#dynamicPopup-md').modal('hide'); // Hide the modal
                    }
                },
                error: function(xhr) {
                    // Handle any errors here
                    alert('There was an error adding the supplier.');
                }
            });
        });
    });
</script>
