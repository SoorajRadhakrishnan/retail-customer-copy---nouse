<div class="modal-header">
        <h5 class="modal-title text-uppercase text-center w-100">Open Drawer</h5>
</div>
<form id="expenseForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Password</label>
                        <input type="password" class="form-control rounded-10" id="password" placeholder="" name="password" autofocus="" value="" required>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Reason</label>
                        <input type="text" class="form-control rounded-10" id="reason" placeholder="" name="reason" autofocus="" value="" required>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="counteradd" data-form="expenseForm" data-target="{{ url('open-drawer') }}"
                data-returnaction="redirect" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, opening...">Save</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("password");
    });
</script>
