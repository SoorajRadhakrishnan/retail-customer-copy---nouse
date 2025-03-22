
<div class="modal-header">
    @if (optional($unit)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Unit</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Unit</h5>
    @endif
</div>
<form id="unitForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($unit)->uuid }}">
    <input type="hidden" name="branch_id" value="{{ (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid() }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Unit Name</label>
                        <input type="text" class="form-control rounded-10" id="unit_name" placeholder="" name="unit_name" required="" autofocus="" value="{{ optional($unit)->unit_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="unitForm" data-target="{{ url('admin/unit') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("unit_name");
    });
</script>
