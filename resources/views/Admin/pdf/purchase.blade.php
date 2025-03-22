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
    <h4>Purchase Report</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>
    <table border="1"  class="table" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 15%">S.No</th>
                    @if (!auth()->user()->branch_id)
                        <th>Branch</th>
                    @endif
                    <th>Supplier</th>
                    <th>Invoice Number</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>VAT Amount</th>
                    <th>Final Amount</th>
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
                            <td>{{ Str::ucfirst($purchase->supplier_name) }}</td>
                            <td>{{ Str::ucfirst($purchase->invoice_no) }}</td>
                            <td>{{ Str::ucfirst($purchase->status) }}</td>
                            <td>{{ Str::ucfirst($purchase->payment_status) }}</td>
                            <td>{{ showAmount($purchase->tax_amount) }}</td>
                            <td>{{ showAmount($purchase->total_amount) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</body>
</html>
