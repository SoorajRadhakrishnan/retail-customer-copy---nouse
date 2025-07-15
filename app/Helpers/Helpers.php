<?php

use App\Models\Admin\Category;
use App\Models\Admin\Customer;
use App\Models\Admin\Driver;
use App\Models\Admin\ExpenseCategory;
use App\Models\Admin\Item;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Admin\ItemPrice;
use App\Models\Admin\Supplier;
use App\Models\Branch;
use App\Models\SaleOrderPayment;
use App\Models\SettleSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

if (!function_exists('getColumnvalue')) {
    function getColumnvalue($column, $table, $where)
    {
        return collect(DB::select("SELECT $column FROM $table $where"))->first();
    }
}

if (!function_exists('showAmount')) {
    function showAmount($value, $show = null)
    {
        if ($show) {
            return app('appSettings')['currency']->value . ' ' . number_format((float)$value, app('appSettings')['decimal_point']->value, '.', ',');
        } else {
            return number_format((float)$value, app('appSettings')['decimal_point']->value, '.', ',');
        }
    }
}
if (!function_exists('formatToDecimals')) {
    function formatToDecimals($number) {
        // Convert the number to a string
        $numberStr = (string)$number;

        // Check if the number contains a decimal point
        if (strpos($numberStr, '.') !== false) {
            // Split the number into integer and fractional parts
            list($integerPart, $fractionalPart) = explode('.', $numberStr);

            // Truncate the fractional part to two digits
            $fractionalPart = substr($fractionalPart, 0, app('appSettings')['decimal_point']->value);

            // Ensure the fractional part has exactly two digits
            $fractionalPart = str_pad($fractionalPart, app('appSettings')['decimal_point']->value, '0', STR_PAD_RIGHT);

            // Combine the integer and fractional parts
            return $integerPart . '.' . $fractionalPart;
        } else {
            // If there is no decimal point, add '.00'
            return $numberStr . '.00';
        }
    }
}

if (!function_exists('getUserPermissions')) {
    function getUserPermissions()
    {
        $values = array();
        $result =  DB::table('user_has_permissions')->where('user_id', auth()->user()->id)->get('action');
        foreach ($result as $val) {
            $values[] = $val->action;
        }
        return $values;
    }
}

if (!function_exists('checkUserPermission')) {
    function checkUserPermission($action)
    {
        $permissions = getUserPermissions();
        if (!in_array($action, $permissions)) {
            return false;
        }
        return true;
    }
}

if (!function_exists('branchList')) {
    function branchList()
    {
        return DB::table('branches')->whereNull('deleted_at')->get();
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date,$time='')
    {
        $date_format = app('appSettings')['date_format']->value;
        if($time)
        {
            $time_format = app('appSettings')['time_format']->value;
            return date($date_format." ".$time_format, strtotime($date));
        }
        $date_format = app('appSettings')['date_format']->value;
        return date($date_format, strtotime($date));
    }
}

if (!function_exists('categoryList')) {
    function categoryList($branch_id = null)
    {
        return Category::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
        })->get();
    }
}

if (!function_exists('itemList')) {
    function itemList($branch_id = null)
    {
        return DB::table('items')
                    ->leftJoin('branches', function ($join) {
                        $join->on('branches.id', '=', 'items.branch_id');
                    })->when($branch_id, function ($query,$branch_id) {
                        $query->where('items.branch_id',$branch_id);
                    })->whereNull('items.deleted_at')
                    ->select(DB::raw('items.*,branch_name'))->get();
    }
}

if (!function_exists('unitList')) {
    function unitList($branch_id)
    {
        return DB::table('units')->where('branch_id', $branch_id)->whereNull('deleted_at')->get();
    }
}

if (!function_exists('expenseCatList')) {
    function expenseCatList($branch_id = null)
    {
        // return DB::table('expense_categories')->where('branch_id', $branch_id)->whereNull('deleted_at')->get();
        return ExpenseCategory::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
            })->get();
    }
}

if (!function_exists('generateBarcode')) {
    function generateBarcode()
    {
        return rand(100000, 999999);
    }
}

if (!function_exists('getPriceSize')) {
    function getPriceSize($branch_id)
    {
        // Fetch records where branch_id matches and deleted_at is null
        $priceSizes = DB::table('price_size')
            ->where('branch_id', $branch_id)
            ->whereNull('deleted_at')
            ->get();

        // Map the results to check for "Unit price" in size_name and replace it with a blank space
        $priceSizes = $priceSizes->map(function ($item) {
            if ($item->size_name === 'Unit price') {
                $item->size_name = ''; // Replace "Unit price" with blank space
            }
            return $item;
        });

        return $priceSizes;
    }
}

