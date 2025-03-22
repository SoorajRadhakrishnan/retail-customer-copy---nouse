<?php

$branch_id = auth()->user()->branch_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();

$receipt_id = $_GET['receipt_id'];
$result = DB::table('sale_orders')->where('receipt_id', $receipt_id)->first();
$sale_order_id = $result->id;
$receipt_id = $result->receipt_id;
$order_type = $result->order_type;
$ordered_date = dateFormat($result->ordered_date, 1);
$token = explode(",",$_GET['token']);
$payback = DB::table('pay_back')->whereIn('id', $token)->whereNull('deleted_at')->get();
?>
<style>
    @media print {
        body {
            font-family: Arial;
        }

        #wrapper_pr {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            color: #000;
            font-family: Arial;
            font-size: 12px;
        }

        .bdd {
            border-top: 1px solid #000;
        }
    }
</style>
<?php $style_print = 'font-family: Arial'; ?>
<div id="wrapper_pr">
    <meta charset="UTF-8" />
    <?php if($branch_details->image != ''){ ?>
    <div style="text-align: center;"><img style="text-align: center;width: 200px;"
            src="{{ url('storage/image/' . $branch_details->image) }}"></div>
    <?php } ?>
    <h2 style="text-transform:uppercase;font-size:13px; text-align:center;">
        <strong>{{ $branch_details->branch_name }}</strong>
    </h2>
    <p style="font-size:12px; text-align:center;line-height: 1em;">{{ $branch_details->location }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->contact_no }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->social_media }}</p>

    <p style="font-size:12px; text-align:center;line-height: 0.5em;font-size:22px;$style_print">Pay Back</p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">DATE: <span><?php echo $ordered_date; ?><span></p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">ORDER TYPE: <strong>
        <?php echo ucfirst(str_replace('_', ' ', $order_type)); ?></strong></p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">RECEIPT NO.: <span><?php echo $receipt_id; ?><span></p>
    <div style="clear:both;"></div>
    <table class="table" cellspacing="0" width="100%" border="0">
        <thead>
            <tr>
                <th style="font-size:11px;text-align:left; width:70%;$style_print"><?php echo 'ITEMS'; ?></th>
                <th style="font-size:11px;text-align:center; width:5%;$style_print"><?php echo 'QTY'; ?></th>
                <th style="font-size:11px;text-align:right; width:15%;$style_print"><?php echo 'PRICE'; ?></th>
            </tr>
        </thead>
        <tbody id="bg_val">
            <?php
            $total_amount = $tax_amount = '0';
            $gst_group = [];
            foreach ($payback as $key => $res) {
                $item_id = $res->qty;
                $item_id = $res->item_id;
                $sale_order_item_id = $res->sale_order_item_id;
                $item_price_id = DB::table('sale_order_items')->where("id",$sale_order_item_id)->first()->price_size_id;
                $item_name = getItemNameSize($item_price_id);
                $price = $res->amount;
                $payment_type = $res->payment_type;
                echo '<tr>';
                echo "<td style='font-size:12px; width:80%;$style_print'>" . $item_name . '</td>';
                echo "<td style='font-size:12px;text-align:center; width:3%;$style_print'>" . $res->qty . '</td>';
                echo "<td style='font-size:12px;text-align:right; width:8%;$style_print'>" . showAmount($price * $res->qty) . '</td>';
                echo '</tr>';
                $multiplle_val = $price * $res->qty;
                $total_amount += $multiplle_val;
                $tax_amount = $res->tax_amt * $res->qty;
            }
            echo "<tr><td colspan='4'><div style='border-top:1px solid #000;padding:5px 0px;'></div></td></tr>";
            if ($branch_details->vat != 'no_vat') {
                echo "<tr>
                    <td colspan='2' style='font-size:12px; width:40%;$style_print'>SUB TOTAL: </td>
                    <td colspan='2' style='font-size:12px;text-align: right; width:60%;$style_print'>".showAmount($total_amount).'</td>
                    </tr>';
                echo "<tr>
                    <td colspan='2' style='font-size:12px; width:40%;$style_print'>VAT AMOUNT:</td>
                    <td colspan='2' style='text-align: right;font-size:12px; width:60%;$style_print'>".showAmount($tax_amount).'</td>
                    </tr>';
            }

            if($branch_details->vat == 'exclusive'){
                $total_amount = $total_amount + $tax_amount;
            }

            echo "<tr><td colspan='2' style='font-size:12px; width:60%;$style_print'>GRAND TOTAL: </td><td colspan='2' style='font-size:12px;text-align: right; width:40%;$style_print'> " . showAmount($total_amount) . '</td></tr>';

            ?>

        </tbody>
    </table>
    <div style="border-top:1px solid #000;">
        {{-- <p style="font-size:12px;text-align:center;"><?php //echo BILL_FOOTER;
        ?></p> --}}
    </div>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">RETURN PAYMENT TYPE: <span>{{ $payment_type }}<span></p>
</div>
