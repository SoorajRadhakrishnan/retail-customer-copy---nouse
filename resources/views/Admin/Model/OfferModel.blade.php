<style>
    .select2-container .select2-selection {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 5px;
        min-height: 38px;
    }

    .select2-results__option {
        padding: 10px 15px;
        /* Adjust padding for spacing */
        margin-bottom: 5px;
        /* Space between options */
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e4e4e4;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0px 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f40404;
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        margin-right: 186px;
        margin-bottom: 10px;
    }

    .select2-selection__choice__remove {
        color: #fff;
        opacity: .5;
        font-size: 12px;
        display: inline-block;
        position: absolute;
        top: 4px;
        left: 4px;
    }

    #selectedCategories {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    /* #selectedCategories .badge {
        font-size: 2rem;
        padding: 0.5rem 1rem;
        .select2-selection__clear {
    color: #fff;  /* Change the text color */
    background-color: #dc3545;  /* Change the background color */
    border-radius: 50%;  /* Make it circular */
    padding: 5px;
    font-size: 18px;  /* Increase the size */
    margin-left: 5px;  /* Add space to the left */
}


    } */
</style>
{{-- @dd($offer->categories); --}}
<?php $branch_id = auth()->user()->branch ? auth()->user()->branch->id : getbranchid(); ?>
<div class="modal-header">
    @if (optional($offer)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Offer</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Offer</h5>
    @endif
</div>
<form id="offerForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($offer)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body pb-0" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-md-6 mb-0">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Offer Name</label>
                        <input type="text" class="form-control rounded-10" id="offer_name" name="offer_name"
                            value="{{ optional($offer)->offer_name }}" required>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <!-- Unique Promo Code -->
                <div class="col-md-6 mb-3" style="display: none">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Promo Code</label>
                        <input type="text" class="form-control rounded-10" id="promocode" name="promocode"
                            value="{{ optional($offer)->promocode ?? strtoupper(uniqid('PROMO_')) }}" readonly>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <!-- From Date -->
                <div class="col-md-6 mb-3">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">From Date</label>
                        <input type="date" class="form-control rounded-10" id="from_date" name="from_date"
                            value="{{ optional($offer)->from_date }}" required>
                    </div>
                </div>

                <!-- To Date -->
                <div class="col-md-6 mb-3">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">To Date</label>
                        <input type="date" class="form-control rounded-10" id="to_date" name="to_date"
                            value="{{ optional($offer)->to_date }}" required>
                    </div>
                </div>

                <!-- Amount Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-group mt-0 mb-0">Amount Type</label>
                    <select class="form-control rounded-10" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="percentage" @if (optional($offer)->type == 'percentage') selected @endif>Percentage</option>
                        <option value="amount" @if (optional($offer)->type == 'amount') selected @endif>Amount</option>
                    </select>
                </div>

                <!-- Value Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Value</label>
                        <input type="number" class="form-control rounded-10" id="value" name="value"
                            placeholder="Enter Value" value="{{ optional($offer)->value }}" min="0"
                            max="100" required>
                        <div class="small text-danger d-none" id="value-error">Percentage cannot exceed 100!</div>
                    </div>
                </div>

                <div class="col-md-6 mb-0">
                    <div class="form-group mt-0 mb-0" style="display: none;" id="min-amount-group">
                        <label class="mb-0">Minimum Amount</label>
                        <input type="text" class="form-control rounded-10" id="min_amt" name="min_amt"
                            value="{{ optional($offer)->min_amt }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                                <div class="col-md-12">
                    {{-- <label class="form-group mt-0 mb-0">Categories</label> --}}
                    <?php
                    $categories = categoryList($branch_id);
                    $selectedCategories = $offer && $offer->categories
                        ? $offer->categories->pluck('id')->toArray()
                        : [];
                    ?>
                    <label class="form-group mt-0 mb-0">Categories</label>
                    <select class="form-control rounded-10 select2-multiple" style="width: 100%" id="categories" name="categories[]" multiple required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach

                    </select>

                    {{-- <div id="selectedCategories" class="mt-2">
                        <!-- Selected categories will appear here as tags -->
                    </div> --}}
                </div>

            </div>
        </div>

        <div class="modal-footer mt-3">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="offerForm" data-target="{{ url('admin/offers') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $('.select2-multiple').select2({
        placeholder: "Select Categories",
        allowClear: true,
        // theme: 'bootstrap4',
        templateResult: formatCategory, // Custom rendering for options
        templateSelection: formatCategorySelection // Custom rendering for selected items
    });

    // Format for dropdown options
    function formatCategory(category) {
        if (!category.id) {
            return category.text;
        }
        let $category = $(
            '<div class="d-flex align-items-center">' +
            '<span class="">' + category.text + '</span>' +
            '</div>'
        );
        return $category;
    }

    // Format for selected items (appears as tags below the dropdown)
    function formatCategorySelection(category) {
        if (!category.id) {
            return category.text;
        }
        let $tag = $(
            '<span class="nav-linkk badge btn-dark shadoww" style=" padding: 7px 15px;">' + category.text +
            '</span>'
        );
        return $tag;
    }


    // Function to handle showing or hiding the Minimum Amount field
    // Function to handle showing or hiding the Minimum Amount field
    // Function to handle showing or hiding the Minimum Amount field
    function toggleMinAmountField() {
        const typeValue = document.getElementById('type').value;
        const valueInput = document.getElementById('value');
        const minAmtField = document.getElementById('min_amt').closest(
        '.form-group'); // Get the parent container of min_amt

        if (typeValue === 'percentage') {
            valueInput.setAttribute('max', 100);
            valueInput.placeholder = "Enter Percentage (0-100)";
            minAmtField.style.display = 'none'; // Hide the min amount field
        } else if (typeValue === 'amount') {
            valueInput.removeAttribute('max');
            valueInput.placeholder = "Enter Amount";
            minAmtField.style.display = 'block'; // Show the min amount field
        }
    }

    // Ensure the correct field visibility on page load for editing scenarios
    function initializeFields() {
        toggleMinAmountField();
    }

    // Use jQuery's `$(document).ready` for compatibility
    $(document).ready(function() {
        initializeFields();

        // Event listener for the `type` dropdown change event
        $('#type').on('change', toggleMinAmountField);

        // Event listener for the value input to validate percentage
        $('#value').on('input', function() {
            const error = document.getElementById('value-error');
            if ($('#type').val() === 'percentage' && this.value > 100) {
                $(error).removeClass('d-none');
                this.value = 100;
            } else {
                $(error).addClass('d-none');
            }
        });
    });
</script>
