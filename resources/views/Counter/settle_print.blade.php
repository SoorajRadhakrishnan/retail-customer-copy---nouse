<?php


// $inputs['shop_id'] = $_SESSION[SESSION_PREFIX . 'shop_id'];
// $inputs['user_id'] = $_SESSION[SESSION_PREFIX . 'user_id'];
// $inputs['discount_type'] = 'amount';
// $inputs['to_date'] = date('Y-m-d H:i:s');
// $inputs['to_receipe'] = date('Y-m-d');
// $settle_sale = getAllSettle($inputs);
// // echo '<pre>';print_r($inputs);die;
// $set = isset($_GET['set']) && $_GET['set'] != '' ? $_GET['set'] : '';
// $chev = isset($_GET['chev']) && $_GET['chev'] != '' ? $_GET['chev'] : '';
// $insert_id = isset($_GET['insert_id']) && $_GET['insert_id'] != '' ? $_GET['insert_id'] : '';
// $account_id = isset($_GET['account_id']) && $_GET['account_id'] != '' ? $_GET['account_id'] : '';
// $account_price = isset($_GET['account_price']) && $_GET['account_price'] != '' ? $_GET['account_price'] : '';
// $settle_bal_amt = isset($_GET['settle_bal_amt']) && $_GET['settle_bal_amt'] != '' ? $_GET['settle_bal_amt'] : '';
// $redirect = 'settle_sale.php';
// ////echo '<pre>';print_r($sale_orders);

// if ($settle_sale['cod_pending'] == true && $set == 'yes') {
//     echo "<script>alert('COD items still pending. So cant able to settle');</script>";
//     // redirect($redirect);
//     redirect('cod_log.php');
//     exit();
// }

// //print_r($settle_sale);
// if ($settle_sale['hold_pending'] == true && $set == 'yes') {
//     echo "<script>alert('Hold items still pending. So cant able to settle');</script>";
//     // redirect($redirect);
//     redirect('counter_sale.php');
//     exit();
// }
$branch_id = auth()->user()->branch_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();

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
                    <?php echo date('Y-m-d H:i:s'); ?></th>
            </tr>

            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CASH AT STARTING'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['cash_at_starting']); ?></td>
            </tr>

            <?php $payment_types_amount = $settle_sale['multi_payment_types_amount'];
           if(count($payment_types_amount)!=0){
            foreach ($payment_types_amount as $pay_value) { ?>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    TOTAL {{ Str::upper($pay_value['payment_type']) }} SALE </td>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($pay_value['amount'], 0); ?>
                </td>
            </tr>
            <?php }} ?>

            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CREDIT RECOVERY'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['credit_recover']); ?></td>
            </tr>
            @if (app('appSettings')['delivery_sale']->value == 'yes')
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'DELIVERY SALE'; ?>
                    </td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale['delivery_sale']); ?></td>
                </tr>
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'DELIVERY RECOVERY'; ?>
                    </td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale['delivery_recover']); ?></td>
                </tr>
            @endif
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'PAYBACK'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['pay_back']); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'PAYBACK VAT'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['pay_back_vat']); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'EXPENSE'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['expense']); ?></td>
            </tr>
            @if (getVat($branch_id)->vat != 'no_vat')
                <tr>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                        <?php echo 'SALE VAT'; ?></td>
                    <td
                        style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                        <?php echo showAmount($settle_sale['gross_total_tax']); ?></td>
                </tr>
            @endif
            <tr>

                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'CASH DRAWER'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['cash_drawer']); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'GROSS TOTAL'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['gross_total']); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'DISCOUNT'; ?></td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['discount']); ?></td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">
                    <?php echo 'NET TOTAL'; ?>
                </td>
                <td
                    style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_print;padding-right: 6px;">
                    <?php echo showAmount($settle_sale['net_total']); ?></td>
            </tr>

        </thead>
    </table>
</div>

<?php
// $settle_sale['settle_date'] = date('Y-m-d H:i:s');
// $settle_sale['shop_id'] = $_SESSION[SESSION_PREFIX . 'shop_id'];
// $settle_sale['user_id'] = $_SESSION[SESSION_PREFIX . 'user_id'];
// $settle_sale['discount_type'] = 'amount';
// $settle_sale['account_id'] = $account_id;
// $settle_sale['settle_bal_amt'] = $settle_bal_amt;
// $settle_sale['account_price'] = $account_price;
// $settle_sale['insert_id'] = $insert_id;
// $settle_sale['to_date'] = date('Y-m-d H:i:s');
// $settle_sale['to_receipe'] = date('Y-m-d');
// $settle_sale['settle_sale_values'] = $settle_sale;
// $settle_sale['chev'] = $chev;
// $settle_sale['staff_id'] = isset($_GET['staff_id']) && $_GET['staff_id'] != '' ? $_GET['staff_id'] : '';
// // echo 1; die;
// if ($set == 'yes') {
//     $settle_sale = setSettleSale($settle_sale);
//     //exit;
//     if ($settle_sale) {
//         redirect($redirect);
//     }
// } else {
//     //exit;
//     redirect($redirect);
// }
?>
