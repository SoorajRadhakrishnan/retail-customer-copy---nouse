<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 8px;
        text-align: center;
    }
</style>

<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Supplier Statement for {{ $supplier_name }}</h5>
</div>

<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <input type="hidden" name="item_count" class="item_count" value="">
        <table id="example" class="table table-custom example" style="width: 100%;">
            <thead>
                <tr>
                    <th class="py-2 bg-transparent">S.NO</th>
                    <th class="py-2 bg-transparent">Date</th>
                    <th class="py-2 bg-transparent">Invoice No.</th>
                    <th class="py-2 bg-transparent">Payment Status</th>
                    <th class="py-2 bg-transparent">Payment Method</th>
                    <th class="py-2 bg-transparent">Debit ({{ app('appSettings')['currency']->value }})</th>
                    <th class="py-2 bg-transparent">Credit ({{ app('appSettings')['currency']->value }})</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalCredit = $totalDebit = 0; ?>
                @foreach ($credit_list as $key => $item)
                    <tr>
                        <td class="py-2">{{ $key + 1 }}</td>
                        <td class="py-2">{{ dateFormat($item->payment_created_at, 1) }}</td>
                        <td class="py-2">{{ $item->invoice_no }}</td>
                        <td class="py-2">{{ $item->payment_status }}</td>
                        <td class="py-2">{{ $item->payment_method }}</td>
                        <td class="py-2">
                            {{ showAmount($item->paid_amount) }}
                            <?php $totalDebit += $item->paid_amount; ?>
                        </td>
                        <td class="py-2">
                            {{ showAmount($item->total_amount - $item->paid_amount) }}
                            <?php $totalCredit += $item->total_amount - $item->paid_amount; ?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="font-weight-bold">Total</td>
                    <td class="py-2">{{ showAmount($totalDebit) }}</td>
                    <td class="py-2 bg-transparent text-center">{{ $item->total_amount}}</td>
                </tr>
                <tr>
                    <td colspan="5" class="font-weight-bold">Balance</td>
                    <td class="py-2 bg-transparent text-center" colspan="2">
                        <b>{{ $item->balance_amount }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php $url = url("admin/purchase-pay-log/$supplier_name"); ?>
    {{-- <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Close</button>
        <a href="javascript:void(0)" class="btn btn-dark px-4 text-uppercase rounded-10 modalClose" onclick="printit('{{ sha1(time()) }}', '{{ $url }}');"><i class="fa fa-print"></i></a>
    </div>
</div> --}}

<div id="if"></div>

<script>
    $('.example').dataTable({
        "language": {
            "emptyTable": "No Data found"
        }
    });
</script>
