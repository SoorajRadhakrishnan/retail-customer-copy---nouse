<?php

$branch_id = $shop_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();

$from_date = getSettleDateLastbf($settle_sale->id);
if($from_date == "1970-01-01 00:00:00")
{
    $from_date = '';
}else{
    $from_date = $from_date .' - ';
}
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
<?php $style_print = 'font-family: Arial';
?>

<div id="wrapper_pr" style="border: 1px solid #000;padding:1px;">
    <meta charset="UTF-8" />
    <div style="border: 1px solid #000;margin-bottom:1px;padding-bottom:25px;">
        <div style="text-align: center;"><img style="text-align: center;width: 200px;"
                src="{{ url('storage/image/' . $branch_details->image) }}"></div>
        <h2 style="text-transform:uppercase;font-size:13px; text-align:center;line-height: 0.5em;$style_print">
            <strong>{{ $branch_details->branch_name }}</strong>
        </h2>
        <p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print">{{ $branch_details->location }}</p>
        <p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print">{{ $branch_details->contact_no }}
        </p>
        <p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print">{{ $branch_details->social_media }}
        </p>



    </div>
    <table class="table" cellspacing="0" border="1" style="border-collapse: collapse;width: 100%;">
        <thead>

            <tr>
                <th
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    Date</th>
                <th
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo $from_date . $settle_sale->settle_date ; ?></th>
            </tr>

            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CASH AT STARTING'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->cash_at_starting); ?></td>
            </tr>

            <?php $payment_types_amount = $settle_sale->multi_payment_types_amount;?>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    TOTAL CASH SALE </td>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->cash_sale, 0); ?>
                </td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    TOTAL CARD SALE </td>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->card_sale, 0); ?>
                </td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    TOTAL CREDIT SALE </td>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->credit_sale, 0); ?>
                </td>
            </tr>

            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CREDIT RECOVERY'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->credit_recover); ?></td>
            </tr>
            @if (app('appSettings')['delivery_sale']->value == 'yes')
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'DELIVERY SALE'; ?>
                    </td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale->delivery_sale); ?></td>
                </tr>
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'DELIVERY RECOVERY'; ?>
                    </td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale->delivery_recover); ?></td>
                </tr>
            @endif
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'PAYBACK'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->pay_back); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'PAYBACK VAT'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->pay_back_vat); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'EXPENSE'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->expense); ?></td>
            </tr>
            @if (getVat($branch_id)->vat != 'no_vat')
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'SALE VAT'; ?></td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale->gross_total_tax); ?></td>
                </tr>
            @endif
            <tr>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CASH DRAWER'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->cash_drawer); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'GROSS TOTAL'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->gross_total); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'DISCOUNT'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->discount); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'NET TOTAL'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale->net_total); ?></td>
            </tr>

        </thead>
    </table>
</div>
