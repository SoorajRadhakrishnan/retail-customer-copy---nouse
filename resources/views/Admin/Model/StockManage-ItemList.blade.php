<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Items</h5>
</div>

<form id="StockTransferApproveForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="stock_manage_id" value="{{ $id }}">
    <input type="hidden" name="source_branch_id" value="{{ $source_branch_id }}">
    <input type="hidden" name="destination_branch_id" value="{{ $destination_branch_id }}">
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th class="py-2 bg-transparent text-center" style="width: 10%">S.NO</th>
                        <th class="py-2 bg-transparent text-center" style="width: 40%">Item</th>
                        <th class="py-2 bg-transparent text-center" style="width: 10%">Qty</th>
                        <th class="py-2 bg-transparent text-center" style="width: 40%">Received Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item_list as $key => $item)
                        <tr>
                            <input type="hidden" name="item_id[{{ $item->id }}]" value="{{ $item->item_id }}">
                            <input type="hidden" name="price_id[{{ $item->id }}]" value="{{ $item->item_price_id }}">
                            <input type="hidden" name="item_name[{{ $item->id }}]" value="{{ $item->getItem->item_slug }}">
                            <input type="hidden" name="item_price_name[{{ $item->id }}]" value="{{ $item->getItemPriceSize->size_slug }}">
                            <input type="hidden" name="qty[{{ $item->id }}]" value="{{ $item->qty }}">
                            <input type="hidden" name="cost_price[{{ $item->id }}]" value="{{ $item->cost_price }}">
                            <td class="py-2 bg-transparent text-center" style="width: 10%">{{ $key + 1 }}</td>
                            <td class="py-2 bg-transparent text-center" style="width: 40%">
                                {{ str_replace(' - Unit price', '', getItemNameSize($item->item_price_id)) }}
                            </td>
                            <td class="py-2 bg-transparent text-center" style="width: 10%">{{ $item->qty }}</td>
                            @if ($show == '0')
                                <td class="py-2 bg-transparent text-center" style="width: 40%">
                                    <input type="number" name="received_qty[{{ $item->id }}]" class="form-control rounded-10" required onkeyup="checkQty(this,'{{ $item->qty }}')" id="received_qty{{ $item->id }}">
                                </td>
                            @elseif($show == '2')
                                <td class="py-2 bg-transparent text-center" style="width: 10%">{{ $item->received_qty }}</td>
                            @else
                                <th class="py-2 bg-transparent text-center" style="width: 40%">Yet to receive</th>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">close</button>
            @if ($show == '0')
                <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="StockTransferApproveForm" data-target="{{ url('admin/stock-transfer/approve') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
            @endif
        </div>
    </div>
</form>

<script>
    function checkQty(inputElement, qty)
    {
        const enteredValue = parseFloat(inputElement.value);
        if (parseFloat(enteredValue) > parseFloat(qty)) {
            inputElement.value = qty;
        }
    }
</script>
