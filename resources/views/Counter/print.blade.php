<?php

$pay = '';
$sale_order_id = $_GET['id'];

$pay = isset($_GET['pay']) && $_GET['pay'] != '' ? $_GET['pay'] : '';
$remarks1 = isset($_GET['remark']) && $_GET['remark'] != '' ? $_GET['remark'] : '';
$deliver = isset($_GET['deliver']) && $_GET['deliver'] != '' ? $_GET['deliver'] : '';
$result = DB::table('sale_orders')->where('id', $sale_order_id)->first();
$branch_id = $result->shop_id;//auth()->user()->branch_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();
$sale_order_id = $result->id;
$user_id = $result->user_id;
// $user_name = 'test'; //getnamewhere('users', 'user_name', "where id='$user_id'");
$remarks = $result->remarks;
$discount = $result->discount;
$amount_given = $result->amount_given;
$balance = $result->balance_amount;
$receipt_id = $result->receipt_id;
$payment_type = $result->payment_type;
$order_type = $result->order_type;
$card_num = $result->card_num;
$order_type = $result->order_type;
$staff_id = $result->staff_id;

$contact_name = $result->customer_name;
$contact_number = $result->customer_number;
$customer_email = $result->customer_email;
$customer_trn = $result->customer_trn;
$address = $result->customer_address;

$gross_total = $result->without_tax;
$tax_amount = $result->tax_amount;
$net_total = $result->with_tax;

$ordered_date = dateFormat($result->ordered_date,1); //todo with time
$customer_id = $result->customer_id;
$result_arr = DB::table('sale_order_items')->where('sale_order_id', $sale_order_id)->get();
$payment_types = [];
$payment_types = DB::table('sale_order_payments')->where('sale_order_id', $sale_order_id)->get();
?>

<style>
    @media print {
        body {
            /*font-family: cursive;*/
        }

        #wrapper_pr {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            color: #000;
            /*font-family: cursive*/
            ;
            font-size: 12px;
        }

        .bdd {
            border-top: 1px solid #000;
        }
    }
</style>
<style>
    .qr-code-container {
        display: grid;
        grid-template-columns: 0.5fr 0.5fr;
        gap: 10px; /* Adds space between the QR codes */
        justify-items: center; /* Centers the QR codes horizontally */
        width: 100%; /* Ensures it uses the full width of the container */
    }

    .qr-code-item {
        text-align: center; /* Centers the text and QR code inside each item */
    }

    .qr-code-item img {
        width: 100px;
        height: auto;
    }

    .qr-label {
        font-size: 12px;
        /* margin-bottom: 1px; Adds space between the text and the QR code */
    }
</style>

