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
    <h4>Staff Wise Report</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>
    <table border="1"  class="table" style="width:100%">
    <thead>
        <tr>
            <th style="width: 5%">S.No</th>
            @if (!auth()->user()->branch_id)
                <th>Branch</th>
            @endif
            <th>Receipt ID</th>
            <th>Date</th>
            <th>Customer</th>
            @if (app('appSettings')['staff_pin']->value == 'yes')
                <th>Staff</th>
            @endif
            <th>Payment Type</th>
            <th>Gross Total</th>
            <th>Discount</th>
            <th>Net Total</th>
        </tr>
    </thead>
    <?php $total_amount = $total_without_discount = $total_discount = 0; ?>
    <tbody>
        @if (count($data) > 0)
            @foreach ($data as $key => $value)
                <tr>
                    <td style="width: 5%">{{ $key + 1 }}</td>
                    @if (!auth()->user()->branch_id)
                        <td>{{ Str::ucfirst(auth()->user()->branch->branch_name) }}</td>
                    @endif
                    <td>{{ $value->receipt_id }}</td>
                    <td>{{ dateFormat($value->ordered_date, 1) }}</td>
                    <td>{{ Str::ucfirst($value->customer_name) }}</td>
                    @if (app('appSettings')['staff_pin']->value == 'yes')
                        @if ($value->staff_id)
                            <td>{{ getStaff($value->staff_id)->staff_name }}</td>
                        @else
                            <td></td>
                        @endif
                    @endif
                    <td>{{ Str::ucfirst($value->payment_type) }}</td>
                    <td>{{ showAmount($value->with_tax + $value->discount) }}</td>
                    <td>{{ showAmount($value->discount) }}</td>
                    <td>{{ showAmount($value->with_tax) }}</td>
                    <?php
                    $total_amount += $value->with_tax;
                    $total_discount += $value->discount;
                    $total_without_discount += $value->with_tax + $value->discount;
                    ?>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td style="width: 15%"></td>
            @if (!auth()->user()->branch_id)
                <td></td>
            @endif
            <td></td>
            <td></td>
            @if (app('appSettings')['staff_pin']->value == 'yes')
                <td></td>
            @endif
            <td></td>
            <td></td>
            <td>{{ showAmount($total_without_discount, 1) }}</td>
            <td>{{ showAmount($total_discount, 1) }}</td>
            <td>{{ showAmount($total_amount, 1) }}</td>
        </tr>
    </tfoot>
</table>
</body>
</html>
