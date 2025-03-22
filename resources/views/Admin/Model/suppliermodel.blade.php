
<div class="modal-header">
    @if (optional($supplier)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Supplier</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Supplier</h5>
    @endif
</div>
<form id="unitForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($supplier)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid() }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Supplier Name</label>
                        <input type="text" class="form-control rounded-10" id="supplier_name" placeholder="" name="supplier_name" required="" autofocus="" value="{{ optional($supplier)->supplier_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Company Name</label>
                        <input type="text" class="form-control rounded-10" id="supplier_company_name" placeholder="" name="supplier_company_name" required="" autofocus="" value="{{ optional($supplier)->supplier_company_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Supplier Email</label>
                        <input type="email" class="form-control rounded-10" id="supplier_email" placeholder="" name="supplier_email" autofocus="" value="{{ optional($supplier)->supplier_email }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Supplier Company Email</label>
                        <input type="email" class="form-control rounded-10" id="supplier_company_email" placeholder="" name="supplier_company_email" autofocus="" value="{{ optional($supplier)->supplier_company_email }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Supplier Phone</label>
                        <input type="text" class="form-control rounded-10" id="supplier_phone" placeholder="" name="supplier_phone" required="" autofocus="" value="{{ optional($supplier)->supplier_phone }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Supplier Address</label>
                        <input type="text" class="form-control rounded-10" id="supplier_address" placeholder="" name="supplier_address" autofocus="" value="{{ optional($supplier)->supplier_address }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="unitForm" data-target="{{ url('admin/supplier') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("supplier_name");
    });
</script>
