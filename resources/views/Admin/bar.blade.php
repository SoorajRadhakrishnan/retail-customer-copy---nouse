<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Barcodes</title>
    <style>
        @page {
            size: 1.5in 1in;
            margin: 0;
        }

        .label {
            width: 1.5in;
            height: 1in;
            display: inline-block;
            /* border: 1px solid #000; */
            box-sizing: border-box;
            text-align: center;
            font-size: 8px;
            /* Adjust font size as needed */
            margin: 0;
            padding: 2px;
        }

        /* .label .name {
            text-align: center;
        }

        .label .barcode {
            text-align: left;
        }

        .label #price {
            text-align: left;
        } */

        .barcode {
            /* margin-top: 5px; */
        }
    </style>
</head>

<body>
    @foreach ($items as $item)
        <div class="label">
            <div class="name"> {{ $item['name'] }} </div>
            <div class="barcode"> {!! $item['barcode_html'] !!} </div>
            <div>
                <span class="barcode"> {{ showAmount($item['price'], 1) }} </span>
            </div>
            <div id="price"> {{ $item['barcode'] }} </div>
        </div>
    @endforeach
    {{-- <button onclick="window.print()">Print Barcodes</button> --}}
</body>

</html>
