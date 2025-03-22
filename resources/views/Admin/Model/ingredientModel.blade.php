	<?php $branch_id = getbranchid(); ?>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Ingredient</h5>
</div>
<form id="PurchaseForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="id" value="{{ $item_price_id }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-0">
                        <label class="mb-0">Select Item</label>
                        <select class="form-control rounded-10 select2 addITem" id="items" name="items"
                            required="">
                            <option value="">Select Item</option>
                            @foreach ($items as $item)
                          <?php
                                                        if ($item->size_name === 'Unit price') {
                                                            $item->size_name = ''; // Clear size_name
                                                        }
                                                        ?>
                                <option value="{{ $item->price_id }}" 
    data-price_id="{{ $item->price_id }}" 
    data-item_id="{{ $item->item_id }}" 
    data-name="{{ $item->item_name }}" 
    data-item_size="{{ $item->size_name }}" 
    data-unit="{{ $item->unit->unit_name }}">
     {{ $item->item_name }}{{ $item->size_name ? ' - ' . $item->size_name : '' }}
</option>
 
                            @endforeach
                        </select>
                        <div class="valid-feedback">&nbsp;</div>
                        <div class="invalid-feedback">&nbsp;</div>
                    </div>
                </div>
                <table class="table table-custom" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="item_body">
                        @if ($ingredient != null)
                            @foreach ($ingredient as $key => $pur_item)
                                <tr class="tr{{ $key + 1 }}">
                                    <input type="hidden" class="price_id" name="price_id[]" value="{{ $pur_item->price_id }}">
                                    <input type="hidden" class="item_id" name="item_id[]" value="{{ $pur_item->item_id }}">
                                    <input type="hidden" class="item_name" name="item_name[]"
                                        value="{{ $pur_item->item_name }}">
                                    <input type="hidden" class="unit" name="unit[]"
                                        value="{{ $pur_item->unit }}">
                                    <td width="40%">
    {{ preg_replace('/ - (Unit price|1)$/', '', $pur_item->item_name) }}
</td>

                                    <td width="20%">{{ $pur_item->unit }}</td>
                                    <td width="30%">
                                        <input type="number" class="form-control rounded-10" placeholder="" name="qty[]"
                                            required="" autofocus="" value="{{ $pur_item->qty }}" id="qty{{ $key + 1 }}"
                                            ></td>
                                    <td width="10%">
                                        <a class="btn btn-dark rounded-10" onclick="removeRow('{{ $key + 1 }}')"><i
                                                class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="PurchaseForm" data-target="{{ url('admin/ingredient') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>

<script>
        $(document).ready(function() {
    $('#items').select2({
        theme: "bootstrap-5",
      dropdownParent: $("#PurchaseForm"),//add this code
    });
});


    $(".addITem").on("change", function() {
        var rand = Math.floor(Math.random() * 100000);
        var item = $(this).find('option:selected');
        var found = true;
        $('#item_body .price_id').each(function() {
            if ($(this).val() == item.data('price_id')) {
                found = false;
            }
        });
        if(item.val() != '' && found){
            var item_name = item.data('name');
            var item_id = item.data('item_id');
            var price_id = item.data('price_id');
            var item_size = item.data('item_size');
            var unit = item.data('unit');
            let dynamicRowHTML = `
                <tr class="tr` + rand + `">
                    <input type="hidden" class="price_id" name="price_id[]" value="` + price_id + `">
                    <input type="hidden" class="item_id" name="item_id[]" value="` + item_id + `">
                    <input type="hidden" class="item_name" name="item_name[]" value="` + item_name + " - " + item_size + `">
                    <input type="hidden" class="unit" name="unit[]" value="` + unit + `">
                    <td width="40%">` + item_name + " - " + item_size + `</td>
                    <td width="30%">` + unit + `</td>
                    <td width="30%"><input type="number" class="form-control rounded-10" placeholder="" name="qty[]" required="" autofocus="" value=""
                        id="qty` + rand + `"></td>
                    <td width="10%">
                        <a class="btn btn-dark rounded-10" onclick="removeRow('` + rand + `')"><i class="fa fa-remove"></i></a></td>
                </tr>`;
            $('#item_body').append(dynamicRowHTML);
            $('.addITem').val('');
        }
    });

    function removeRow(rand) {
        $(".tr" + rand).remove();
    }
</script>