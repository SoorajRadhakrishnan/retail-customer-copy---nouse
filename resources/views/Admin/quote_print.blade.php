<?php
$sale_order_id = $_GET['id'];
$result = DB::table('quotations')->where('id', $sale_order_id)->first();
$branch_id = $result->branch_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();
$receipt_id = $result->quotation_no;
$ordered_date = dateFormat($result->created_at, 1);
$customer_id = $result->customer_id;
$result_arr = DB::table('quotation_items')->where('qout_id', $sale_order_id)->get();
?>

<style>
    @media print {
        body { }
        #wrapper_pr {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            color: #000;
            font-size: 12px;
        }
        .bdd {
            border-top: 1px solid #000;
        }
    }
</style>
<?php $style_print = ''; ?>
<meta charset="UTF-8" />
<div id="wrapper_pr">
    <div></div>
    <?php if($branch_details->image != ''){ ?>
    <div style="text-align: center;"><img style="text-align: center;width: 200px;"
            src="{{ url('storage/image/' . $branch_details->image) }}" alt="logo"></div>
    <?php } ?>
    <h2 style="text-transform:uppercase;font-size:13px; text-align:center;">
        <strong>{{ $branch_details->branch_name }}</strong>
    </h2>
    <p style="font-size:12px; text-align:center;line-height: 1em;">{{ $branch_details->location }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->contact_no }}</p>
    <p style="font-size:12px; text-align:center;line-height: 0.5em;">{{ $branch_details->social_media }}</p>
    <h1 style="text-align:center; font-size:22px;margin-bottom:0px;">
        QUOTATION
    </h1>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;">Receipt ID:
        <strong><?php echo $receipt_id; ?></strong>
    </p>
    <p style="font-size:12px; text-align:left;line-height: 0.5em;">Ordered Date:
        <?php echo $ordered_date; ?></p>
    <div style="clear:both;"></div>
    <table class="table" cellspacing="0" width="100%" border="0">
        <thead>
            <tr>
                <td colspan='3'>
                    <div style='border-top:1px dashed #000;padding-bottom: 3px;'></div>
                </td>
            </tr>
            <tr>
                <th style="font-size:12px;text-align:left; width:60%;">Items</th>
                <th style="font-size:12px;text-align:center; width:10%;">Qty</th>
                <th style="font-size:12px;text-align:right; width:20%;">Total</th>
            </tr>
            <tr>
                <td colspan='3'>
                    <div style='border-top:1px dashed #000;margin-top: 3px;'></div>
                </td>
            </tr>
        </thead>
        <tbody id="bg_val">
            <?php
            $total_amount = 0;
            foreach ($result_arr as $key => $res) {
                $item_name = $res->item_name;
                $qty = $res->qty;
                $total = $res->price * $qty;
                $total_amount += $total;
                $item_details = DB::table('items')->where('id', $res->item_id)->first();
                $item_other_name = $item_details ? $item_details->item_other_name : '';
                echo '<tr>';
                echo "<td style='font-size:12px; width:60%;" . $style_print . "'>" . $item_name;
                if (!empty($item_other_name)) {
                    echo "<br><small style='font-size:10px;'>" . $item_other_name . '</small>';
                }
                echo '</td>';
                echo "<td style='font-size:12px;text-align:center; width:10%;" . $style_print . "'>" . $qty . '</td>';
                echo "<td style='font-size:12px;text-align:right; width:10%;" . $style_print . "'>" . showAmount($total) . '</td>';
                echo '</tr>';
                if (!empty($res->notes)) {
                    echo '<tr>';
                    echo "<td style='font-size:12px;float:left; width:80%;" . $style_print . "'>Note: " . $res->notes . '</td>';
                    echo "<td colspan='2' style='font-size:12px;text-align:right; width:20%;" . $style_print . "'></td>";
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <table class="table" cellspacing="0" width="100%" border="0">
        <?php
        echo "<tr><td colspan='3'><div style='border-top:1px dashed #000;padding-bottom: 3px;'></div></td></tr>";
        echo "<tr>
                <td colspan='2' style='font-size:12px; " . $style_print . "'>Total :</td>
                <td style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($total_amount, 1) . "</td>
              </tr>";
        if ($result->total_discount > 0) {
            echo "<tr>
                    <td colspan='2' style='font-size:12px; " . $style_print . "'>Discount</td>
                    <td style='text-align: right;font-size:12px; " . $style_print . "'> " . showAmount($result->total_discount, 1) . "</td>
                  </tr>";
        }
        if ($result->total_vat > 0) {
            echo "<tr>
                    <td colspan='2' style='font-size:12px;" . $style_print . "'>VAT Amount :</td>
                    <td style='font-size:12px;text-align: right; " . $style_print . "'> " . showAmount($result->total_vat, 1) . "</td>
                  </tr>";
        }
        echo "<tr>
                	<td colspan='4' style='    font-size: 20px;    text-align: center;    letter-spacing: 1px;    font-weight: bolder; " .
            $style_print .
            "'>" .
            'Grand Total' .
            ': ' .
           showAmount($total_amount - $result->total_discount + $result->total_vat, 1) .
            "</td>
                	</tr>";
        ?>
    </table>
    <div style="border-top:1px dashed #000;">
        <p style="font-size:12px;text-align:center;"><?php echo 'Thank You. Visit Again!'; ?></p>
    </div>
</div>
<div id="if"></div>
