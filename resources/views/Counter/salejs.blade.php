<script>
    var branchvat = $('#branchvat').val();

    $(document).on('click', '.item-click', function() {
        var id = $(this).data('id');
        var price_size_id = $(this).data('price_size_id');
        var item_name = $(this).data('item_name');
        var item_other_name = $(this).data('item_other_name');
        var category_id = $(this).data('category_id');
        var item_stock = $(this).data('item_stock');
        var tax = $('#branchvat').val();//$(this).data('tax');
        var tax_percent = $('#js_branch_vat').val();//$(this).data('tax_percent');
        var unit_id = $(this).data('unit_id');
        var item_price_cost_price = $(this).data('item_price_cost_price');
        var price = showAmt($(this).data('price'));
        var stock_applicable = $(this).data('stock_applicable');
        var price_id = $(this).data('price_id');
        var stock_check = "{{ app('appSettings')['stock_check']->value }}";
        var item_type = $(this).data('item_type');
        var delivery_service = $('#delivery_service').val();
        if (tax_percent == '') {
            tax_percent = 0;
        }
        if (item_stock <= 0 && stock_check == 'yes' && stock_applicable == '1') {
            notifyme2("No Stock");
            return false;
        } else {
            var value = {
                id: id,
                price_size_id: price_size_id,
                item_name: item_name,
                item_other_name: item_other_name,
                category_id: category_id,
                item_stock: item_stock,
                tax: tax,
                tax_percent: tax_percent,
                unit_id: unit_id,
                item_price_cost_price: item_price_cost_price,
                price: price,
                stock_applicable: stock_applicable,
                stock_check: stock_check,
                price_id: price_id,
                item_type: item_type
            }
            product_add(value);
        }
    });

    $('#barcodeSearch').on('change', function(e) {
        if ($("#barcodeSearch").val().length > 0) {
            var barcode_id = $("#barcodeSearch").val();//alert(barcode_id);
            var barcode_id_numeric = barcode_id;
            var order_type = $('#order_type').val();
            var delivery_service = $('#delivery_service').val();
            var url = "{{ url('item-search') }}";
            if(order_type == 'delivery'){
                url = "{{ url('barcode-search') }}?type="+order_type+"&service="+delivery_service;
            }
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'barcode=' + barcode_id,
                dataType: "JSON",
                success: function(data) {
                    let results = JSON.parse(JSON.stringify(data));//console.log(results);
                    if(results.data.length > 0){
                        results.data.forEach(item => {
                            var stock_check = "{{ app('appSettings')['stock_check']->value }}";
                            var tax_percent = $('#js_branch_vat').val();//item.tax_percent;
                            if (tax_percent == '') {
                                tax_percent = 0;
                            }
                            if (item.item_stock <= 0 && stock_check == 'yes' && item.stock_applicable == '1') {
                                notifyme2("No Stock");
                                $('#barcodeSearch').val('');
                                return false;
                            } else {
                                var value = {
                                    id: item.id,
                                    price_size_id: item.price_size_id,
                                    item_name: item.item_name,
                                    item_other_name: item.item_other_name,
                                    category_id: item.category_id,
                                    item_stock: item.item_stock,
                                    tax: item.tax,
                                    tax_percent: tax_percent,
                                    unit_id: item.unit_id,
                                    item_price_cost_price: item.item_price_cost_price,
                                    price: item.price,
                                    stock_applicable: item.stock_applicable,
                                    stock_check: item.stock_check,
                                    price_id: item.price_id,
                                    item_type: item.item_type
                                }
                                product_add(value);
                            }
                            $('#barcodeSearch').val('');
                            focustoid("barcodeSearch");
                        });
                    }else{
                        notifyme2("Please Enter Correct Barcode");
                        $('#barcodeSearch').val('');
                        focustoid("barcodeSearch");
                    }
                }
            });
        }
    });

    // function product_add(id, name, unit_price, item_stock, tax_percentage, stock_applicable)
    function product_add(value) {
        var js_branch_vat = $('#js_branch_vat').val();
        var qty = "1";
        var stock_check = "{{ app('appSettings')['stock_check']->value }}";

        itemList = $(".item_list tr").length;
        for (var i = 1; i < itemList; i++) {
            var prod_id = $("tr:nth-child(" + i + ") td:nth-child(1) input#price_id").val();
            var qty_plus = $("tr:nth-child(" + i + ") td:nth-child(2) input").val();
            var old_qty = $("tr:nth-child(" + i + ") td:nth-child(1) input#old_qty").val();

            var item_stock1 = value.item_stock;
            if (old_qty != undefined) {
                item_stock1 = parseFloat(item_stock) + parseFloat(old_qty);
            }

            if (prod_id == value.price_id && qty > 0) {
                if (value.stock_applicable == 1) {
                    if (parseFloat(qty_plus) < parseFloat(item_stock1) || stock_check == 'no') {
                        $("tr:nth-child(" + i + ") td:nth-child(2) input").val((parseInt(qty_plus) + 1));
                        sb_total();
                        return true;
                    } else {
                        notifyme2("No Stock");
                        return false;
                    }
                } else {
                    $("tr:nth-child(" + i + ") td:nth-child(2) input").val((parseInt(qty_plus) + 1));
                    sb_total();
                    return true;
                }
            } else {
                if (qty < 0) {
                    if (prod_id == value.price_id) {
                        $("tr:nth-child(" + i + ") td:nth-child(2) input").val((parseInt(qty_plus) - 1));
                        sb_total();
                        return true;
                    }
                }
            }
        }
// <input type='number' name='price_id[]' class='price_id' id='price_id'  value="` + value.price_id + `">
// <span class="d-block text-dark small unit-price">` + value.price + `</span>
// <td class="align-content-center p-0 py-1">
//                     <input type="number" class="form-control py-3 border-0 text-center pos-qty discount-percent" value="" name="discount_percent[]"  style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;">
//                 </td>

        var readonly = "{{ app('appSettings')['unit_price']->value }}"
        if(readonly == 'no')
        {
            readonly = "readonly";
        }else{
            readonly = "";
        }

        itemList = $(".item_list tr").length;

        comboStyle = '';
        if(value.item_type == 3){
            var comboUrl = "{{ url('combo-item') }}?id="+value.price_id;
            comboStyle = `<span class="text-dark discount_model dynamicPopup" style="font-size:16px;"
                            data-pop="xl" data-url="`+comboUrl+`" data-toggle="modal"
                            data-target="#dynamicPopup-xl" data-image="{{ url(config('constant.LOADING_GIF')) }}">
                            <i class="fa fa-plus"></i>
                        </span>`;
        }

        item_design = `
            <tr data-item-id="` + value.price_id + `">
                <td class="align-content-center" style="width:35%"><b>
                    ` + value.item_name + `</b>
                    ${comboStyle}
                    <span class="d-block text-dark discount_model" style="font-size:16px" onclick="discount_model('`+itemList+`')"><i class="fa fa-info-circle"></i></span>
                    <input type='hidden' name='price_id[]' class='price_id' id='price_id'  value="` + value.price_id + `">
                    <input type='hidden' name='category_id[]' class='category_id' id='category_id'  value="` + value.category_id + `">
                    <input type='hidden' name='item_id[]' class='item_id' id='item_id'  value="` + value.id + `">
                    <input type='hidden' name='item_name[]' class='item_name' value='` + value.item_name + `'>
                    <input type='hidden' name='item_price[]' id='item_price' value='` + value.price + `'>
                    <input type='hidden' name='final_item_price[]' class='final_item_price' value='` + value.price + `'>
                    <input type='hidden' name='item_stock[]' id='item_stock' value="` + value.item_stock + `">
                    <input type='hidden' name='tax_percent[]' id='tax_percent' value='` + js_branch_vat + `'>
                    <input type='hidden' name='tax_amt[]' class='tax_amt' value=''>
                    <input type='hidden' name='tax_amt_not_round[]' class='tax_amt_not_round' value=''>
                    <input type='hidden' name='stock_applicable[]' id='stock_applicable' value='` + value.stock_applicable + `'>
                    <input type='hidden' name='total_price[]' class='total_price' value=''>
                    <input type='hidden' name='sale_order_item_id[]' class='sale_order_item_id' value='0'>
                    <input type='hidden' name='item_price_cost_price[]' class='item_price_cost_price' value='` + value.item_price_cost_price + `'>
                    <input type="hidden" name="discount_percent[]" class="discount-percent"  value="0">
                    <input type="hidden" name="discount_amount[]" class="discount-amount" value="0">
                    <input type="hidden" name="notes[]" class="notes" value="">
                    <input type="hidden" name="item_discount[]" class="item_discount" value="">
                    <input type="hidden" name="item_type[]" class="item_type" value="` + value.item_type + `">
                    <div class="ingredients"></div>
                </td>
                <td class="align-content-center p-0 py-1" style="width:15%">
                    <div class="input-group input-group-sm shadow rounded-10"
                        style="width: 80px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-dark minH0 reduce_btn" type="button"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                        <input type="number"
                            class="form-control py-3 border-0 text-center pos-qty qty"
                            value="` + qty + `" name="qty[]" style="padding:0px">
                        <div class="input-group-append">
                            <button class="btn btn-dark minH0 increase_btn" type="button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </td>
                <td class="align-content-center p-0 py-1" style="width:15%">
                    <input type="number" class="form-control py-3 border-0 text-center pos-qty unit-price"
                    value="`+ value.price +`" name="unit-price[]"  style="width:80%;margin:0px 10px;border:2px solid #3b4863 !important;border-radius:10px;padding:0px" onfocus="this.select()" `+ readonly +`>
                </td>
                <td class="text-right align-content-center row_total" style="width:35%;font-weight:600">` + value.price * qty + `</td>
 <td>
                                                            <button class="btn  remove-row-btn"><i class="fa fa-trash"></i></button>
                                                        </td>
            </tr>`;
        $("#item_append").append(item_design);
        sb_total();
        document.getElementById('scroll_list_item').scrollIntoView(true);
    }

    $(document).on('click', '.reduce_btn', function(e) {
        $('.reduce_btn').focus();
        row_index = $(this).closest('tr').index();
        var qty_minus = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(2) input").val();
        var currentVal = parseInt(qty_minus) - 1;
        if (currentVal != 0) {
            $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(2) input").val(currentVal);
            sb_total();
        } else {
            if (confirm("Are you sure want to remove?")) {
                $(this).closest('tr').remove();
                sb_total();
            }
        }
    });

    //Plus button
    $(document).on('click', '.increase_btn', function(e) {
        $('.increase_btn').focus();
        row_index = $(this).closest('tr').index();
        var item_stock = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input#item_stock").val();
        var qty_plus = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(2) input").val();
        var stock_applicable = $(this).closest('tr').find('#stock_applicable').val();
        var stock_check = "{{ app('appSettings')['stock_check']->value }}";
        var currentVal = parseInt(qty_plus) + 1;

        if (currentVal != 0) {
            if (stock_applicable == 1) {
                if (parseFloat(qty_plus) < parseFloat(item_stock) || stock_check == 'no') {
                    $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(2) input").val(currentVal);
                    sb_total();
                } else {
                    notifyme2("No Stock");
                    return false;
                }
            } else {
                $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(2) input").val(currentVal);
                sb_total();
            }
        }
    });
  $(document).on('click', '.remove-row-btn', function() {
    // Remove the closest table row
    $(this).closest('tr').remove();

    // Optionally, recalculate totals or perform other actions after row removal
    sb_total(); // Call your function to update totals if necessary
});


    // Quantity Key up function
    $(document).on('change paste keyup', 'input.qty', function() {
        var isvalid = $.isNumeric($(this).val());
        var row_index = $(this).closest('tr').index();
        var quantity = $(this).val();
        var stock_applicable = $(this).closest('tr').find('#stock_applicable').val();
        var stock_check = "{{ app('appSettings')['stock_check']->value }}";
        var item_stock = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input#item_stock").val();
        if (stock_applicable == 1) {
            if (parseFloat(quantity) > parseFloat(item_stock) && stock_check == 'yes') {
                notifyme2("No Stock");
                $(this).val(item_stock);
                sb_total();
                return false;
            }
        }
        if (!isvalid) {
            $(this).val(1);
        }
        sb_total();
    });

    // Discount % Key up function
    $(document).on('blur', 'input.discount_model_percent', function() {
        row_index = $(".item_count").val();
        // $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(3) input").val('');
        $("tr:nth-child(" + row_index + ") td:nth-child(1) input.discount-amount").val('');
        $('.discount_model_amount').val('');
        $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) input.discount-percent").val($(this).val());
        // var unit_price = $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) input#item_price").val();
        // $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) .unit-price").text(unit_price);
        // $("tr:nth-child(" + (row_index ) + ") td:nth-child(3) .unit-price").val(unit_price);
        // $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) .final_item_price").val(unit_price);
        var discount_percent_near = $(this).val();
        discount_percent_near = !isNaN(discount_percent_near) ? discount_percent_near : 0;

        var allow_discount_per = 100; //ALLOW_DISCOUNT_PERCENTAGE
        if (parseFloat(allow_discount_per) < parseFloat(discount_percent_near)) {
            alert('Discount Allow To Enter ' + allow_discount_per + '% Only!');
            isvalid_val = allow_discount_per;
            $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) input.discount-percent").val(isvalid_val);
            $(this).val(isvalid_val);
        }
        sb_total();
    });

    // Discount Amount Key up function
    $(document).on('blur', 'input.discount_model_amount', function() {
        // row_index = $(this).closest('tr').index();
        row_index = $(".item_count").val();
        $("tr:nth-child(" + (row_index) + ") td:nth-child(1) input.discount-percent").val('');
        $('.discount_model_percent').val('');
        $("tr:nth-child(" + (row_index ) + ") td:nth-child(1) input.discount-amount").val($(this).val());
        // var unit_price = $("tr:nth-child(" + (row_index) + ") td:nth-child(6) input.item_unit_price").val();
        var unit_price = $("tr:nth-child(" + (row_index) + ") td:nth-child(1) input#item_price").val();
        // $("tr:nth-child(" + (row_index) + ") td:nth-child(1) .unit-price").text(unit_price);
        // $("tr:nth-child(" + (row_index) + ") td:nth-child(1) .final_item_price").val(unit_price);
        var discount_amt_near = $(this).val();
        discount_amt_near = !isNaN(discount_amt_near) ? discount_amt_near : 0;

        var allow_discount_amt = unit_price; //ALLOW_DISCOUNT_PERCENTAGE

        if (parseFloat(allow_discount_amt) < parseFloat(discount_amt_near)) {
            alert('Discount Allow To Enter ' + allow_discount_amt + ' Only!');
            isvalid_val = allow_discount_amt;
            $("tr:nth-child(" + (row_index) + ") td:nth-child(1) input.discount-amount").val(isvalid_val);
        }
        sb_total();
    });

    // Notes Key up function
    $(document).on('change paste keyup', 'input.discount_model_notes', function() {
        row_index = $(".item_count").val();
        $("tr:nth-child(" + (row_index) + ") td:nth-child(1) input.notes").val($(this).val());
    });



    $( "#hold_frm" ).click(function() {
			$('#hold_form').val(1);
			sub_frm();
		});

		$( "#rehold_frm" ).click(function() {
			$('#hold_form').val(1);
			sub_frm();
		});

    function sb_total() {//console.trace();
        var total_price_val = 0;
        var net_tax_amt = 0;
        var net_total = 0;
        var item_total_amount = 0;
        var grand_total_show = 0;
        var tax_percentage = single_tax_amount = [];
        itemList = $(".item_list tr").length;
        var totalQty = 0;
        for (var i = 1; i < itemList; i++) {
            var qty = parseFloat($("tr:nth-child(" + i + ") td:nth-child(2) input.qty").val());
            var disc_amt = parseFloat($("tr:nth-child(" + i + ") td:nth-child(1) input.discount-amount").val());
            var disc_per = parseFloat($("tr:nth-child(" + i + ") td:nth-child(1) input.discount-percent").val());
            var unit_price = parseFloat($("tr:nth-child(" + i + ") td:nth-child(1) input#item_price").val());

            // var unit_price_for_exclusive = unit_price;
            grand_total_show += (unit_price * qty);
            disc_per = !isNaN(disc_per) ? disc_per : 0;
            disc_amt = !isNaN(disc_amt) ? disc_amt : 0;
            qty = !isNaN(qty) ? qty : 0;
            unit_price = !isNaN(unit_price) ? unit_price : 0;//alert(unit_price);
            var discount_total = disc_amt;
            if (disc_per != '' && disc_per != 0) {
                discount_total = unit_price * (parseFloat(disc_per) / 100);
            }

            item_total_amount += (parseFloat(unit_price) * parseFloat(qty));

            var tax_percent = $("tr:nth-child(" + i + ") td:nth-child(1) input#tax_percent").val();
            var branchvat = $('#branchvat').val();
            var tax_percentage = [];
            if (tax_percent != '' && typeof tax_percent != "undefined" && branchvat != 'no_vat') {
                tax_percentage = tax_percent.split(',');
            }
            item_tax_count = tax_percentage.length;
            if (discount_total != 0 && discount_total != '') {
                unit_price = parseFloat(unit_price) - parseFloat(discount_total);
                // $("tr:nth-child(" + i + ") td:nth-child(1) .unit-price").text((unit_price).toFixed(4));
                //$("tr:nth-child(" + i + ") td:nth-child(3) .unit-price").val((unit_price).toFixed(4));
                // $("tr:nth-child(" + i + ") td:nth-child(1) .final_item_price").val((unit_price).toFixed(4));
            }

            $("tr:nth-child(" + i + ") td:nth-child(1) .unit-price").text((unit_price).toFixed(2));
            // $("tr:nth-child(" + i + ") td:nth-child(3) .unit-price").val(unit_price);
            $("tr:nth-child(" + i + ") td:nth-child(1) .final_item_price").val((unit_price).toFixed(2));
            $("tr:nth-child(" + i + ") td:nth-child(1) input.item_discount").val(showAmt(discount_total));
            var tax_amount = 0;
            var unit_price_vat_withoutdiscount = 0;
            var unit_price_vat = unit_price;
            for (j = 0; j < item_tax_count; j++) {
                var tax_percen = (tax_percentage[j] != '') ? tax_percentage[j] : 0;
                if (branchvat == 'exclusive') {
                    single_tax_amount[j] = parseFloat((unit_price * tax_percen) / 100);
                    tax_amount += parseFloat((unit_price * tax_percen) / 100);
                    var unit_price_vat = parseFloat(unit_price) + parseFloat(tax_amount);
                    unit_price_vat_withoutdiscount += parseFloat(((grand_total_show) * tax_percen) / 100);
                } else if (branchvat == 'inclusive') {
                    var tot = parseFloat(100) + parseFloat(tax_percen);
                    single_tax_amount[j] = parseFloat((unit_price * tax_percen) / tot);
                    tax_amount += parseFloat((unit_price * tax_percen) / tot);
                    var unit_price_vat = unit_price;
                } else if (branchvat == 'no_vat') {
                    var unit_price_vat = unit_price;
                    tax_amount = 0;
                }
            }
            $("tr:nth-child(" + i + ") td:nth-child(1) input.tax_amt").val(showAmt(tax_amount));
            $("tr:nth-child(" + i + ") td:nth-child(1) input.tax_amt_not_round").val(tax_amount);
            net_tax_amt += parseFloat(tax_amount) * parseFloat(qty);
            var tot_amt = parseFloat(unit_price_vat) * parseFloat(qty);
            $("tr:nth-child(" + i + ") td:nth-child(4).row_total").html(showAmt(tot_amt));
            $("tr:nth-child(" + i + ") td:nth-child(1) input.total_price").val(tot_amt);
            total_price_val += parseFloat($("tr:nth-child(" + i + ") td:nth-child(4).row_total").html());
            totalQty += qty;
        }

        let enter_amount = 0;
        $('input[name="enter_amount[]"]').each(function() {
            enter_amount += parseFloat($(this).val()) || 0;
        });
        $('#item_total_amount').val(item_total_amount);
        $('#total_value').val(showAmt(total_price_val));
        if($("#discount_in_amt").val() == 0 || $("#discount_in_amt").val() == ''){
            $('.paymodel_gt').html(showAmt(total_price_val));
            $('.amount_payable').val(showAmt(total_price_val - enter_amount));
        }else{
            if(branchvat == 'exclusive'){
                $('.paymodel_gt').html(showAmt((parseFloat($('#item_total_amount').val()) + parseFloat(tax_amount)) - parseFloat($("#discount_in_amt").val())));
                $('.amount_payable').val(showAmt(((parseFloat($('#item_total_amount').val()) + parseFloat(tax_amount)) - parseFloat($("#discount_in_amt").val())) - enter_amount));
            }else{
                $('.paymodel_gt').html(showAmt($('#item_total_amount').val() - $("#discount_in_amt").val()));
                $('.amount_payable').val(showAmt(($('#item_total_amount').val() - $("#discount_in_amt").val()) - enter_amount));
            }
        }
        $('#gross_total_form').val(grand_total_show);
        $('#tax_amount_form').val(net_tax_amt);

        if($("#discount_in_amt").val() == 0 || $("#discount_in_amt").val() == ''){
            $('#net_total_form').val(total_price_val);
        }else{
            if(branchvat == 'exclusive'){
                $('#net_total_form').val((parseFloat($('#item_total_amount').val()) + parseFloat(tax_amount)) - parseFloat($("#discount_in_amt").val()));
            }else{
                $('#net_total_form').val($('#item_total_amount').val() - $("#discount_in_amt").val());
            }
        }

        if (itemList > 1) {
            $('.amountcount').css('display', 'block');
        } else {
            $('.amountcount').css('display', 'none');
        }
        $('#itemsCount').html(itemList - 1);
        $('#itemsQtyCount').html(totalQty);
        $('.total_amount_show').html(showAmt(total_price_val));
        if(branchvat == 'exclusive'){
            $('.paymodel_gt_total').html(showAmt(grand_total_show + unit_price_vat_withoutdiscount));
        }else{
            $('.paymodel_gt_total').html(showAmt(grand_total_show));
        }
    }


    $(document).on('change paste keyup', '#discount_in_percentage', function() {
        var isvalid1 = $.isNumeric($(this).val());
        var isvalid_val = $(this).val();
        // $('#amount_given_val').val('');
        // $('#amount_given_val_card').val('');
        $('.paymodel_bm').html(showAmt(0));
        $('input.discount_in_amt').val('');

        $('input.discount-percent').val(isvalid_val);
        $('input.discount-amount').val('');

        var allow_discount = 100;

        if (allow_discount < isvalid_val) {
            alert('Discount Allow To Enter ' + allow_discount + '% Only!');
            isvalid_val = allow_discount;
            $('input.discount_in_percentage').val(isvalid_val);
            $('input.discount-percent').val(isvalid_val);
        }
        sb_total();
    });

    // Discount Key up function
    $(document).on('change paste keyup', 'input.discount_in_amt', function () {
        $('input.discount_in_amt').focus();

        // Get the total amount of items
        let item_total_amount = parseFloat($('#item_total_amount').val());
        let isvalid_val = parseFloat($(this).val()) || 0; // Ensure it's a number
        let distributedTotal = 0; // Track distributed discounted total
        let discountValues = []; // Array for per-item discount amounts

        // Reset other inputs
        $('.paymodel_bm').html(showAmt(0));
        $('input.discount_in_percentage, input.discount-percent').val('');

        // Validate discount amount
        if (isvalid_val > item_total_amount) {
            alert('Discount Allow To Enter ' + item_total_amount + ' AED Only!');
            $(this).val(0);
            isvalid_val = 0;
        }

        // // Collect item prices and quantities
        // let items = [];
        // let quantities = [];
        // $('input[name="item_price[]"]').each(function (index) {
        //     let price = parseFloat($(this).val());
        //     let qty = parseFloat($(`.item_list tr:nth-child(${index + 1}) td:nth-child(2) input.qty`).val()) || 1;

        //     items.push(price);
        //     quantities.push(qty);
        // });

        // // Proportional Discount Calculation
        // for (let i = 0; i < items.length; i++) {
        //     let totalPrice = items[i] * quantities[i];
        //     let proportion = totalPrice / item_total_amount;

        //     // Calculate this item's share of the total discount
        //     let itemDiscount = isvalid_val * proportion;

        //     // Track distributed total (without rounding)
        //     distributedTotal += itemDiscount;

        //     // Divide by quantity to get per-unit discount
        //     let perUnitDiscount = itemDiscount / quantities[i];
        //     discountValues.push(perUnitDiscount); // No rounding here
        // }

        // // Adjust for rounding error on the last item
        // let roundingError = isvalid_val - distributedTotal;
        // if (Math.abs(roundingError) > 0) {
        //     let lastIndex = discountValues.length - 1;
        //     let lastQty = quantities[lastIndex];

        //     // Adjust the last item's discount per unit
        //     discountValues[lastIndex] += roundingError / lastQty;
        // }

        // // Apply the discount and update the DOM
        // $('input[name="discount_amount[]"]').each(function (index) {
        //     let finalPerUnitDiscount = discountValues[index] || 0;
        //     $(this).val((finalPerUnitDiscount)); // Apply rounding only when displaying
        // });

        // Update subtotal
        sb_total();
    });

    // Unit Price Key up function
    $(document).on('change paste keyup', 'input.unit-price', function() {
        row_index = $(this).closest('tr').index();
        $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input.discount-percent").val('');
        $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input.discount-amount").val('');

        var unit_edit_price = $(this).val();
        unit_edit_price = !isNaN(unit_edit_price) ? unit_edit_price : 0;
        $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input.final_item_price").val(unit_edit_price);

        if(unit_edit_price == 0 || unit_edit_price == '')
        {
            $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(3) input.unit-price").val('0');
            $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input.final_item_price").val('0');
            var unit_price = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input#item_price").val('0');
        }
        var unit_price = $("tr:nth-child(" + (row_index + 1) + ") td:nth-child(1) input#item_price").val(unit_edit_price);
        sb_total();
    });

    $(document).ready(function() {
        document.getElementById('customer_number').addEventListener('keyup', function() {
            $("#customer_id_form").val('');
            $("#customer_uuid_form").val('');
            $("#customer_name").val('');
            $("#customer_email").val('');
            $("#customer_address").val('');
            $("#customer_gender").val('');
            let input = this.value.toLowerCase();
            let dropdown = document.getElementById('dropdown');

            if ($(this).val() != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ url('get-ajax-customer') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'customer_number=' + $(this).val(),
                    dataType: "JSON",
                    // beforeSend: function(){
                    //     $("#customer_number").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                    // },
                    success: function(data) {
                        let results = JSON.parse(JSON.stringify(data));
                        dropdown.innerHTML = '';
                        results.data.forEach(item => {
                            let listItem = document.createElement('li');
                            listItem.textContent = item.customer_number;
                            listItem.addEventListener('click', function() {
                                // document.getElementById('customer_number').value = item.customer_number;
                                $("#customer_id_form").val(item.id);
                                $("#customer_uuid_form").val(item.uuid);
                                $("#customer_number").val(item
                                    .customer_number);
                                $("#customer_name").val(item.customer_name);
                                $("#customer_email").val(item
                                    .customer_email);
                                $("#customer_address").val(item
                                    .customer_address);
                                $("#customer_gender").val(item
                                    .customer_gender);
                                dropdown.style.display = 'none';
                            });
                            dropdown.appendChild(listItem);
                            dropdown.style.display = 'block';
                        });
                    }
                });
            }
        });
    });

    $(document).ready(function() {
    document.getElementById('ItemSearch').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let dropdown = document.getElementById('dropdownItemSearch');
        var order_type = $('#order_type').val();
        var delivery_service = $('#delivery_service').val();
        var url = "{{ url('item-search') }}";
        if(order_type == 'delivery'){
            url = "{{ url('item-search') }}?type="+order_type+"&service="+delivery_service;
        }
        if ($(this).val() != '') {
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'search=' + $(this).val(),
                dataType: "JSON",
                success: function(data) {
                    let results = JSON.parse(JSON.stringify(data)); // Ensure data is parsed
                    dropdown.innerHTML = ''; // Clear previous results

                    results.data.forEach(item => {

                        if (item.size_name === 'Unit price') {
                            item.size_name = '';
                        }

                        let listItem = document.createElement('li');
                        listItem.textContent = item.item_name + " - " + item.size_name + ' (' + item.item_stock + ')';
                        listItem.addEventListener('click', function() {
                            var stock_check = "{{ app('appSettings')['stock_check']->value }}";
                            var tax_percent = $('#js_branch_vat').val(); // Get tax percentage
                            if (tax_percent == '') {
                                tax_percent = 0;
                            }
                            if (item.item_stock <= 0 && stock_check == 'yes' && item.stock_applicable == '1') {
                                notifyme2("No Stock");
                                $('#ItemSearch').val('');
                                dropdown.style.display = 'none';
                                return false;
                            } else {
                                var value = {
                                    id: item.id,
                                    price_size_id: item.price_size_id,
                                    item_name: item.item_name,
                                    item_other_name: item.item_other_name,
                                    category_id: item.category_id,
                                    item_stock: item.item_stock,
                                    tax: item.tax,
                                    tax_percent: tax_percent,
                                    unit_id: item.unit_id,
                                    item_price_cost_price: item.item_price_cost_price,
                                    price: item.price,
                                    stock_applicable: item.stock_applicable,
                                    stock_check: item.stock_check,
                                    price_id: item.price_id,
                                    item_type: item.item_type
                                }
                                product_add(value); // Call your product add function
                            }
                            $('#ItemSearch').val(''); // Clear input after selection
                            dropdown.style.display = 'none'; // Hide dropdown
                        });

                        dropdown.appendChild(listItem); // Add list item to dropdown
                        dropdown.style.display = 'block'; // Show dropdown
                    });
                }
            });
        } else {
            dropdown.style.display = 'none'; // Hide dropdown if input is empty
        }
    });
});

    function clearInnerHTML(id) {
        let dropdown = document.getElementById(id);
        dropdown.style.display = 'none';
    }

    $('#AmountPayModel').on('hide.bs.modal', function(e) {
        $('#discount_in_percentage').val('');
        $('#discount_in_amt').val('');
        $('.enter_amount').val('');
        $('#other_payment_id').val('');
        $('#other_enter_amount').val('');
        $('#removeButton').trigger('click');
        if(! "{{ app('request')->input('customer') }}")
        {
            $("#customer_id_form").val('');
            $("#customer_uuid_form").val('');
            $("#customer_name").val('');
            $("#customer_number").val('');
            $("#customer_email").val('');
            $("#customer_address").val('');
            $("#customer_gender").val('');
        }
    })

    $('#AmountPayModel').on('show.bs.modal', function(e) {
        sb_total();
        focustoid("enter_amount1");
    });

    function remove_payment_row(a) {
        $('#payment_div_inner_' + a).remove();
        calculate_payable_amount();
    }

    $(document).on('paste keyup', 'input.enter_amount', function() {
        calculate_payable_amount();
    });

    $(document).on('click', 'input.enter_amount', function() {
        var grand_total = $('.paymodel_gt').html();
        var total_payable = 0;
        let enter_amount = 0;

        $('input[name="enter_amount[]"]').each(function() {
            enter_amount += parseFloat($(this).val()) || 0;
        });
        total_payable = parseFloat(total_payable) + parseFloat(enter_amount);
        var balance = parseFloat(grand_total) - parseFloat(total_payable);
        if (isNaN(balance)) {
            balance = 0;
        }
        if(total_payable <= 0){
            $(this).val(parseFloat((balance)).toFixed("{{ app('appSettings')['decimal_point']->value }}"));
        }else{
            old_bal_val = $(this).val();
            if (isNaN(old_bal_val)) {
                old_bal_val = 0;
            }
            if (old_bal_val == '') {
                old_bal_val = 0;
            }
            balance_val = total_payable - old_bal_val;
            balance = grand_total - balance_val;
            if(balance > 0){
                $(this).val(parseFloat((balance)).toFixed("{{ app('appSettings')['decimal_point']->value }}"));
            }
        }
        calculate_payable_amount();
    });

    function calculate_payable_amount() {
        var grand_total = $('.paymodel_gt').html();
        var total_payable = 0;
        let enter_amount = 0;

        $('input[name="enter_amount[]"]').each(function() {
            enter_amount += parseFloat($(this).val()) || 0;
        });
        total_payable = parseFloat(total_payable) + parseFloat(enter_amount);
        // $('#tpaymenbody div').each(function() {
        //     var multiple_payment_amount=parseFloat($(this).find('input.multiple_payment_amount').val());alert(multiple_payment_amount);
        //     var amount=multiple_payment_amount;
        //     if(isNaN(amount)){amount=0;}
        //     total_payable = parseFloat(total_payable) + parseFloat(amount);
        // });
        // $('#amount_given_val').val(parseFloat(total_payable).toFixed(2)); //TODO
        var balance = parseFloat(grand_total) - parseFloat(total_payable);
        if (isNaN(balance)) {
            balance = 0;
        }
        $('.paymodel_bm').html(parseFloat((balance)).toFixed("{{ app('appSettings')['decimal_point']->value }}"));
        $('.amount_payable').val(parseFloat((balance)).toFixed("{{ app('appSettings')['decimal_point']->value }}"));
        // if(total_payable>grand_total)
        // {
        //     //$('.error-dng').html('Payable amount greater than Grand total');
        //     $('.error-dng').html('');
        // }
        // else
        // {
        //     $('.error-dng').html('');
        // }
    }

    // ------ only for card click append total amount


    // $(document).on('click', 'input.enter_amount', function() {
    // 	var grand_total=$('.paymodel_gt').html();
    // 	// var index=$(this).data('index');

    // 	var total_payable=0;
    //     let enter_amount = 0;

    //     $('input[name="enter_amount[]"]').each(function() {
    //         enter_amount += parseFloat($(this).val()) || 0;
    //     });
    //     total_payable = parseFloat(total_payable) + parseFloat(enter_amount);

    //     // $('.payment_div_cover div').each(function() {
    //     // 	var multiple_payment_amount1=parseFloat($(this).find('input.multiple_payment_amount').val());
    //     // 	var amount1=multiple_payment_amount1;
    //     // 	if(isNaN(amount1)){amount1=0;}
    //     //     total_payable = parseFloat(total_payable) + parseFloat(amount1);
    //     // });
    //     // var thisEnteredAmount = $(this).val();

    //     // $(document).ready(function() {
    //         // $('input[name="enter_amount[]"]').on('keyup', function() {
    //             // let index = $('input[name="enter_amount[]"]').index(this);
    //             // let sellingPriceValue = $('select[name="payment_id[]"]').eq(index).val();
    //             // $('#output').text('Selling Price for current Amount: ' + sellingPriceValue);
    //         // });
    //     // });

    //     // if(sellingPriceValue=='card')
    //     //     {
    //     //     	// alert(multiple_payment_amount);
    //     //     	if(total_payable>0)
    //     //     	{
    //     //     		$(this).val(total_payable);
    //     //     	}
    //     //     	else
    //     //     	{
    //     //     		pay_amount=parseFloat(grand_total)-parseFloat(total_payable);
    //     //     		if(pay_amount>0){
    //     //     			$(this).val(pay_amount);
    //     //     		}
    //     //     	}
    //     //     }
    //     //     else
    //     //     {
    //     //     	$(this).val(total_payable);
    //     //     }

    // 	$('input[name="enter_amount[]"]').each(function() {

    //         let index = $('input[name="enter_amount[]"]').index(this);
    //         let sellingPriceValue = $('select[name="payment_id[]"]').eq(index).val();
    //         let enterAmount = $('input[name="enter_amount[]"]').eq(index).val();

    //     	// var multiple_payment_type =$(this).find('select#multiple_payment_type'+index).find(":selected").val();
    //     	// var multiple_payment_amount=parseFloat($(this).find('input#multiple_payment_amount'+index).val());
    //     	if(isNaN(enterAmount)){enterAmount='';}
    //         if(sellingPriceValue=='card')
    //         {
    //         	// alert(multiple_payment_amount);
    //         	if(enterAmount>0)
    //         	{
    //         		// $(this).find('input#multiple_payment_amount'+index).val(enterAmount);
    //                 $('input[name="enter_amount[]"]').eq(index).val(enterAmount);
    //         	}
    //         	else
    //         	{
    //         		pay_amount=parseFloat(grand_total)-parseFloat(total_payable);
    //         		if(pay_amount>0){
    //         			// $(this).find('input#multiple_payment_amount'+index).val(pay_amount);
    //                     $('input[name="enter_amount[]"]').eq(index).val(pay_amount);
    //         		}
    //         	}
    //         }
    //         else
    //         {
    //         	// $(this).find('input#multiple_payment_amount'+index).val(enterAmount);
    //             $('input[name="enter_amount[]"]').eq(index).val(enterAmount);
    //         }
    //     });
    //     calculate_payable_amount();
    // });

    // ------ only for card click append total amount end

    $(document).on('change', '.payment_id', function(e) {
        var type = $(this).val();
        var tot = $('.paymodel_gt').html();
        var id = $(this).find(":selected").data('id');
        var index = $(this).data('index');
        $('#pay_frm').attr('display', 'none');
        if (type == 'credit') {

            // $('.enter_amount').hide();
            $('.hidePaymentID').addClass("col-12");
            $('.hideEnterAmount').hide();
            $('.hideAddBtn').hide();
            $('#payment_id1').val('credit');
            $('#enter_amount1').val(tot);
            $('#addBtn').hide();
            $('#credit').val('yes');
            $('.payment_id').each(function() {
                var val = $(this).data('index');
                // if (val != 1) {
                removetr(val);
                // }
            });
            // $('.payment_id').css({
            //     'width': '100%',
            //     'margin-left': '0px'
            // });
            // $('.payment_div_cover').css({
            //     'width': '100%'
            // });
        } else {
            $('.hideEnterAmount').show();
            $('.hideAddBtn').show();
            $('.hidePaymentID').removeClass("col-12");
            // $('.sub_multiple_payment_type').show();
            // $('.multiple_payment_amount').show();
            // $('.enter_amount').val('');
            $('#addBtn').show();
            $('#credit').val('');

        }

    });

    $("#submit-form").click(function() {

        var sale_type = true; //$('input[name="free_sale"]').prop('checked'); //TODO:
        var multiple_payment_amount = $("input[name='multiple_payment_amount[]']").map(function() {
            return $(this).val();
        }).get();

        var grand_total = $('.paymodel_gt').html();
        var total_payable = 0;
        var enter_amount = 0;
        var total_item_amount = 0;
        $('input[name="enter_amount[]"]').each(function() { //alert($(this).val());
            enter_amount += parseFloat($(this).val()) || 0;
        });
        // $('input[name="item_price[]"]').each(function() { //TODO: into qty
        //     total_item_amount += parseFloat($(this).val()) || 0;
        // });
        const qtyInputs = document.querySelectorAll('input[name="qty[]"]');
        const priceInputs = document.querySelectorAll('input[name="item_price[]"]');
        qtyInputs.forEach((qtyInput, index) => { //TODO: into qty
            const qty = parseFloat(qtyInput.value) || 0;
            const price = parseFloat(priceInputs[index].value) || 0;
            const product = qty * price;
            total_item_amount += product;
        });

        total_payable = parseFloat(total_payable) + parseFloat(enter_amount);
        $('#amount_given_form').val(enter_amount);
        if($('#branchvat').val() == 'exclusive'){
            $('#grand_total_form').val(parseFloat(total_item_amount) + parseFloat($('#tax_amount_form').val()));
        }else{
            $('#grand_total_form').val(total_item_amount);
        }
        var order_type = $('input[name=order_type_val]:checked').val(); //TODO:OVER
        var sale_with_staff = "{{ app('appSettings')['staff_pin']->value }}";
        var pin_number = $('#pin_number').val();

        if (sale_with_staff == 'yes') {
            if (pin_number != '') {
                $.ajax({
                    url: "{{ url('staff-pin-check') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        pin_number: pin_number
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == 'success') {
                            $('#staff_id_form').val(result.id);
                            if (sale_type != 'true' && order_type == 'counter_sale') {
                                if (total_payable < grand_total) {
                                    notifyme2('Payable amount less than Grand total');
                                } else {
                                    $('#pay_bill').val('yes');
                                    sub_frm();
                                }
                            } else {
                                $('#pay_bill').val('yes');
                                sub_frm();
                            }
                        } else if (result.status == 'fail') {
                            $("#pin_number").val('');
                            notifyme2('Please Enter Correct Staff Pin');
                            $("#pin_number").focus();
                            return false;
                        }
                    }
                });
            } else {
                notifyme2('Please Enter Staff Pin!');
                $('#pin_number').focus();
            }
        } else {
            if (sale_type != 'true' && order_type == 'counter_sale') {
                if (total_payable < grand_total) {
                    notifyme2('Payable amount less than Grand total');
                } else {
                    $('#pay_bill').val('yes');
                    sub_frm();
                }
            } else {
                $('#pay_bill').val('yes');
                sub_frm();
            }
        }
    });

    function sub_frm() {
        var staff_id = '';
        $('#customer_number_form').val($('#customer_number').val());
        $('#customer_name_form').val($('#customer_name').val());
        $('#customer_email_form').val($('#customer_email').val());
        $('#customer_address_form').val($('#customer_address').val());
        $('#customer_gender_form').val($('#customer_gender').val());
        var customer_number = $('#customer_number').val();
        $('#discount_per_form').val($('#discount_in_percentage').val());
        var grand_total_form = $('#grand_total_form').val();
        if ($('#hold_form').val() == 1) {
            grand_total_form = $('#net_total_form').val();
        }
        var discount_in_amt = $('#discount_in_amt').val();
        if(discount_in_amt > 0){
            $('#discount_form').val(discount_in_amt);
        }else{
            $('#discount_form').val(grand_total_form - $('#net_total_form').val());
        }
        $('#balance_amount_form').val($('.amount_payable').val());
        // var grand_total = $('#total_value').val();
        var payment_type = '';
        var credit = $("#credit").val();

        // var payment_id = $("select[name='payment_id[]']").map(function() {
        //     return $(this).val();
        // }).get();
        var enter_amount = $("input[name='enter_amount[]']").map(function() {
            if($(this).val() != '' && $(this).val() > 0){
                return $(this).val();
            }
        }).get();
        var payment_id = $("input[name='enter_amount[]']").map(function() {
            if($(this).val() != '' && $(this).val() > 0){
                return $(this).data('method');
            }
        }).get();

        $('#payment_id_form').val(payment_id);
        $('#enter_amount_form').val(enter_amount);

        var order_type = $('input[name=order_type_val]:checked').val(); //TODO:OVER

        // if (order_type=='delivery') { //TODO:OVER
        //     var delivery_payment_type=$('#delivery_payment_type').val();
        //     var net_total=$('#net_total_form').val();
        //     $('#payment_id_form').val(delivery_payment_type);
        //     $('#payment_type_form').val(delivery_payment_type);
        //     $('#enter_amount_form').val(net_total);
        // }
        var sale_with_staff = "{{ app('appSettings')['staff_pin']->value }}";

        // var payment_id1 = $('#payment_id1').val();
        // if (payment_id1 == 'credit') {
        //     $('#payment_type_form').val('credit');
        //     var credit = 'yes';
        // }

        const paymentArray = payment_id;
        const valuesToRemove = ['cash', 'card', 'credit'];
        const filteredArray = paymentArray.filter(item => !valuesToRemove.includes(item));
        if(filteredArray.length > 0 && $('#other_payment_id').val() == ''){
            notifyme2("Please Select Payment Method");
            return false;
        }

        if (payment_id.includes('credit')) {
            var credit = 'yes';
        }

        var grand_total = $('#net_total_form').val();
        var itemList = $(".item_list tr").length;
        var staff_id = $('#staff_id_form').val();

        $('#payment_status_form').val('paid');
        if ($('#hold_form').val() == 1) {
            $('#payment_status_form').val('unpaid');
            $('#payment_type_form').val('');
            $('#status_form').val('hold');

            if (grand_total >= 0 && itemList > 1) {
                $("#submit-form").hide();
                $("#formListItem").submit();
            } else {
                notifyme2('Add Item');
                $('#hold_form').val('0');
                $('#payment_status_form').val('paid');
                $('#payment_type_form').val(payment_type);
                $('#status_form').val('pending');
            }
        } else {
            if (order_type == 'counter_sale') {
                $('#payment_status_form').val('paid');
                $('#status_form').val('pending');
                if (credit != 'yes') {
                    if (itemList > 1) {
                        if ((staff_id == '' || staff_id == 0) && sale_with_staff == 'yes') {
                            notifyme2('Please Enter Correct Staff Pin ');
                            $('#pin_number').focus();
                        } else {
                            $("#submit-form").hide();
                            $("#formListItem").submit();
                        }
                    } else {
                        notifyme2('Please Add Item');
                    }
                } else {
                    if (customer_number != '') {
                        $('#payment_type_form').val('credit');
                        if ((staff_id == '' || staff_id == 0) && sale_with_staff == 'yes') {
                            notifyme2('Please Enter Correct Staff Pin ');
                            $('#pin_number').focus();
                        } else {
                            $("#submit-form").hide();
                            $("#formListItem").submit();
                        }
                    } else {
                        notifyme2('Enter Customer Number');
                    }
                }
            } else {
                if (customer_number != '') {
                    if (grand_total >= 0 && itemList > 1) {
                        if ((staff_id == '' || staff_id == 0) && sale_with_staff == 'yes') {
                            notifyme2('Please Enter Staff Pin');
                            $('#pin_number').focus();
                        } else {
                            if ($('input[name=driver]:checked').length <= 0) {
                                notifyme2('Please Select Driver');
                            } else {
                                var driver_id = document.querySelector('input[name = "driver"]:checked').value;
                                $('#driver_id_form').val(driver_id);
                                $("#submit-form").hide();
                                $("#formListItem").submit();
                            }
                        }
                    } else {
                        notifyme2('Please Add Item');
                    }
                } else {
                    notifyme2('Enter Customer Number');
                }
            }
        }
    }


</script>