if (!function_exists('is_array_empty')) {
    function is_array_empty($arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                if (!empty($value) || $value != NULL || $value != "") {
                    return true;
                    break; //stop the process we have seen that at least 1 of the array has value so its not empty
                }
            }
            return false;
        }
    }
}

if (!function_exists('isNumberArray')) {
    function isNumberArray($array)
    {
        foreach ($array as $val) {
            if (!is_numeric($val) || $val == NULL) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('checkMultiplePrice')) {
    function checkMultiplePrice($arr)
    {
        if (is_array($arr)) {
            $count = 0;
            foreach ($arr as $key => $value) {
                if (!empty($value) || $value != NULL || $value != "") {
                    $count++;
                }
            }
            return $count;
        }
    }
}

if (!function_exists('getItemPricebyId')) {
    function getItemPricebyId($item_id, $price_size_id)
    {
        $query = DB::table('item_prices')->where('item_id', $item_id)->where('price_size_id', $price_size_id)->whereNull('deleted_at')->first();
        if (!is_null($query)) {
            return $query->price;
        }
    }
}

if (!function_exists('getItembarcodebyId')) {
    function getItembarcodebyId($item_id, $price_size_id)
    {
        $query = DB::table('item_prices')->where('item_id', $item_id)->where('price_size_id', $price_size_id)->whereNull('deleted_at')->first();
        if (!is_null($query)) {
            return $query->barcode;
        }
    }
}

if (!function_exists('getSessionBranch')) {
    function getSessionBranch()
    {
        // return $_SESSION['branch_id'];
        return session()->get('branch_id');
        // return Session::get('branch_id');
    }
}

if (!function_exists('setSessionBranch')) {
    function setSessionBranch($value)
    {
        // $_SESSION['branch_id'] = $value;
        session(['branch_id' => $value]);
        session()->save();
        // Session::put('branch_id',$value);
    }
}

if (!function_exists('clearSessionBranch')) {
    function clearSessionBranch()
    {
        Session::flush('branch_id');
    }
}
if (!function_exists('getbranchid')) {
    function getbranchid()
    {
        if (auth()->user()->branch_id) {
            return auth()->user()->branch_id;
        } elseif (session()->get('branch_id')) {
            return session()->get('branch_id');
        } else {
            return false;
        }
        // return (auth()->user()->branch_id || session()->get('branch_id') ? session()->get('branch_id') )
    }
}

if (!function_exists('PaymentList')) {
    function PaymentList($branch_id=null)
    {
        return DB::table('payment_methods')->when($branch_id, function ($query,$branch_id) {
                                                $query->where('branch_id',$branch_id);
                                            })
                                            ->whereNull('deleted_at')
                                            ->get(['payment_method_slug','payment_method_name','id']);
    }
}

if (!function_exists('getPriceName')) {
    function getPriceName($branch_id, $priceid)
    {
        return DB::table('price_size')->where('branch_id', $branch_id)->where('id', $priceid)->whereNull('deleted_at')->first('size_name')->size_name;
    }
}

if (!function_exists('getVat')) {
    function getVat($branch_id)
    {
        return DB::table('branches')->where('id', $branch_id)->whereNull('deleted_at')->first();
    }
}
if (!function_exists('getNextReceiptId')) {
    function getNextReceiptId()
    {
        $user_id = auth()->user()->id;
        $branch_id = auth()->user()->branch_id;
        $receipt_id = getVat($branch_id)->prefix_inv . '-' . $branch_id . '-' . $user_id . '-';
        $query = DB::table('sale_orders')->where('shop_id', $branch_id)->where('user_id', $user_id)
        ->WhereNotNull('receipt_id')->whereNull('deleted_at')->latest()->take(1)->first('receipt_id');
        if ($query !== null) {
            $str = $query->receipt_id;
            $receipt_id_arr = explode('-', $str);
            $nextID = $receipt_id_arr[3] + 1;
            return $receipt_id . $nextID;
        } else {
            return $receipt_id . '1';
        }
    }
}
if (!function_exists('getNextQuotationId')) {
    function getNextQuotationId() {
        $user_id = auth()->user()->id;
        $branch_id = auth()->user()->branch_id;
        $prefix = 'Q00';
        $quotation_id = $prefix . '-' . $branch_id . '-' . $user_id . '-';
        $query = DB::table('quotations')
            ->where('branch_id', $branch_id)
            // ->where('created_by', $user_id) // Remove this line if 'created_by' does not exist
            ->whereNotNull('quotation_no')
            ->whereNull('deleted_at')
            ->orderByDesc('created_at')
            ->first('quotation_no');
        if ($query !== null && isset($query->quotation_no)) {
            $str = $query->quotation_no;
            $quotation_id_arr = explode('-', $str);
            $nextID = isset($quotation_id_arr[3]) ? ((int)$quotation_id_arr[3] + 1) : 1;
            return $quotation_id . $nextID;
        } else {
            return $quotation_id . '1';
        }
    }
}
if(!function_exists('currentItemPriceDetails'))
{
    function currentItemPriceDetails($price_size_id)
    {
        return DB::table('item_prices')->where('id', $price_size_id)->whereNull('deleted_at')->first();
    }
}

if(!function_exists('currentItemDetails'))
{
    function currentItemDetails($item_id)
    {
        return DB::table('items')->where('id', $item_id)->first();
    }
}

if(!function_exists('getStaff'))
{
    function getStaff($staff_id)
    {
        return DB::table('staff')->where('id', $staff_id)->first();
    }
}

if(!function_exists('getCategory'))
{
    function getCategory($cat_id)
    {
        return DB::table('categories')->where('id', $cat_id)->first();
    }
}

if(!function_exists('getItem'))
{
    function getItem($item_id)
    {
        return DB::table('items')->where('id', $item_id)->whereNull('deleted_at')->first();
    }
}

if(!function_exists('getPriceSizeName'))
{
    function getPriceSizeName($item_id)
    {
        return DB::table('price_size')->where('id', $item_id)->first();
    }
}

if(!function_exists('getUser'))
{
    function getUser($user_id)
    {
        return DB::table('users')->where('id', $user_id)->whereNull('deleted_at')->first();
    }
}

if(!function_exists('getCustomer'))
{
    function getCustomer($customer_id)
    {
        return DB::table('customers')->where('id', $customer_id)->whereNull('deleted_at')->first();
    }
}

if (!function_exists('getItemNameSize')) {
    function getItemNameSize($size_id) {
        $result = DB::table('item_prices')->where('id', $size_id)->first();

        // Check if $result is null
        if ($result === null) {
            return 'Item not found'; // or any appropriate default message
        }

        // Fetch item details
        $itemDetails = currentItemDetails($result->item_id);

        // Check if itemDetails is null
        if ($itemDetails === null) {
            return 'Item not found'; // or any appropriate default message
        }

        // Fetch size details
        $sizeDetails = getPriceSizeName($result->price_size_id);

        // Check if sizeDetails is null
        if ($sizeDetails === null) {
            return 'Size not found'; // or any appropriate default message
        }

        if ($sizeDetails->size_name === 'Unit price') {
            $sizeDetails->size_name = '';
        }

        // Return the item name along with the size_name (if it's not empty)
        return $itemDetails->item_name
            . ($sizeDetails->size_name ? " - " . $sizeDetails->size_name : '');
    }
}

if (!function_exists('expenseCatByID')) {
    function expenseCatByID($id)
    {
        return DB::table('expense_categories')->where('id', $id)->whereNull('deleted_at')->first();
    }
}

if(!function_exists('getCustomerall'))
{
    function getCustomerall($branch_id = null)
    {
        return Customer::when($branch_id, function ($query,$branch_id) {
                $query->where('branch_id',$branch_id);
            })->whereNull('deleted_at')->get();
    }
}

if(!function_exists('getDriverall'))
{
    function getDriverall($branch_id = null)
    {
        return Driver::when($branch_id, function ($query,$branch_id) {
                $query->where('branch_id',$branch_id);
            })->get();
    }
}

if(!function_exists('getReceiptID'))
{
    function getReceiptID($sale_id)
    {
        return DB::table('sale_orders')->where('id', $sale_id)->whereNull('deleted_at')->first(['receipt_id'])->receipt_id;
    }
}

if(!function_exists('getLastsettledate'))
{
    function getLastsettledate($branch_id = null)
    {
        if(!$branch_id){
            return null;
        }
        return DB::table('settle_sale')->where('shop_id', $branch_id)->whereNull('deleted_at')->orderBy('id','desc')->first(['settle_date']);
    }
}

if(!function_exists('getPaybackqty'))
{
    function getPaybackqty($qty,$sale_order_item_id)
    {
        $payBackQty =  DB::table('pay_back')->where('sale_order_item_id', $sale_order_item_id)->sum('qty');
        if($payBackQty != null)
        {
            $qty = $qty - $payBackQty;
        }
        return $qty;
    }
}

if (!function_exists('getAllItem')) {
    function getAllItem($branch_id = null, $item_type = null)
    {
        return ItemPrice::leftJoin('items', function ($join) {
            $join->on('item_prices.item_id', '=', 'items.id');
        })
        ->leftJoin('price_size', function ($join) {
            $join->on('price_size.id', '=', 'item_prices.price_size_id');
        })
        ->when($branch_id, function ($query, $branch_id) {
            $query->where('items.branch_id', $branch_id);
        })
        ->when($item_type, function ($query, $item_type) {
            $query->where('item_prices.price_item_type', $item_type); // Adjust this line to your actual item type column
        })
        ->whereNull('items.deleted_at')
        ->whereNull('item_prices.deleted_at')
        ->select(DB::raw('item_prices.id as price_id, items.item_name, items.id as item_id, price_size.size_name'))
        ->get();
}

}

if (!function_exists('getPaidSaleAmount')) {
    function getPaidSaleAmount($sale_id)
    {
        return SaleOrderPayment::where('sale_order_id',$sale_id)
        ->select(DB::raw('sum(amount) as amount'))
        ->first();
    }
}

if (!function_exists('getSupplier')) {
    function getSupplier($branch_id)
    {
        return Supplier::where('branch_id',$branch_id)->get();
    }
}

if (!function_exists('supplierByID')) {
    function supplierByID($id)
    {
        return Supplier::where('id',$id)->first();
    }
}

if (!function_exists('getSuppliers')) {
    function getSuppliers($branch_id = null)
    {
        return Supplier::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
            })->get();
    }
}

