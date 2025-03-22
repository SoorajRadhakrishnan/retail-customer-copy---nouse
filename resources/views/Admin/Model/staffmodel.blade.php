
<div class="modal-header">
    @if (optional($staff)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Staff</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Staff</h5>
    @endif
</div>
<form id="StaffForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($staff)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid() }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Name</label>
                        <input type="text" class="form-control rounded-10" id="staff_name" placeholder="" name="staff_name" required="" autofocus="" value="{{ optional($staff)->staff_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Email</label>
                        <input type="email" class="form-control rounded-10" id="staff_email" placeholder="" name="staff_email"    autofocus="" value="{{ optional($staff)->staff_email }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Number</label>
                        <input type="text" class="form-control rounded-10" id="staff_phone" placeholder="" name="staff_phone" required="" autofocus="" value="{{ optional($staff)->staff_phone }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Address</label>
                        <input type="text" class="form-control rounded-10" id="staff_address" placeholder="" name="staff_address" autofocus="" value="{{ optional($staff)->staff_address }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Date Of Join</label>
                        <input type="date" class="form-control rounded-10" id="date_of_join" placeholder="" name="date_of_join" required="" autofocus="" value="{{ optional($staff)->date_of_join }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Code</label>
                        <input type="text" class="form-control rounded-10" id="staff_code" placeholder="" name="staff_code" required="" autofocus="" value="{{ optional($staff)->staff_code }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Staff Pin</label>
                        <input type="text" class="form-control rounded-10" id="staff_pin" placeholder="" name="staff_pin"  required="" autofocus="" value="{{ optional($staff)->staff_pin }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="StaffForm" data-target="{{ url('admin/staff') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("staff_name");
    });
</script>
