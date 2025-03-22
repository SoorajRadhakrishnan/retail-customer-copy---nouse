<!DOCTYPE html>
<html>
<head>
    <title>Expense Report</title>
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
    <h4>Expense Report</h4>
    <h4>Branch: {{ $branch_id ? getBranchById($branch_id) : "All Branch" }}</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>
    <h4>Payment Status: {{ $payment_status }}</h4>

    <table border="1"  class="table" style="width:100%">
        <thead>
            <tr>
                <th style="width: 5%">S.No</th>
                @if (!auth()->user()->branch_id)
                    <th>Branch</th>
                @endif
                <th>Expense Category Name</th>
                <th>Added From</th>
                <th>Invoice Number</th>
                <th>Description</th>
                <th>Payment Status</th>
                <th>Total Before VAT</th>
                <th>VAT Amount</th>
                <th>Final Amount</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $key => $expense)
                    <tr>
                        <td style="width: 5%">{{ $key + 1 }}</td>
                        @if (!auth()->user()->branch_id)
                            <td>{{ Str::ucfirst($expense->branch->branch_name) }}</td>
                        @endif
                        <td>{{ Str::ucfirst($expense->expense_cat_name) }}</td>
                        <td>{{ Str::ucfirst($expense->action) }}</td>
                        <td>{{ Str::ucfirst($expense->invoice_no) }}</td>
                        <td>{{ Str::ucfirst($expense->description) }}</td>
                        <td>{{ Str::ucfirst($expense->payment_status) }}</td>
                        <td>{{ showAmount($expense->total_before_vat) }}</td>
                        <td>{{ showAmount($expense->vat) }}</td>
                        <td>{{ showAmount($expense->total_amount) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
