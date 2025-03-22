
<div class="modal-header">
    @if (optional($customer)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Customer</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Customer</h5>
    @endif
</div>
<form id="CustomerForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($customer)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Customer Name</label>
                        <input type="text" class="form-control rounded-10" id="customer_name" placeholder="" name="customer_name" required="" autofocus="" value="{{ optional($customer)->customer_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Customer Email</label>
                        <input type="email" class="form-control rounded-10" id="customer_email" placeholder="" name="customer_email"   autofocus="" value="{{ optional($customer)->customer_email }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Customer Number</label>
                        <input type="text" class="form-control rounded-10" id="customer_number" placeholder="" name="customer_number" required="" autofocus="" value="{{ optional($customer)->customer_number }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Customer Address</label>
                        <input type="text" class="form-control rounded-10" id="customer_address" placeholder="" name="customer_address" autofocus="" value="{{ optional($customer)->customer_address }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Customer Gender</label>
                        <select class="form-control rounded-10" id="customer_gender" name="customer_gender" id="customer_gender">
                            <option value="">Select Gender</option>
                            <option value="male"
                                @if (optional($customer)->customer_gender == 'male') selected="selected" @endif> Male
                            </option>
                            <option value="female"
                                @if (optional($customer)->customer_gender == 'female') selected="selected" @endif> Female
                            </option>
                        </select>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="CustomerForm" data-target="{{ url('crm') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("customer_name");
    });
</script>