if(!function_exists('getDriverByID'))
{
    function getDriverByID($driver_id)
    {
        // DB::enableQueryLog();
        return DB::table('drivers')->where('id', $driver_id)->first();
        // dd(DB::getQueryLog());
    }
}

if(!function_exists('getPaymentByID'))
{
    function getPaymentByID($id,$payment_type)
    {
        // DB::enableQueryLog();
        return SaleOrderPayment::where('sale_order_id', $id)->where('payment_type',$payment_type)->first();
        // dd(DB::getQueryLog());
    }
}

if (!function_exists('getCustomerDetById')) {
    function getCustomerDetById($customer_id)
    {
        $result =  DB::table('customers')->where('id',$customer_id)->first();
        return Str::ucfirst($result->customer_name) . " (".$result->customer_number ." )";
    }
}


if (!function_exists('getSettleDateLastbf')) {
    function getSettleDateLastbf($settle_id)
    {
        $settle_id = $settle_id - 1;
        if(!$settle_id){
            return date("1970-01-01 00:00:00");
        }

        return SettleSale::where('id',$settle_id)->first()->settle_date;
    }
}

if (!function_exists('getBranchById')) {
    function getBranchById($branch_id)
    {
        $result = DB::table('branches')->where('id', $branch_id)->first();
        return Str::ucfirst($result->branch_name);
    }
}

