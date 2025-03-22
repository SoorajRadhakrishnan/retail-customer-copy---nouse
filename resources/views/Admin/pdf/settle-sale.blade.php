<!DOCTYPE html>
<html>
<head>
    <title>Laravel PDF</title>
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
</head>
<body>
    <h4>Settle Sale Report</h4>
    <h4>Branch: {{ $branch_id ? getBranchById($branch_id) : "All Branch" }}</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>

    <table border="1"  class="table" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 15%">S.No</th>
                    @if (!auth()->user()->branch_id)
                        <th>Branch</th>
                    @endif
                    <th>Settle Date</th>
                    <th>Cash At Starting</th>
                    <th>Cash Sale</th>
                    <th>Card Sale</th>
                    <th>Credit Sale</th>
                    <th>Credit Recover</th>
                    <th>Delivery Sale</th>
                    <th>Delivery Recover</th>
                    <th>Payback</th>
                    <th>Payback VAT</th>
                    <th>Expense</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Sale VAT</th>
                    <th>Net Total</th>
                    <th>Cash Drawer</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $key => $purchase)
                        <tr>
                            <td style="width: 15%">{{ $key + 1 }}</td>
                            @if (!auth()->user()->branch_id)
                                <td>{{ Str::ucfirst($purchase->branch->branch_name) }}</td>
                            @endif
                            <td>{{ dateFormat($purchase->settle_date,1) }}</td>
                            <td>{{ showAmount($purchase->cash_at_starting) }}</td>
                            <td>{{ showAmount($purchase->cash_sale) }}</td>
                            <td>{{ showAmount($purchase->card_sale) }}</td>
                            <td>{{ showAmount($purchase->credit_sale) }}</td>
                            <td>{{ showAmount($purchase->credit_recover) }}</td>
                            <td>{{ showAmount($purchase->delivery_sale) }}</td>
                            <td>{{ showAmount($purchase->delivery_recover) }}</td>
                            <td>{{ showAmount($purchase->pay_back) }}</td>
                            <td>{{ showAmount($purchase->pay_back_vat) }}</td>
                            <td>{{ showAmount($purchase->expense) }}</td>
                            <td>{{ showAmount($purchase->gross_total) }}</td>
                            <td>{{ showAmount($purchase->discount) }}</td>
                            <td>{{ showAmount($purchase->gross_total_tax) }}</td>
                            <td>{{ showAmount($purchase->net_total) }}</td>
                            <td>{{ showAmount($purchase->cash_drawer) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</body>
</html>