<?php
// $style_print = "font-family: cursive";
$style_print = '';
?>
<meta charset="UTF-8" />
<div id="wrapper_pr">
    <div></div>
    <?php if($branch_details->image != ''){ ?>
    <div style="text-align: center;"><img style="text-align: center;width: 200px;"
            src="{{ url('storage/image/' . $branch_details->image) }}"></div>
    <?php } ?>
    {{-- <h2 style="text-transform:uppercase;font-size:13px; text-align:center;">
        <strong>{{ $branch_details->branch_name }}</strong>
    </h2> --}}
    <p style="font-size:12px; text-align:center;line-height: 1em;">{{ $branch_details->location }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->contact_no }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->social_media }}</p>



    <h1 style="text-align:center; font-size:22px;">

        <?php
        if ($branch_details->vat != 'no_vat') {
            echo 'TAX INVOICE';
        } else {
            echo 'INVOICE';
        }
        ?>
    </h1>


    {{-- <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php // echo 'User Name'; ?>:
        <strong><?php // echo ucfirst($user_name); ?></strong>
    </p> --}}
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Receipt ID'; ?>:
        <strong><?php echo $receipt_id; ?></strong>
    </p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Ordered Date'; ?>:
        <?php echo $ordered_date; ?></p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Order Type'; ?>:
        <strong><?php echo ucfirst(str_replace('_', ' ', $order_type)); ?></strong>
    </p>
    <?php if($order_type != 'delivery' && $payment_type != '') { ?>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Payment Method'; ?>:
        <strong><?php echo $payment_type; ?></strong>
    </p>
    <?php } ?>
    <?php if($contact_name) {?>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Customer Name'; ?>:
        <strong><?php echo $contact_name; ?></strong>
    </p>
    <?php } if($contact_number) {?>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Customer Number'; ?>:
        <strong><?php echo $contact_number; ?></strong>
    </p>
    <?php } if($address != '') {?>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Customer Address'; ?>:
        <strong><?php echo $address; ?></strong>
    </p>
    <?php } if($customer_trn != '') {?>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;"><?php echo 'Customer TRN'; ?>:
        <strong><?php echo $customer_trn; ?></strong>
    </p>
    <?php } ?>



    <!-- <h1 style="text-align:center; font-size:22px;">INVOICE <br> فاتورة<h1> -->
    <div style="clear:both;"></div>
    <table class="table" cellspacing="0" width="100%" border="0">
        <thead>
            <tr>
                <td colspan='3'>
                    <div style='border-top:1px dashed #000;padding-bottom: 3px;'></div>
                </td>
            </tr>
            <tr>
                <th style="font-size:12px;text-align:left; width:60%;"><?php echo 'Items'; ?></th>
                <th style="font-size:12px;text-align:center; width:10%;"><?php echo 'Qty'; ?></th>
                <!-- <th style="font-size:12px;text-align:right; width:10%;"><?php echo 'Price'; ?></th> -->
                <!-- <th style="font-size:12px;text-align:center; width:10%;"><?php echo 'Dis'; ?></th> -->
                <th style="font-size:12px;text-align:right; width:20%;"><?php echo 'Total'; ?></th>
            </tr>
            <tr>
                <td colspan='3'>
                    <div style='border-top:1px dashed #000;margin-top: 3px;'></div>
                </td>
            </tr>
        </thead>
                <tbody id="bg_val">
            <?php
            $total_amount = $tax_pecr = '0';
            $gst_group = [];

            $multi_tax = [];
            $multi_tax_name = [];
            $multi_taxable = [];

            $item_discount = 0;

            foreach ($result_arr as $key => $res) {
                $item_name = $res->item_name;
                $item_id = $res->item_id;
                $price = $res->price;
                $qty = $res->qty;
                $multiplle_val = $price * $qty;
                $total_amount += $multiplle_val;
                $item_discount += $res->item_discount * $res->qty;
                $tax_percentage = $res->tax_percentage;
                $tax_name = $res->tax_name;
                $tax_amt = $res->qty * $res->tax_amt;
                $taxable = $multiplle_val - $tax_amt;

                // Fetch item_other_name for each item inside the loop
                $item_details = DB::table('items')->where('id', $item_id)->first();
                $item_other_name = $item_details ? $item_details->item_other_name : '';

                if ($tax_percentage > 0) {
                    if (!isset($multi_tax[$tax_percentage])) {
                        $multi_tax[$tax_percentage] = 0;
                    }
                    if (!isset($multi_tax_name[$tax_percentage])) {
                        $multi_tax_name[$tax_percentage] = '';
                    }
                    if (!isset($multi_taxable[$tax_percentage])) {
                        $multi_taxable[$tax_percentage] = 0;
                    }
                    $multi_tax[$tax_percentage] += $tax_amt;
                    $multi_tax_name[$tax_percentage] = $tax_name;
                    $multi_taxable[$tax_percentage] += $taxable;
                }

                // Display the item name and item_other_name
                echo '<tr>';
                echo "<td style='font-size:12px; width:60%;" . $style_print . "'>" . $item_name;
                if (!empty($item_other_name)) {
                    echo "<br><small style='font-size:10px;'>" . $item_other_name . '</small>';
                }
                echo '</td>';
                echo "<td style='font-size:12px;text-align:center; width:10%;" . $style_print . "'>" . $qty . '</td>';
                echo "<td style='font-size:12px;text-align:right; width:10%;" . $style_print . "'>" . showAmount($multiplle_val) . '</td>';
                echo '</tr>';

                // Notes Row
                if ($res->notes != '') {
                    echo '<tr>';
                    echo "<td style='font-size:12px;float:left; width:80%;" . $style_print . "'>" . 'Note' . ': ' . $res->notes . '</td>';
                    echo "<td colspan='4' style='font-size:12px;text-align:right; width:20%;" . $style_print . "'></td>";
                    echo '</tr>';
                }
            }
            ?>
        </tbody>

    </table>
    <table class="table" cellspacing="0" width="100%" border="0">
        <?php

        echo "<tr><td colspan='4'><div style='border-top:1px dashed #000;padding-bottom: 3px;'></div></td></tr>";
        if ($branch_details->vat == 'no_vat') {
            echo "<tr>
                	<td colspan='2' style='font-size:12px; " .
                $style_print .
                "'>" .
                'Total' .
                ":</td>
                	<td colspan='2' style='font-size:12px;text-align: right; " .
                $style_print .
                "'> " .
                showAmount($total_amount, 1) .
                "</td>
                	</tr>";
        }
        // $discount = $item_discount;
        if ($discount > 0) {
            echo "<tr>
                  <td colspan='2' style='font-size:12px; " .
                $style_print .
                "'> " .
                'Discount' .
                "</td>
                  <td colspan='2' style='text-align: right;font-size:12px; " .
                $style_print .
                "'> " .
                showAmount($discount, 1) .
                "</td>
                  </tr>";
        }

        // $cash_back_tot = (($total_amount - $discount) + $tax_pecr);
        // if ($cash_back_receipt_id != '' && $cash_back_receipt_id != '0') {
        //     // $cash_back_tot = ((($total_amount - $discount) - $cash_back_tot_amount) + $tax_pecr);
        //     echo "<tr><td colspan='4' style='font-size:12px; " . $style_print . "'> " . '_EXCHANGE_BILL_AMOUNT' . " </td><td colspan='4' style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($cash_back_tot_amount, 1) . '</td></tr>';
        // }

        if ($branch_details->vat != 'no_vat') {
            echo "<tr>
                	<td colspan='2' style='font-size:12px;" .
                $style_print .
                "'>Total Before   " .
                'VAT' .
                ' :</td>';

            if ($branch_details->vat == 'inclusive') {
                echo "<td colspan='2'  style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($net_total - $tax_amount, 1) . '</td></tr>';
            } else {
                echo "<td colspan='2'  style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($net_total, 1) . '</td></tr>';
            }

            echo "<tr>
                		<td colspan='2'  style='font-size:12px; " .
                $style_print .
                "'> " .
                'VAT' .
                " Amount </td>
                		<td colspan='2'  style='text-align: right;font-size:12px;" .
                $style_print .
                "'> " .
                showAmount($tax_amount, 1) .
                "</td>
                		</tr>";

            echo "<tr>
                	<td colspan='2' style='font-size:12px;" .
                $style_print .
                "'>Total With " .
                'VAT' .
                ' :</td>';

            if ($branch_details->vat == 'inclusive') {
                echo "<td colspan='2'  style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($net_total, 1) . '</td></tr>';
            } else {
                echo "<td colspan='2'  style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($net_total + $tax_amount, 1) . '</td></tr>';
            }

            $grand_taxable = 0;
            $grand_tax = 0;
            $grand_total_with_tax = 0;

            if (sizeof($multi_tax) > 1) {
                echo "<tr>
                			<td colspan='4'>
                				<div style='font-size:12px;padding-top:10px;'>" .
                    'VAT' .
                    " BREAKEUP DETAILS</div>
                			</td>
                		</tr>";
                echo "<tr>
                			<td colspan='4'>
                				<div style='border-top:1px dashed #000;padding-bottom:3px;'></div>
                			</td>
                		</tr>";
                echo "<tr>
                        <td style='font-size:12px; text-align:left; width:25%;" .
                    $style_print .
                    "'>" .
                    'VAT' .
                    " % </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'> Taxable </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'>" .
                    'VAT' .
                    " Amt </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'> " .
                    '_TOTAL' .
                    " </td>
                		</tr>";
                echo "<tr>
                			<td colspan='4'>
                				<div style='border-top:1px dashed #000;padding:5px 0px;'></div>
                			</td>
                	</tr>";

                foreach ($multi_tax as $key => $value) {
                    $grand_taxable += $multi_taxable[$key];
                    $grand_tax += $value;
                    $grand_total_with_tax += $multi_taxable[$key] + $value;

                    echo "<tr>
                		<td style='font-size:12px; text-align:left; width:25%;" .
                        $style_print .
                        "'> " .
                        $multi_tax_name[$key] .
                        " </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                        $style_print .
                        "'> " .
                        showAmount($multi_taxable[$key]) .
                        " </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                        $style_print .
                        "'> " .
                        showAmount($value) .
                        " </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                        $style_print .
                        "'> " .
                        showAmount($multi_taxable[$key] + $value) .
                        " </td>
                		</tr>";
                }

                echo "<tr>
                			<td colspan='4'>
                				<div style='border-top:1px dashed #000;padding-bottom: 3px;'></div>
                			</td>
                	</tr>";
                echo "<tr>
                		<td style='font-size:12px; text-align:left; width:25%;" .
                    $style_print .
                    "'></td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'> " .
                    showAmount($grand_taxable) .
                    " </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'> " .
                    showAmount($grand_tax) .
                    " </td>
                		<td style='font-size:12px; text-align:right; width:25%;" .
                    $style_print .
                    "'> " .
                    showAmount($grand_total_with_tax) .
                    " </td>
                		</tr>";
                echo "<tr>
                			<td colspan='4'>
                				<div style='border-top:1px dashed #000;margin-top: 3px;'></div>
                			</td>
                	</tr>";
            }
        }
        if ($order_type == 'free_sale') {
            $net_total = 0;
        }
        echo "<tr>
                	<td colspan='4' style='    font-size: 20px;    text-align: center;    letter-spacing: 1px;    font-weight: bolder; " .
            $style_print .
            "'>" .
            'Grand Total' .
            ': ' .
            showAmount($net_total, 1) .
            "</td>
                	</tr>";
        $given_amount = 0;
        if (count($payment_types) != 0) {
            echo "<tr><td colspan='2' style='font-size:12px; $style_print'>Payment type</td>
                	<td colspan='2' style='font-size:12px;text-align: right;$style_print'></td></tr>";
            foreach ($payment_types as $pay_value) {
                $given_amount += $pay_value->real_amount;
                echo "<tr><td colspan='2' style='font-size:12px; $style_print'>" .
                    $pay_value->payment_type .
                    '  (' .
                    $pay_value->currency .
                    ") :</td>
                		<td colspan='2' style='font-size:12px;text-align: right;$style_print'>" .
                    showAmount($pay_value->amount) .
                    '</td></tr>';
            }
        } // else {
        // 	if($payment_type) {
        // 		echo "<tr><td colspan='2' style='font-size:12px; $style_print'>Payment Type :</td>
        // 	<td colspan='2' style='font-size:12px;text-align: right;$style_print'>".$payment_type."</td></tr>";
        // 	}
        // }
        if ($given_amount > 0 && $payment_type != 'credit') {
            echo "<tr>
                			<td colspan='4'>
                				<div style='border-top:1px dashed #000;padding-bottom: 3px;'></div>
                			</td>
                	</tr>";
            $bal = $given_amount - $net_total;
            echo "<tr><td colspan='2' style='font-size:12px; $style_print'>Balance Amount:</td>
                	<td colspan='2' style='font-size:12px;text-align: right;$style_print'>" .
                showAmount($bal, 1) .
                '</td></tr>';
        }

        // if($pay == 'given' && ($cash > 0 || $card > 0) ) {
        // 	echo "<tr>
        // 			<td colspan='4'>
        // 				<div style='border-top:1px dashed #000;padding:5px 0px;'></div>
        // 			</td>
        // 	</tr>";
        // 	echo "<tr>
        // 	<td colspan='2' style='font-size:12px; ".$style_print."'>"._AMOUNT_GIVEN_CASH.": </td>
        // 	<td colspan='2' style='text-align: right;font-size:12px;".$style_print."';> ".showAmount($cash,1)."</td>
        // 	</tr>";
        // 	echo "<tr>
        // 	<td colspan='2' style='font-size:12px; ".$style_print."'>"._AMOUNT_GIVEN_CARD.": </td>
        // 	<td colspan='2' style='text-align: right;font-size:12px; ".$style_print."';> ".showAmount($card,1)."</td>
        // 	</tr>";
        // 	echo "<tr>
        // 	<td colspan='2' style='font-size:12px;".$style_print."'>"._BALANCE.": </td>
        // 	<td colspan='2' style='font-size:12px;text-align: right; ".$style_print."'> ".showAmount($amount_given-$net_total,1)."</td>
        // 	</tr>";

        // }

        ?>

        </tbody>
    </table>
    <div style="border-top:1px dashed #000;">

        @if ($staff_id)
            <p style="font-size:12px;text-align:left;">Staff: {{ optional(getStaff($staff_id))->staff_name }} </p>
        @endif
    <p style="font-size:12px;text-align:center;"><?php echo 'Thank You. Visit Again!'; ?>!</p>
             {{-- <p style="font-size:12px;text-align:center;">Exchange the items within 5 days of receiving your order.<br>استبدال المنتجات خلال 5 أيام من استلام طلبك..</p>
                  <p style="font-size:12px;text-align:center;">Refunds are not available .<br>لا تتوفر إمكانية استرداد المبالغ المدفوعة..</p>
 --}}

        {{-- <p style="font-size:12px;text-align:center;"><strong style="text-align: center;">--- Powered By Overseepos.com --}}
                {{-- ---</strong></p> --}}


                {{-- <div class="qr-code-item" > <!-- Spanning full row -->
                    <div class="qr-label">Instagram</div>
                    <img src="{{ url('assets/icons/instagram.jpg') }}" alt="Instagram QR Code">
                </div> --}}

                {{-- <p style="font-size:12px;text-align:center;"><strong style="text-align: center;">--- Powered By Overseepos.com --}}
                        {{-- ---</strong></p> --}}
            {{-- </div> --}}

    </div>
</div>
<div id="if"></div>