if (!function_exists('getSupplierById')) {
    function getSupplierById($id)
    {
        $result =  Supplier::where('id',$id)->first();
        return Str::ucfirst($result->supplier_name) . " (".$result->supplier_company_name ." )";
    }
}

if (!function_exists('getUnitByItemId')) {
    function getUnitByItemId($item_id)
    {
        $unit_id =  DB::table('items')->where('id', $item_id)->first();
        if($unit_id !==  null){
            return DB::table('units')->where('id', $unit_id->unit_id)->first()->unit_name;
        }
        return 'No unit';
    }
}

    // Helper function to get item name
if (!function_exists('getItemName')) {
    function getItemName($itemId) {
        $item = Item::find($itemId);
        return $item ? $item->name : 'Unknown';
    }
}

    // Helper function to get user name
if (!function_exists('getUserName')) {
    function getUserName($userId) {
        $user = User::find($userId);
        return $user ? $user->name : 'Unknown';
    }
}

if (!function_exists('getCurrentStock')) {
    function getCurrentStock($priceId) {
        $price = ItemPrice::find($priceId);
        return $price ? $price->stock : 0;
    }
}

if (!function_exists('getPaymentOpeningBalance')) {
    function getPaymentOpeningBalance($paymentType, $branchId) {
        return PaymentTranscation::where('payment_type', $paymentType)
            ->where('status', 'open_balance')
            ->where('type', 'add')
            ->where('branch_id', $branchId)
            ->value('amount');
    }
  
  
if (!function_exists('getSalePaymentType')) {
    function getSalePaymentType($saleId) {
        $saleOrderPayments = SaleOrderPayment::where('sale_order_id', $saleId)->get();
        if ($saleOrderPayments->count() === 1) {
            return $saleOrderPayments->first()->payment_type;
        }

        return null;
    }
}
}
