
<div class="modal-header">
    @if (optional($payment_method)->uuid)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Payment Method</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Payment Method</h5>
    @endif
</div>
<form id="PaymentMethodForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="uuid" value="{{ optional($payment_method)->uuid }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                @if (auth()->user()->branch == '')
                <div class="col-12">
                    <label class="form-group mt-0 mb-0">Select Branch</label>
                    <select class="form-control rounded-10 onChange" id="branch" name="branch" required="" >
                        <option value="">Select Branch</option>
                        <?php $branches = branchList(); ?>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}"
                                @if ($branch->id == optional($payment_method)->branch_id) selected="selected" @endif>
                                    {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">&nbsp;</div>
                    <div class="invalid-feedback">&nbsp;</div>
                </div>
                @endif
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Payment Method Name</label>
                        <input type="text" class="form-control rounded-10" id="payment_method_name" placeholder="" name="payment_method_name" required="" autofocus="" value="{{ optional($payment_method)->payment_method_name }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="PaymentMethodForm" data-target="{{ url('payment-method') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>
    <script>
        $(document).ready(function() {
            $(".modal").removeAttr("tabindex");
            focustoid("payment_method_name");
        });
    </script>
