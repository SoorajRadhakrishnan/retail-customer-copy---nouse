<?php $branch_id = (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid(); ?>
<div class="modal-header">
    @if (optional($expense)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Expense</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Expense</h5>
    @endif
</div>
<form id="expenseForm" class="was-validated" autocomplete="off" >
    <input type="hidden" name="uuid" value="{{ optional($expense)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body pb-0" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-md-12">
                    <label class="form-group mt-0 mb-0">Expense Category</label>
                    <select class="form-control rounded-10 onChange" id="expense_category" name="expense_category" required="">
                        <option value="">Select Expense Category</option>
                        <?php $exp_cat = expenseCatList($branch_id); ?>
                        @foreach ($exp_cat as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == optional($expense)->category_id) selected="selected" @endif>
                                {{ $category->expense_category_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Description</label>
                        <textarea class="form-control rounded-10" id="description" name="description" rows="3" placeholder=""
                            autofocus="">{{ optional($expense)->description }}</textarea>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Invoice No</label>
                        <input type="text" class="form-control rounded-10" id="invoice_no" placeholder=""
                            name="invoice_no" autofocus="" value="{{ optional($expense)->invoice_no }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Total Before VAT</label>
                        <input type="number" class="form-control rounded-10" id="tot_bf_vat" placeholder=""
                            name="tot_bf_vat" autofocus="" value="{{ optional($expense)->tot_bf_vat }}" >
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">VAT Amount</label>
                        <input type="number" class="form-control rounded-10" id="vat_amt" placeholder=""
                            name="vat_amt" autofocus="" value="{{ optional($expense)->vat_amt }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>

                <div class="col-md-6 mb-0">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Final Amount</label>
                        <input type="number" class="form-control rounded-10" id="amount" placeholder=""
                            name="amount" autofocus="" value="{{ optional($expense)->amount }}" required="">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
                    <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="counteradd" data-form="expenseForm" data-target="{{ url('expense') }}"
                data-returnaction="getval" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("expense_category");
    });
    // $('#expense_category').select2({
    //         theme: "bootstrap-5",
    //     });
</script>
<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("category_name");
    });

    function enableEnterToFocusNext(formId) {
    let form = document.getElementById(formId);

    form.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent the form from submitting
            let formElements = Array.from(this.elements); // Get all form elements
            let index = formElements.indexOf(document.activeElement); // Get the current focused element

            if (index > -1 && index < formElements.length - 1) {
                formElements[index + 1].focus(); // Focus the next element
            }
        }
    });
}

enableEnterToFocusNext('expenseForm');
</script>
