
<div class="modal-header">
    @if (optional($driver)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Driver</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Driver</h5>
    @endif
</div>
<form id="DriverForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($driver)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid() }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Name</label>
                        <input type="text" class="form-control rounded-10" id="driver_name" placeholder="" name="driver_name" required="" autofocus="" value="{{ optional($driver)->driver_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Email</label>
                        <input type="email" class="form-control rounded-10" id="driver_email" placeholder="" name="driver_email"    autofocus="" value="{{ optional($driver)->driver_email }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Number</label>
                        <input type="text" class="form-control rounded-10" id="driver_phone" placeholder="" name="driver_phone" required="" autofocus="" value="{{ optional($driver)->driver_phone }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Address</label>
                        <input type="text" class="form-control rounded-10" id="driver_address" placeholder="" name="driver_address" autofocus="" value="{{ optional($driver)->driver_address }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Date Of Join</label>
                        <input type="date" class="form-control rounded-10" id="date_of_join" placeholder="" name="date_of_join" required="" autofocus="" value="{{ optional($driver)->date_of_join }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Code</label>
                        <input type="text" class="form-control rounded-10" id="driver_code" placeholder="" name="driver_code" required="" autofocus="" value="{{ optional($driver)->driver_code }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Driver Pin</label>
                        <input type="text" class="form-control rounded-10" id="driver_pin" placeholder="" name="driver_pin"  required="" autofocus="" value="{{ optional($driver)->driver_pin }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0 w-100">Driver License</label>
                        <label class="text-center w-100">
                            <input type="file" class="form-control rounded-10" id="driver_license" placeholder=""
                                name="driver_license" accept="image/x-png, image/gif, image/jpeg"
                                style="display: none;">

                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-md-6 col-sm-6 col-8">
                                    @if (optional($driver)->driver_license)
                                        <img src="{{ url('storage/driver_license')."/".optional($driver)->driver_license }}" class="rounded-10 mt-1 w-100"
                                    id="img1">
                                    @else
                                        <img src="{{ url('assets/img/placeholder.png') }}" class="rounded-10 mt-1 w-100"
                                    id="img1">
                                    @endif
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="DriverForm" data-target="{{ url('admin/driver') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("driver_name");
    });
</script>
