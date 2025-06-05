<?php

    $data = [
["T-SHIRTS & POLOS", "PCS", "Triko Polo F/W - 404", "", "", 169, 42, 39],
["T-SHIRTS & POLOS", "PCS", "Classic Basic T-shirt - 404", "", "", 149, 53, 23],
["T-SHIRTS & POLOS", "PCS", "New Triko Polo - 404", "", "", 169, 77, 33],
["T-SHIRTS & POLOS", "PCS", "V POLO- 404", "", "", 269, 81, 251],
["T-SHIRTS & POLOS", "PCS", "POLO LINE - 404", "", "", 249, 75, 72],
["T-SHIRTS & POLOS", "PCS", "POLO SILK - 404", "", "", 249, 78, 12],
["T-SHIRTS & POLOS", "PCS", "POLO KINTWEAR - 404", "", "", 269, 88, 112],
["T-SHIRTS & POLOS", "PCS", "SPORT POLO - 404", "", "", 219, 53, 21],
["T-SHIRTS & POLOS", "PCS", "KINTWEAR SHIRT- 404", "", "", 279, 94, 10],
["T-SHIRTS & POLOS", "PCS", "NEW BT - 404", "", "", 179, 44, 223],
["T-SHIRTS & POLOS", "PCS", "WHITE POLO - 404", "", "", 249, 44, 0],
["JACKETS & COATS", "PCS", "Vest - 404", "", "", 399, 151, 4],
["JACKETS & COATS", "PCS", "Palto Jacket - 404", "", "", 599, 176, 2],
["JACKETS & COATS", "PCS", "Wool Jacket - 404", "", "", 499, 170, 3],
["JACKETS & COATS", "PCS", "Jacket Puffer - 404", "", "", 299, 125, 5],
["JACKETS & COATS", "PCS", "New jacket wool - 404", "", "", 369, 125, 16],
["SWEATERS & Pullover", "PCS", "V-Sweater - 404", "", "", 199, 79, 8],
["SWEATERS & Pullover", "PCS", "Triko Polo L/s - 404", "", "", 199, 78, 2],
["SWEATERS & Pullover", "PCS", "New Hoodie", "", "", 179, 74, 1],
["WOMEN LINEN", "PCS", "New F/S women - 404", "", "", 249, 74, 424],
["WOMEN LINEN", "PCS", "New women Pants - 404", "", "", 279, 83, 310],
["MEN LINEN 100%", "PCS", "LINEN SHORT WP - 404", "", "", 299, 109, 168],
["MEN LINEN 100%", "PCS", "NEW LINEN H/S - 404", "", "", 249, 89, 336],
["MEN LINEN 100%", "PCS", "NEW LINEN F/S - 404", "", "", 249, 88, 627],
["MEN LINEN 100%", "PCS", "NEW LINEN PANTS - 404", "", "", 269, 92, 506],
["MEN LINEN 100%", "PCS", "LINEN SHORTS - 404", "", "", 249, 65, 263],
["MEN LINEN 100%", "PCS", "LINEN SHORTS BIG SIZE - 404", "", "", 269, 68, 205],
["MEN LINEN 100%", "PCS", "Linen Chinese - 404", "", "", 249, 77, 511],
["SHOES & SNEAKERS", "PCS", "SUM SHOES - 404", "", "", 499, 191, 113],
["SHOES & SNEAKERS", "PCS", "OLD SHOES - 404", "", "", 199, 142, "0"],
["SERVICE", "PCS", "Tailor", "", "", 17, 0, "0"],
["SHOPPING BAG", "PCS", "Shopping Bag", "", "", 2, 0.9, "0"],
["WOMEN LINEN", "PCS", "New set women - 404", "", "", 33, "", "0"]

];

$branch_id = 2; // Replace with actual branch ID
$unit_id = 4; // Replace with actual unit ID
$item_type = 1; // Assuming item type is 1
$tax = 0; // Assuming no tax
$tax_percent = 0; // Assuming no tax percent
$minimum_qty = 0; // Assuming no minimum quantity
$stock_applicable = 1; // Assuming stock is applicable
$ingredient = 1; // Assuming no ingredient
$image = ''; // Assuming no image
$expiry_date = null; // Assuming no expiry date
$active = 1; // Assuming item is active
$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');
$deleted_at = null; // Assuming no deleted date

function generateUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function generateBarcode() {
    return sprintf('%06d', mt_rand(100000, 999999));
}

function getCategoryID($category_name) {
    switch ($category_name) {

        case 'T-SHIRTS & POLOS':
            return 11;
        case 'JACKETS & COATS':
            return 12;
        case 'SWEATERS & Pullover':
            return 13;
            case 'WOMEN LINEN':
                return 14;
        case'MEN LINEN 100%':
            return 15;
        case'SHOES & SNEAKERS':
            return 16;
        case'SERVICE':
            return 17;
        case'SHOPPING BAG':
            return 18;

        default:
            return 2; // Default category ID
    }
}

$items_sql = [];
$item_prices_sql = [];

foreach ($data as $item) {
    $uuid = generateUUID();
    $barcode = generateBarcode();
    $category_id = getCategoryID($item[0]);
    $item_name = $item[2];
    $item_other_name = $item[3];
    $item_price = 0;
    $cost_price = 0;
    $stock =  0; // Default to 0 if not provided

    $item_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item_name)));

    $items_sql[] = "INSERT INTO `items` (`uuid`, `branch_id`, `category_id`, `unit_id`, `item_name`, `item_slug`, `item_other_name`, `item_cost_price`, `item_price`, `tax`, `tax_percent`, `barcode`, `stock`, `minimum_qty`, `item_type`, `stock_applicable`, `ingredient`, `image`, `expiry_date`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$uuid', '$branch_id', '$category_id', '$unit_id', '$item_name', '$item_slug', '$item_other_name', '$item_price', '$item_price', '$tax', '$tax_percent', '$barcode', '$stock', '$minimum_qty', '$item_type', '$stock_applicable', '$ingredient', '$image', NULL, '$active', '$created_at', '$updated_at', NULL);";

    $item_prices_sql[] = "INSERT INTO `item_prices` (`branch_id`, `item_id`, `price_size_id`, `barcode`, `cost_price`, `price`, `stock`, `ingredient_added`, `price_item_type`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$branch_id', (SELECT `id` FROM `items` WHERE `uuid` = '$uuid'), 1, '$barcode', '$cost_price', '$item_price', '$stock', '0', '1', '$created_at', '$updated_at', NULL);";
}

file_put_contents('items.sql', implode("\n", $items_sql));
file_put_contents('item_prices.sql', implode("\n", $item_prices_sql));

echo "SQL statements generated successfully.";
