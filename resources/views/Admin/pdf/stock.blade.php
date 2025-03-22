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
    <h4>Stock Report</h4>
    <h4>Branch: {{ $branch_id ? getBranchById($branch_id) : "All Branch" }}</h4>
    <h4>From Date: {{ $from_date }}</h4>
    <h4>To Date: {{ $to_date }}</h4>

    <h4>Item: {{ $item_id ? getItemNameSize($item_id) : '' }}</h4>
    <h4>Action Type: {{ $action_type }}</h4>

    <table border="1"  class="table" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 15%">S.No</th>
                    @if (!auth()->user()->branch_id)
                        <th>Branch</th>
                    @endif
                    <th>Date</th>
                    <th>Item</th>
                    <th>Reference</th>
                    <th>Action Type</th>
                    <th>Open Stock</th>
                    <th>Qty</th>
                    <th>Closing Stock</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $key => $value)
                        <tr>
                            <td style="width: 15%">{{ $key + 1 }}</td>
                            @if (!auth()->user()->branch_id)
                                <td>{{ Str::ucfirst(auth()->user()->branch->branch_name) }}</td>
                            @endif
                            <td>{{ dateFormat($value->date_added,1) }}</td>
                            @if ($value->item_price_id)
                                <td>{{ Str::ucfirst(getItemNameSize($value->item_price_id)) }}</td>
                            @else
                                <td></td>
                            @endif
                            {{-- <td>{{ $value->reference_no }}</td> --}}
                            <td>{{ str_replace("_"," ",$value->reference_key) }}</td>
                            <td>{{ $value->action_type }}</td>
                            <td>{{ $value->open_stock }}</td>
                            <td>{{ $value->stock_value }}</td>
                            <td>{{ $value->closing_stock }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</body>
</html>
