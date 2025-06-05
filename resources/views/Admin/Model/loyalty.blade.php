<div class="modal-header">
    @if (optional($loyalty)->id)
        <h5 class="modal-title text-uppercase text-center w-100">Edit Loyalty</h5>
    @else
        <h5 class="modal-title text-uppercase text-center w-100">Create Loyalty</h5>
    @endif
</div>
<form id="LoyaltyForm" class="was-validated" autocomplete="off" method="POST" action="{{ url('admin/loyalty') }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <!-- Minimum Sale Amount -->
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Minimum Sale Amount</label>
                        <input type="number" class="form-control rounded-10" id="minimum_sale_amount" placeholder="Enter Minimum Sale Amount" name="minimum_sale_amount" required value="{{ optional($loyalty)->min_sale_amount }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">Please enter a valid amount.</div>
                    </div>
                </div>

                <!-- Loyalty Points -->
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Loyalty Points</label>
                        <input type="number" class="form-control rounded-10" id="loyalty_points" placeholder="Enter Loyalty Points" name="loyalty_points" required value="{{ optional($loyalty)->loyalty_points }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">Please enter a valid number of points.</div>
                    </div>
                </div>

                <!-- Loyalty Selling Points -->
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Loyalty Selling Points</label>
                        <input type="number" class="form-control rounded-10" id="loyalty_selling_points" placeholder="Enter Loyalty Selling Points" name="loyalty_selling_points" required value="{{ optional($loyalty)->selling_points }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">Please enter a valid number of selling points.</div>
                    </div>
                </div>

                <!-- Loyalty Redeem Amount -->
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Loyalty Redeem Amount</label>
                        <input type="number" class="form-control rounded-10" id="loyalty_redeem_amount" placeholder="Enter Loyalty Redeem Amount" name="loyalty_redeem_amount" required value="{{ optional($loyalty)->redeem_amount }}">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">Please enter a valid redeem amount.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="LoyaltyForm" data-target="{{ url('admin/loyalty') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".modal").removeAttr("tabindex");
        focustoid("minimum_sale_amount");
    });
</script>
