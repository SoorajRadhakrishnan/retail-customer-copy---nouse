<?php

$readonly = '';
if (app('appSettings')['unit_price']->value == 'no') {
    $readonly = 'readonly';
}

?>
<style>
    .disabled-row {
        opacity: 0.5;
        pointer-events: none;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Old Items</h5>
</div>

<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <div class="row">
            <table class="table table-custom mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:40%">Items</th>
                        <th style="width:15%">Qty</th>
                        <th style="width:15%">Original Qty</th>
                        <th style="width:15%">U.Price</th>
                        <th style="width:15%">Price</th>
                    </tr>
                </thead>
                <tbody id="item_body">
                    @foreach ($sale->sale_order_items as $key => $item)
                        <tr>
                            <td class="align-content-center" style="width:40%"><b>
                                    {{ $item->item_name }}</b>

                                <input type='hidden' name='price_id[]' class='price_id' id='price_id'
                                    value="{{ $item->price_size_id }}">

                                <input type='hidden' name='category_id[]' class='category_id' id='category_id'
                                    value="{{ $item->category_id }}">

                                <input type='hidden' name='item_id[]' class='item_id' id='item_id'
                                    value="{{ $item->item_id }}">

                                <input type='hidden' name='item_name[]' class='item_name'
                                    value='{{ $item->item_name }}'>

                                <input type='hidden' name='item_price[]' id='item_price' value='{{ $item->price }}'>

                                <input type='hidden' name='final_item_price[]' class='final_item_price'
                                    value='{{ $item->item_unit_price }}'>

                                <input type='hidden' name='item_stock[]' id='item_stock'
                                    value="{{ currentItemPriceDetails($item->price_size_id)->stock }}">

                                <input type='hidden' name='tax_percent[]' id='tax_percent'
                                    value='{{ getVat($sale->shop_id)->vat_percent }}'>

                                <input type='hidden' name='tax_amt[]' class='tax_amt' value='{{ $item->tax_amt }}'>

                                <input type='hidden' name='tax_amt_not_round[]' class='tax_amt_not_round'
                                    value='{{ $item->tax_amt_not_round }}'>

                                <input type='hidden' name='stock_applicable[]' id='stock_applicable'
                                    value='{{ currentItemDetails($item->item_id)->stock_applicable }}'>

                                <input type='hidden' name='total_price[]' class='total_price'
                                    value='{{ $item->total_price }}'>

                                <input type='hidden' name='sale_order_item_id[]' class='sale_order_item_id'
                                    value='{{ $item->id }}'>

                                <input type='hidden' name='item_price_cost_price[]' class='item_price_cost_price'
                                    value='{{ $item->cost_price }}'>

                                <input type="hidden" class="discount-percent" name="discount_percent[]"
                                    value="{{ $item->discount_percent }}">

                                <input type="hidden" class="discount-amount" name="discount_amount[]"
                                    value="{{ $item->discount_amount }}">

                                <input type="hidden" name="notes[]" class="notes" value="{{ $item->notes }}">

                                <input type="hidden" name="old_quantity[]" class="old_quantity"
                                    value="{{ $item->qty }}">
                                <input type="hidden" value="{{ formatToDecimals($item->item_unit_price) }}"
                                    name="unit-price[]">
                            </td>
                            <td class="align-content-center p-0 py-1" style="width:15%">
                                <div class="input-group input-group-sm shadow rounded-10" style="width: 80px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-dark minH0 old_reduce_btn" type="button"
                                            data-priceid="{{ $item->price_size_id }}">
                                            <i+ class="fa fa-minus old-items"></i+>
                                        </button>
                                    </div>
                                    <input type="number"
                                        class="form-control py-3 border-0 text-center pos-qty qty old_qty{{ $item->price_size_id }}"
                                        value="{{ $item->qty }}" name="qty[]" style="padding:0px" readonly
                                        disabled>
                                </div>
                            </td>
                            <td class="align-content-center" style="width:15%;font-weight:600">
                                {{ $item->qty }}
                            </td>
                            <td class="align-content-center" style="width:15%;font-weight:600">
                                {{ formatToDecimals($item->item_unit_price) }}
                            </td>
                            <td class="align-content-center" style="width:15%;font-weight:600">
                                {{ formatToDecimals($item->total_price) }}
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
            data-dismiss="modal">close</button>
        {{-- <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm" data-method="adminedit"
            data-form="PurchaseForm" data-target="{{ url('admin/purchase') }}" data-returnaction="reload"
            data-image="{{ url(config('constant.LOADING_GIF')) }}"
            data-processing="Please wait, saving...">Save</button> --}}
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#item_append').find('tr').remove();
    });

    $(document).on('click', '.old_reduce_btn', function () {
        let $btn = $(this);
        let priceId = $btn.data('priceid');
        let $oldRow = $btn.closest('tr');

        let qtyInput = $oldRow.find('.old_qty' + priceId);
        let newQty  = parseInt(qtyInput.val() - 1) || 0;

        let $mainRow = $('#item_append tr').filter(function () {
            return $(this).data('item-id') == priceId;
        });

        if (newQty <= 0) {
            if (confirm("Are you sure you want to remove this item?")) {
                // $oldRow.remove();
                $oldRow.addClass('disabled-row');
            } else {
                return; // stop if user cancels
            }
        }

        // Update old row quantity
        qtyInput.val(newQty);

        if ($mainRow.length > 0) {
            let unitPrice = parseFloat($oldRow.find('#item_price').val()) || 0;
            let totalPrice = (newQty * unitPrice).toFixed(2);
            let qtys = $mainRow.find('.qty').val();
            let oldQty = parseInt(qtys) || 0;
            let updateQty = oldQty - 1;
            $mainRow.find('.qty').val(updateQty);
            $mainRow.find('.unit-price').val(unitPrice);
            $mainRow.find('.row_total').text(totalPrice);
            $mainRow.find('.total_price').val(totalPrice);
        } else {
            let itemName = $oldRow.find('.item_name').val();
            let item_id = $oldRow.find('.item_id').val();
            let categoryId = $oldRow.find('.category_id').val();
            let itemPrice = parseFloat($oldRow.find('#item_price').val()).toFixed(2);
            let taxPercent = $oldRow.find('#tax_percent').val();
            let taxAmt = $oldRow.find('.tax_amt').val();
            let totalPrice = (newQty * itemPrice).toFixed(2);
            let costPrice = $oldRow.find('.item_price_cost_price').val();
            let saleOrderItemId = $oldRow.find('.sale_order_item_id').val() || 0;

            // <span class="d-block text-dark discount_model" style="font-size:16px"><i class="fa fa-info-circle"></i></span>
            let newRow = `
                <tr data-item-id="${priceId}">
                    <td class="align-content-center" style="width:35%">
                        <b>${itemName}</b>
                        <input type="hidden" name="price_id[]" class="price_id" value="${priceId}">
                        <input type="hidden" name="category_id[]" class="category_id" value="${categoryId}">
                        <input type="hidden" name="item_id[]" class="item_id" value="${item_id}">
                        <input type="hidden" name="item_name[]" class="item_name" value="${itemName}">
                        <input type="hidden" name="item_price[]" class="item_price" value="${itemPrice}">
                        <input type="hidden" name="final_item_price[]" class="final_item_price" value="${itemPrice}">
                        <input type="hidden" name="item_stock[]" class="item_stock" value="${$oldRow.find('#item_stock').val()}">
                        <input type="hidden" name="tax_percent[]" class="tax_percent" value="${taxPercent}">
                        <input type="hidden" name="tax_amt[]" class="tax_amt" value="${taxAmt}">
                        <input type="hidden" name="tax_amt_not_round[]" class="tax_amt_not_round" value="${taxAmt}">
                        <input type="hidden" name="stock_applicable[]" class="stock_applicable" value="${$oldRow.find('#stock_applicable').val()}">
                        <input type="hidden" name="total_price[]" class="total_price" value="${totalPrice}">
                        <input type="hidden" name="sale_order_item_id[]" class="sale_order_item_id" value="${saleOrderItemId}">
                        <input type="hidden" name="item_price_cost_price[]" class="item_price_cost_price" value="${costPrice}">
                        <input type="hidden" name="discount_percent[]" class="discount-percent" value="0">
                        <input type="hidden" name="discount_amount[]" class="discount-amount" value="0">
                        <input type="hidden" name="notes[]" class="notes" value="">
                        <input type="hidden" name="item_discount[]" class="item_discount" value="0.00">
                        <input type="hidden" name="item_type[]" class="item_type" value="">
                        <div class="ingredients"></div>
                    </td>
                    <td class="align-content-center p-0 py-1" style="width:15%">
                        <div class="input-group input-group-sm shadow rounded-10" style="width: 80px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-dark minH0 reduce_btn" type="button"><i class="fa fa-minus"></i></button>
                            </div>
                            <input type="number" class="form-control py-3 border-0 text-center pos-qty qty" value="-1" name="qty[]" style="padding:0px">
                            <div class="input-group-append">
                                <button class="btn btn-dark minH0 increase_btn" type="button"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </td>
                    <td class="align-content-center p-0 py-1" style="width:15%">
                        <input type="number" class="form-control py-3 border-0 text-center pos-qty unit-price" value="${itemPrice}" name="unit-price[]" style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;padding:0px" onfocus="this.select()">
                    </td>
                    <td class="text-right align-content-center row_total" style="width:35%;font-weight:600">${totalPrice}</td>
                    <td>
                        <button class="btn remove-row-btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `;

            $('#item_append').append(newRow);
        }

        sb_total();
    });
</script>
