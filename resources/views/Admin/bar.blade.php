<?php
$branch_id = auth()->user()->branch_id;
$branch_details = DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Barcodes</title>
    <style>
        @page {
        size: 2in 1.3in;
        margin: 0;
    }

    .label {
        width: 2in;
        height: 1.15in;
        display: block;
        box-sizing: border-box;
        text-align: center;
        font-size: 9px;
        margin: 0;
        padding: 2px;
        /* page-break-after: always; */
        overflow: hidden;
    }

    .barcode {
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        display: block;
        margin: 0 auto;
        width: 70%;
    }
    </style>
</head>

<body>

    @foreach ($items as $item)
        {{-- <?php if($branch_details->image != '' && file_exists(public_path('storage/image/' . $branch_details->image))) { ?>
        <div style="text-align: center; ">
            <img style="text-align: center;width: 50px;margin-top: 2px;"
                src="{{ public_path('storage/image/' . $branch_details->image) }}">
        </div>
        <?php }  ?> --}}
        <div class="label">
            <div class="name " style="font-weight: bold;margin-top: 17px;  "> {{ strtoupper($item['name']) }} </div>
            <div class="barcode"> {!! $item['barcode_html'] !!} </div>
            <div>
                <span class="barcode" style="font-size: 12px"> {{ showAmount($item['price'], 1) }} </span>
            </div>
            <div id="price" class="barcode"> {{ $item['barcode'] }} </div>
        </div>
    @endforeach
</body>

</html>
