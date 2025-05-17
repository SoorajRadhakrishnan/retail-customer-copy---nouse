<div class="modal-header">
    @if (optional($stock_transfer)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Transfer</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Transfer</h5>
    @endif
</div>
<form id="StockTransferForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="id" value="{{ optional($stock_transfer)->id }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                @if (!$branch_id)
                    <?php $divStyle = 'col-3'; ?>
                    <div class="{{ $divStyle }} pr-1">
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-0 font-weight-bold">Source Branch</label>
                            <div class="input-group">
                                <select class="form-control rounded-10 onChange" id="source_branch_id"
                                    name="source_branch_id" required="">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            @if ($branch->id == optional($stock_transfer)->source_branch_id) selected="selected" @endif>
                                            {{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="source_branch_id" id="source_branch_id" value="{{ $branch_id }}">
                    <?php $divStyle = 'col-4'; ?>
                @endif
                <div class="{{ $divStyle }} pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Destination Branch</label>
                        <div class="input-group">
                            <select class="form-control rounded-10 onChange" id="destination_branch_id"
                                name="destination_branch_id" required="">
                                <option value="">Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        @if ($branch->id == optional($stock_transfer)->destination_branch_id) selected="selected" @endif>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="{{ $divStyle }} pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Notes</label>
                        <input type="text" class="form-control rounded-10" id="notes" placeholder=""
                            name="notes" autofocus="" value="{{ optional($stock_transfer)->notes }}">
                    </div>
                </div>
                <div class="{{ $divStyle }} pr-1">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Transfer Date</label>
                        <input type="date" class="form-control rounded-10" id="transaction_date"
                            name="transaction_date" required
                            value="{{ old('transaction_date', optional($stock_transfer)->transaction_date) }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-6 offset-3">
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
                                        data-price_size_id="{{ $item->price_size_id }}"
                                        data-cost_price="{{ $item->item_price_cost_price }}"
                                        data-item_stock="{{ $item->item_stock }}">
                                        {{ $item->item_name }}
                                            @if($item->size_name != 'Unit price')
                                                {{ " - ".$item->size_name }}
                                            @endif
                                    </option>
                                @endforeach
                            </select>
                            {{-- <div class="input-group-append">
                                <button class="btn btn-dark rounded-left rounded-10" type="button" data-toggle="modal"
                                    data-target="#createItemModal">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="form-group mt-5 mb-0 col-12">
                    <table class="table table-custom" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:30%;text-align:center">Item</th>
                                <th style="width:20%;text-align:center">Available Stock</th>
                                <th style="width:25%;text-align:center">Qty</th>
                                <th style="width:25%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="item_body">
                            @if ($transfer_items != null)
                                @foreach ($transfer_items as $key => $trans_item)
                                    <?php
                                        $stock = getCurrentStock($trans_item->item_price_id);
                                        $item_name = $trans_item->getItem->item_name;
                                        $price_size = $trans_item->getItemPrice->pricesize->size_name;
                                        if($price_size == 'Unit price'){
                                            $price_size = '';
                                        }else{
                                            $price_size = " - ".$price_size;
                                        }
                                    ?>
                                    <tr class="tr{{ $key + 1 }}">
                                        <input type="hidden" class="price_id" name="price_id[]"
                                            value="{{ $trans_item->item_price_id }}">
                                        <input type="hidden" class="item_id" name="item_id[]"
                                            value="{{ $trans_item->item_id }}">
                                        <input type="hidden" class="price_size_id" name="price_size_id[]"
                                            value="{{ $trans_item->item_price_size_id }}">
                                        <input type="hidden" class="cost_price" name="cost_price[]"
                                            value="{{ $trans_item->cost_price }}">
                                        <td class=" t-1" style="width:30%;text-align:center">{{ $item_name.$price_size }}
                                        </td>
                                        <td class=" t-1" style="width:20%;text-align:center">
                                            {{ $stock+$trans_item->qty }}
                                        </td>
                                        <td class=" t-1" style="width:25%;text-align:center">
                                            <input type="number" class="form-control rounded-10" placeholder=""
                                                name="qty[]" required="" autofocus=""
                                                value="{{ $trans_item->qty }}" id="qty{{ $key }}"
                                                onkeyup="checkQty(this,'{{ $stock+$trans_item->qty }}')">
                                        </td>
                                        <td class="t-1" style="width:25%;text-align:center">
                                            <a class="btn btn-dark rounded-10"
                                                onclick="removeRow('{{ $key + 1 }}')"><i
                                                    class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="StockTransferForm"
                data-target="{{ url('admin/stock-transfer') }}" data-returnaction="reload"
                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase text-center w-100">Create Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <option value="2">Raw Material</option>
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

                        <?php
                        $price_sizes = getPriceSize($branch_id);
                        $count_price_size = count($price_sizes);
                        $class = $count_price_size == 2 || $count_price_size == 3 ? 'col-md-6 ' : 'col-12'; // Numeric comparison
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

                                <!-- Barcode Column -->
                                <div class="{{ $class }}">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-1">Barcode
                                            {{ Str::ucfirst($price_size->size_name) }}</label>
                                        <input type="text" class="form-control rounded-10"
                                            @if ($key == '0') id="item_barcode" @endif
                                            placeholder="Enter barcode" name="item_barcode[{{ $price_size->id }}]"
                                            value="{{ trim(generateBarcode()) }}" required onfocus="this.select()">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
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
                        <div class="ingredient_show">
                            <div class="w-auto mr-2  d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                                <div class="d-flex mr-2 align-items-center justify-content-start">
                                    <input type="checkbox" class="rounded-10 me-2 " id="ingredient"
                                        name="ingredient" value="1" onclick="toggleStockApplicable()">
                                    <label for="ingredient" class="mt-0 mx-1 mb-0">Add Ingredient</label>
                                </div>
                            </div>
                        </div>

                        <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="stock_applicable"
                                    name="stock_applicable" value="1">
                                <label for="stock_applicable" class="mt-0 mx-1 mb-0">Stock Applicable</label>
                            </div>
                        </div>

                        <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="active" name="active"
                                    value="1">
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
        focustoid("source_branch_id");
        $('#items').select2({
            theme: "bootstrap-5",
        });
        // $('#source_branch_id, #destination_branch_id').select2({
        //     theme: "bootstrap-5",
        // });
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


<script>
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
            var price_size_id = item.data('price_size_id');
            var item_size = (item.data('item_size') === 'Unit price' || item.data('item_size') === '1') ? '' :
                ' - '+item.data('item_size');
            var cost_price = item.data('cost_price');
            var item_stock = item.data('item_stock');

            // Create the dynamic row HTML
            let dynamicRowHTML = `
            <tr class="tr` + rand + `">
                <input type="hidden" class="price_id" name="price_id[]" value="` + price_id + `">
                <input type="hidden" class="item_id" name="item_id[]" value="` + item_id + `">
                <input type="hidden" class="price_size_id" name="price_size_id[]" value="` + price_size_id + `">
                <input type="hidden" class="cost_price" name="cost_price[]" value="` + cost_price + `">
                <td class="t-1" style="width:30%;text-align:center">` + item_name + item_size+ `</td>
                <td class="t-1" style="width:20%;text-align:center">` + item_stock + `</td>
                <td class="t-1" style="width:25%;text-align:center"><input type="number" class="form-control rounded-10" placeholder="" name="qty[]" required="" autofocus="" value=""
                    id="qty` + rand + `" onkeyup="checkQty(this,'`+ item_stock +`')"></td>
                <td class="t-1" style="width:25%;text-align:center">
                    <a class="btn btn-dark rounded-10" onclick="removeRow('` + rand + `')"><i class="fa fa-remove"></i></a>
                </td>
            </tr>`;

            // Append the dynamic row to the table body
            $('#item_body').append(dynamicRowHTML);
            $('.addITem').val('');
        }
    });

    function removeRow(rand) {
        $(".tr" + rand).remove();
    }

    function checkQty(inputElement, qty)
    {
        const enteredValue = parseFloat(inputElement.value);
        if (parseFloat(enteredValue) > parseFloat(qty)) {
            inputElement.value = qty;
        }
    }
</script>
