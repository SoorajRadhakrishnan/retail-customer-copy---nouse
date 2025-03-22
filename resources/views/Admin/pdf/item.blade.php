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
    <h4>Item Wise Report</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>
    <table border="1"  class="table" style="width:100%">
        <thead>
            <tr>
                <th style="width: 15%">S.No</th>
                @if (!auth()->user()->branch_id)
                    <th>Branch</th>
                @endif
                <th>Item</th>
                <th>Quantity</th>
                <th>Cost Price</th>
                <th>Gross Total</th>
                <th>Discount</th>
                <th>Net Total</th>
            </tr>
        </thead>
        <?php $total_amount = $total_without_discount = $total_discount = $total_cost_price = $total_total_qty = 0;?>
        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $key => $value)
                    <tr>
                        <td style="width: 15%">{{ $key + 1 }}</td>
                        @if (!auth()->user()->branch_id)
                            <td>{{ Str::ucfirst(auth()->user()->branch->branch_name) }}</td>
                        @endif
                        @if ($value->price_size_id)
                            <td>{{ Str::ucfirst(getItemNameSize($value->price_size_id)) }}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $value->total_qty }}</td>
                        <td>{{ showAmount($value->cost_price) }}</td>
                        <td>{{ showAmount($value->total_price) }}</td>
                        <td>{{ showAmount($value->total_price - $value->after_discount) }}</td>
                        <td>{{ showAmount($value->after_discount) }}</td>
                        <?php
                            $total_total_qty += $value->total_qty;
                            $total_cost_price += $value->cost_price;
                            $total_amount += $value->after_discount;
                            $total_discount += ($value->total_price - $value->after_discount);
                            $total_without_discount += $value->total_price;
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
                <td>{{ $total_total_qty }}</td>
                <td>{{ showAmount($total_cost_price,1) }}</td>
                <td>{{ showAmount($total_without_discount,1) }}</td>
                <td>{{ showAmount($total_discount,1) }}</td>
                <td>{{ showAmount($total_amount,1) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
