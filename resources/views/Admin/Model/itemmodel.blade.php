<?php $branch_id = getbranchid(); ?>
<div class="modal-header">
    @if (optional($item)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Item</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Item</h5>
    @endif
</div>
<form id="ItemForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($item)->uuid }}">
    <input type="hidden" name="id" value="{{ optional($item)->id }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="modal-body" style="max-height: 70vh !important; overflow-y: auto; overflow-x: hidden;">
        <div class="row">
            <div class="col-12">
                <div class="form-group mt-0 mb-3">
                    <label class="mb-0 w-100 text-center">Change Item Image</label>
                    <label class="text-center w-100">
                        <input type="file" class="form-control rounded-10" id="image" name="image"
                            accept="image/x-png, image/gif, image/jpeg" style="display: none;">
                        <div class="row d-flex justify-content-center imageHover">
                            <div class="col-lg-4 col-md-3 col-sm-3 col-4 rounded-10"
                                style="border: 1px solid #3b4863 !important; overflow: hidden; position: relative;">
                                @if (optional($item)->image)
                                    <img src="{{ url('storage/item_image') . '/' . optional($item)->image }}"
                                        class="rounded-10 w-100" id="img26"
                                        onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp') }}';">
                                @else
                                    <img src="{{ url('assets/img/placeholder1.png') }}" class="rounded-10 w-100 h-100"
                                        id="img26"
                                        onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp') }}';">
                                @endif
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            <div class="col-6 ">
                <label class="form-group mt-0 mb-0">Item Type</label>
                <select class="form-control rounded-10 onChange" id="item_type" name="item_type" required="">
                    <option value="">Select Item Type</option>
                    {{-- <option value="">Select Item Type</option> --}}
                    <option value="1" @if ('1' == optional($item)->item_type) selected="selected" @endif>
                        Salable
                    </option>
                                        @if ((app('appSettings')['production'])->value == 'yes')

                    <option value="2" @if ('2' == optional($item)->item_type) selected="selected" @endif>
                        Raw Material
                    </option>

                    @endif

                </select>
                <div class="valid-feedback">&nbsp;</div>
                <div class="invalid-feedback">&nbsp;</div>
            </div>
            {{-- <div class="col-6 ">
                    <<div class="w-auto ml-3 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                        <div class="d-flex align-items-center justify-content-start">
                            <input type="checkbox" class="form-check-input rounded-10 me-1 mx-1" id="stock_applicable" name="stock_applicable"
                                   value="1" @if (optional($item)->stock_applicable) checked @endif>
                            <label for="stock_applicable" class="mt-0 mx-5 mb-0">Stock Applicable</label>
                        </div>
                    </div>

                    <input type="text" name="stock_applicable" id="stock_applicable_value"
                        value="{{ optional($item)->stock_applicable ? '1' : '0' }}">

                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div> --}}

            <script>
                // JavaScript to handle checkbox change and update the hidden input
                document.getElementById('stock_applicable').addEventListener('change', function() {
                    document.getElementById('stock_applicable_value').value = this.checked ? '1' : '0';
                });
            </script>

            <div class="col-6 ">
                <label class="form-group mt-0 mb-0">Select Category</label>
                <select class="form-control rounded-10 onChange" id="category_id" name="category_id" required="">
                    <option value="">Select Category</option>
                    <?php $categorys = categoryList($branch_id); ?>
                    @foreach ($categorys as $category)
                        <option value="{{ $category->id }}"
                            @if ($category->id == optional($item)->category_id) selected="selected" @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                <div class="valid-feedback">&nbsp;</div>
                <div class="invalid-feedback">&nbsp;</div>
            </div>
            <div class="col-6 ">
                <label class="form-group mt-0 mb-0">Select Unit</label>
                <select class="form-control rounded-10 onChange" id="unit_id" name="unit_id" required="">
                    <option value="">Select Unit</option>
                    <?php $units = unitList($branch_id); ?>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}"
                            @if ($unit->id == optional($item)->unit_id) selected="selected" @endif>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
                <div class="valid-feedback">&nbsp;</div>
                <div class="invalid-feedback">&nbsp;</div>
            </div>
            @if (app('appSettings')['Minimum-stock']->value == 'yes')
            <div class="col-6 ">
                <div class="form-group mt-0 mb-0">
                    <label class="mb-0">Minimum Stock Quantity</label>
                    <input type="number" class="form-control rounded-10" id="minimum_qty" placeholder=""
                        name="minimum_qty" autofocus=""
                        value="{{ old('minimum_qty', $item->minimum_qty ?? '') }}">
                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div>
            </div>
        @endif

            <div class="col-6 ">
                <div class="form-group mt-0 mb-0">
                    <label class="mb-0">Item Name</label>
                    <input type="text" class="form-control rounded-10" id="item_name" placeholder="" name="item_name"
                        required="" autofocus="" value="{{ optional($item)->item_name }}">
                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div>
            </div>
            <div class="col-6 ">
                <div class="form-group mt-0 mb-0">
                    <label class="mb-0">Item Other Name</label>
                    <input type="text" class="form-control rounded-10" id="item_other_name" placeholder=""
                        name="item_other_name" autofocus="" value="{{ optional($item)->item_other_name }}">
                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div>
            </div>
            <?php
            $price_sizes = getPriceSize($branch_id);
            $count_price_size = count($price_sizes);
            $class = $count_price_size == 2 || $count_price_size == 3 ? 'col-md-6 ' : 'col-md-6'; // Numeric comparison
            $count = 1;
            ?>

            <div class="row mx-0 "> <!-- Remove default margins from the row -->
                @foreach ($price_sizes as $key => $price_size)
                    <!-- Unit Price Column -->
                    <div class="{{ $class }} "> <!-- Use padding to ensure spacing -->
                        <div class="form-group mt-0 mb-0"> <!-- Add margin-bottom for spacing between fields -->
                            <label class="mb-1">
                                @if ($key == 0)
                                    Unit Price
                                @endif
                                {{ Str::ucfirst($price_size->size_name) }}
                            </label>
                            <input type="number" class="form-control rounded-10"
                                @if ($key == '0') id="item_price" @endif placeholder="Enter unit price"
                                name="item_price[{{ $price_size->id }}]"
                                value="{{ isset($item->itemprice) ? getItemPricebyId($item->id, $price_size->id) : 0 }}"
                                required="" onfocus="this.select()">
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                    </div>
                    @if (app('appSettings')['barcode']->value == 'yes')
                    <!-- Barcode Column -->
                    <div class="{{ $class }} "> <!-- Same padding for both Unit Price and Barcode -->
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-1">Barcode {{ Str::ucfirst($price_size->size_name) }}</label>
                            <input type="text" class="form-control rounded-10"
                                id="item_barcode{{ $price_size->id }}" placeholder="Enter barcode"
                                name="item_barcode[{{ $price_size->id }}]"
                                value="{{ isset($item->itemprice) ? trim(getItembarcodebyId($item->id, $price_size->id)) : trim(generateBarcode()) }}"
                                required="" onfocus="this.select()">
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

            {{-- <div class="col-12">
                    <label class="">Please enter zero if price is not there, And it won't show in sale page</label>
                </div> --}}
            {{-- <div class="col-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Barcode</label>
                        <input type="text" class="form-control rounded-10" id="barcode" placeholder="" name="barcode" required="" autofocus="" value="{{ optional($item)->barcode ?? generateBarcode() }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div> --}}
            {{-- <div class="col-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Stock</label>
                        <input type="text" class="form-control rounded-10" id="stock" placeholder="" name="stock" autofocus="" value="{{ optional($item)->stock }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div> --}}


            {{-- <div class="col-3 ingredient_show" {{ $show }}>
                    <label class="form-group mt-0 mb-0">Add Ingredient</label>
                    <input type="checkbox" class="form-control rounded-10" id="ingredient" placeholder="" name="ingredient"  required="" autofocus="" @if (optional($item)->ingredient == '1') checked @endif value=1>
                </div> --}}
            {{-- <div class="row">
                    <div class="col-4  ingredient_show">
                        <div class="w-auto d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="ingredient" name="ingredient"
                                    @if (optional($item)->ingredient == '1') checked @endif value="1"
                                    onclick="toggleStockApplicable()">
                                <label for="ingredient" class="mt-0  mx-1 mb-0">Add Ingredient</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 px-4">
                        <div class="w-auto  d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="stock_applicable"
                                    name="stock_applicable" @if (optional($item)->stock_applicable == '1') checked @endif
                                    value="1">
                                <label for="stock_applicable" class="mt-0 mx-1 mb-0">Stock Applicable</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 pl-1">
                        <div class="w-auto d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2" id="active" name="active"
                                    @if (optional($item)->ingredient == '1') checked @endif value="1">
                                <label for="active" class="mt-0 mx-1 mb-0">Hide In POS</label>
                            </div>
                        </div>
                    </div>
                </div> --}}


            <div class="col-12 px-2 ">
                <div class="d-flex flex-wrap"> @if ((app('appSettings')['production'])->value == 'yes')
                    <div class="ingredient_show">
                        <div class="w-auto mr-2  d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                            <div class="d-flex mr-2 align-items-center justify-content-start">
                                <input type="checkbox" class="rounded-10 me-2 " id="ingredient" name="ingredient"
                                    @if (optional($item)->ingredient == '1') checked @endif value="1"
                                    onclick="toggleStockApplicable()">
                                <label for="ingredient" class="mt-0 mx-1 mb-0">Add Ingredient</label>
                            </div>
                        </div>
                    </div>
@endif
                    <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                        <div class="d-flex align-items-center justify-content-start">
                            <input type="checkbox" class="rounded-10 me-2" id="stock_applicable"
                                name="stock_applicable" @if (optional($item)->stock_applicable == '1') checked @endif
                                value="1">
                            <label for="stock_applicable" class="mt-0 mx-1 mb-0">Stock Applicable</label>
                        </div>
                    </div>

                    <div class="w-auto mr-2 d-flex d-inline-block border mb-3 px-3 py-2 rounded-10">
                        <div class="d-flex align-items-center justify-content-start">
                            <input type="checkbox" class="rounded-10 me-2" id="active" name="active"
                            @if (optional($item)->active == 'no') checked @endif value="no">
                            <label for="active" class="mt-0 mx-1 mb-0">Hide In POS</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
            data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm" data-method="adminedit"
            data-form="ItemForm" data-target="{{ url('admin/item') }}" data-returnaction="reload"
            data-image="{{ url(config('constant.LOADING_GIF')) }}"
            data-processing="Please wait, saving...">Save</button>
</form>
<script>
// Event listener for image input change
document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    const previewImg = document.getElementById('img26'); // Get the image element for preview

    if (file) {
        const reader = new FileReader(); // Initialize file reader

        // When the file is loaded, set the preview image source
        reader.onload = function(e) {
            previewImg.src = e.target.result; // Set image src to the result of the file read
        };

        reader.readAsDataURL(file); // Read the image file as a data URL (base64)
    } else {
        // If no file is selected, reset the image preview to placeholder
        previewImg.src = '{{ url("assets/img/placeholder1.png") }}';
    }
});
</script>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("item_name");
        $('#category_id, #unit_id, #branch_id').select2({
            theme: "bootstrap-5",
        });
    });
    $('#item_type').on('change', function() {
        if ($(this).val() == 1) {
            $(".ingredient_show").show();
            $(".col-4").removeClass('col-6').addClass('col-4'); // Switch back to col-4 when value is 1
        } else {
            $(".ingredient_show").hide();
            $(".col-4").removeClass('col-4').addClass('col-6'); // Change to col-6 when else condition is true
        }
    });
    $('#ingredient, #item_type, #stock_applicable').change(function() {
        var item_type = $('#item_type').val();
        var ingredient = $('#ingredient').is(':checked');

        if (ingredient && item_type == 1) {
            // $('#stock_applicable').val(1);
            $('#stock_applicable').prop('checked', true);
        }
        if (item_type == 2) {
            $('#stock_applicable').prop('checked', true);
        }

      //  if (item_type != 1 && item_type != 2) {
        //    $('#ingredient').prop('checked', false);
        // }
    });
</script>
<script>
    document.getElementById('stock_applicable').addEventListener('change', function() {
        document.getElementById('stock_applicable_value').value = this.checked ? '1' : '0';
    });

    function previewImage(event) {
        const img = document.getElementById('img26');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.onload = function() {
            URL.revokeObjectURL(img.src);
        }
    }

    function toggleStockApplicable() {
        const stockApplicableCheckbox = document.getElementById('stock_applicable');
        const ingredientCheckbox = document.getElementById('ingredient');

        // Check the Stock Applicable checkbox if the Add Ingredient checkbox is checked
        if (ingredientCheckbox.checked) {
            stockApplicableCheckbox.checked = true; // Check the stock applicable checkbox
            document.getElementById('stock_applicable_value').value = '1'; // Update hidden value
        }
    }
</script>
