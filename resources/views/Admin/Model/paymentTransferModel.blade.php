<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Create Transfer</h5>
</div>
<form id="PaymentTransferForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <?php $divStyle = 'col-12 mt-3'; ?>
                <div class="{{ $divStyle }}">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">From Payment Method</label>
                        <div class="input-group">
                            <select class="form-control rounded-10 onChange" id="source_payment_type"
                                name="source_payment_type" required="">
                                <option value="">Select Branch</option>
                                @foreach ($paymentMethods as $paymentMethod)
                                    @if (strtolower($paymentMethod->payment_method_name) !== 'credit')
                                        <option value="{{ $paymentMethod->payment_method_slug }}">
                                            {{ $paymentMethod->payment_method_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="{{ $divStyle }}">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">To Payment Method</label>
                        <div class="input-group">
                            <select class="form-control rounded-10 onChange" id="destination_payment_type"
                                name="destination_payment_type" required="">
                                <option value="">Select Branch</option>
                                @foreach ($paymentMethods as $paymentMethod)
                                    @if (strtolower($paymentMethod->payment_method_name) !== 'credit')
                                        <option value="{{ $paymentMethod->payment_method_slug }}">
                                            {{ $paymentMethod->payment_method_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <div class="{{ $divStyle }}">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Notes</label>
                        <input type="text" class="form-control rounded-10" id="notes" placeholder=""
                            name="notes" autofocus="" value="">
                    </div>
                </div>
                {{-- <div class="{{ $divStyle }}">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Transfer Date</label>
                        <input type="date" class="form-control rounded-10" id="transaction_date"
                            name="transaction_date" required=""
                            value="">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div> --}}
                <div class="{{ $divStyle }}">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0 font-weight-bold">Amount</label>
                        <input type="number" class="form-control rounded-10" id="amount" placeholder=""
                            name="amount" autofocus="" value="" required="">
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="PaymentTransferForm"
                data-target="{{ url('admin/payment-transfer') }}" data-returnaction="reload"
                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#source_payment_type, #destination_payment_type').on('change', function () {
            var value1 = $('#source_payment_type').val();
            var value2 = $('#destination_payment_type').val();

            if (value1 && value2 && value1 === value2) {
                notifyme2("You can't transfer to the same payment.");
                $(this).val('');
            }
        });
    });
</script>



