<style>
    table {
        border-collapse: collapse; /* Ensures there is no spacing between table cells */
        width: 100%;
    }

    table, th, td {
        border: 1px solid black; /* Adds a 1px solid black border to the table, headers, and cells */
    }

    th, td {
        padding: 8px; /* Adds padding inside each cell */
        text-align: left; /* Aligns text to the left */
    }
</style>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Credit Statement</h5>
    <h5 class="modal-title text-uppercase text-center w-100">Customer : {{ getCustomerDetById($credit_sale) }}</h5>
</div>
<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <input type="hidden" name="item_count" class="item_count" value="">
        <table border="1"  class="table" style="width:100%">
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
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td class="py-2 bg-transparent text-center">{{ showAmount($totalcredit) }}</td>
                    <td class="py-2 bg-transparent text-center">{{ showAmount($totalDebit) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Balance</td>
                    <td class="py-2 bg-transparent text-center" colspan="2"><b>{{ showAmount($totalcredit - $totalDebit,1) }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

