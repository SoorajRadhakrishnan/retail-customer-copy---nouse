<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Credit Statement</h5>
</div>
<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <input type="hidden" name="item_count" class="item_count" value="">
        <table id="example" class="table table-custom example">
            <thead>
                <tr>
                    <th class="py-2 bg-transparent text-center">S.NO</th>
                    <th class="py-2 bg-transparent text-center">Date</th>
                    <th class="py-2 bg-transparent text-center">Receipt No.</th>
                    <th class="py-2 bg-transparent text-center">Payment Type</th>
                    <th class="py-2 bg-transparent text-center">Credit ({{ app('appSettings')['currency']->value }})</th>
                    <th class="py-2 bg-transparent text-center">Debit ({{ app('appSettings')['currency']->value }})</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalcredit = $totalDebit  = 0;?>
                @foreach ($credit_list as $key => $item)
                    <tr>
                        <td class="py-2 bg-transparent text-center">{{ ($key+1) }}</td>
                        <td class="py-2 bg-transparent text-center">{{ dateFormat($item->paid_date,1) }}</td>
                        <td class="py-2 bg-transparent text-center">
                            @if ($item->sale_order_id)
                                {{ getReceiptID($item->sale_order_id) }}
                            @endif
                        </td>
                        <td class="py-2 bg-transparent text-center">{{ optional($item)->payment_type }}</td>
                        <td class="py-2 bg-transparent text-center">
                            @if ($item->type == 'credit')
                                {{ showAmount($item->amount) }}
                                <?php $totalcredit += $item->amount;?>
                            @else
                                {{ showAmount(0) }}
                            @endif
                        </td>
                        <td class="py-2 bg-transparent text-center">
                            @if ($item->type == 'debit')
                                {{ showAmount($item->amount) }}
                                <?php $totalDebit += $item->amount;?>
                            @else
                                {{ showAmount(0) }}
                            @endif
                        </td>
                    </tr>
                    <?php


                    ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold">Total</td>
                    <td class="py-2 bg-transparent text-center">{{ showAmount($totalcredit) }}</td>
                    <td class="py-2 bg-transparent text-center">{{ showAmount($totalDebit) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold">Balance</td>
                    <td class="py-2 bg-transparent text-center" colspan="2"><b>{{ showAmount($totalcredit - $totalDebit,1) }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php $url = url("credit-sale/$customer_id"); ?>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
            data-dismiss="modal">close</button>
        <a href="javascript:void(0)" class="btn btn-dark px-4 text-uppercase rounded-10 modalClose" onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i class="fa fa-print"></i></a>
    </div>
</div>
<div id="if"></div>
<script>
    $('.example').dataTable({
        "language": {
            "emptyTable": "No Data found"
        }
    });
</script>
