<?php $branch_id = auth()->user()->branch->id; ?>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Enter Opening Cash</h5>
</div>
<form id="openCashForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Opening Cash</label>
                        <input type="text" class="form-control rounded-10" id="opening_balance" placeholder="" name="opening_balance" autofocus="" value="{{ $opencash }}" required="">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="counteradd" data-form="openCashForm" data-target="{{ url('open-balance') }}"
                data-returnaction="getval" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("opening_balance");
    });
</script>
