<?php

use App\Http\Controllers\Admin\AdminExpenseController;
use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\PurchasePayController;
use Illuminate\Support\Facades\Route;

//auth
use App\Http\Controllers\Auth\UserController;

// Super Admin
use App\Http\Controllers\SuperAdmin\SettingsController;
use App\Http\Controllers\SuperAdmin\BranchController;
use App\Http\Controllers\SuperAdmin\PaymentMethodController;
use App\Http\Controllers\SuperAdmin\PriceSizeController;

// Admin
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\ItemStockController;
use App\Http\Controllers\Admin\WastageUsageController;
use App\Http\Controllers\Admin\PaymentTransferController;


use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SaleOrdersController;
use App\Http\Controllers\Admin\StockAddController;
use App\Http\Controllers\Admin\StockTransferController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Counter\CreditSaleController;
use App\Http\Controllers\Counter\CrmController;
use App\Http\Controllers\Counter\DeliverySaleController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LoyalityController;
use App\Http\Controllers\Admin\QuotationController;

// Counter
use App\Http\Controllers\Counter\SaleController;
use App\Http\Controllers\Counter\ExpenseController;
use App\Http\Controllers\Counter\OpenCashController;
use App\Http\Controllers\Counter\OpenDrawer;
use App\Http\Controllers\Counter\PayBackController;
use App\Http\Controllers\Counter\RecentSaleController;
use App\Http\Controllers\Counter\SettleSaleController;
use App\Http\Controllers\Counter\CounterQuotationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Route::get('login', [UserController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::get('logout', [UserController::class, 'logout'])->middleware('auth');

// Super Admin
Route::group(['middleware' => ['auth', 'superadmin']], function () {

    Route::get('settings', [SettingsController::class, 'index']);
    Route::get('software-settings', [SettingsController::class, 'softwaresettingview']);
    Route::post('software-settings', [SettingsController::class, 'storesoftwaresetting']);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::resource('price-size', PriceSizeController::class);
    Route::resource('branch', BranchController::class);
    Route::get('users', [SettingsController::class, 'users_list'])->name('user');
    Route::get('user-permission/{user:uuid?}', [SettingsController::class, 'user_permission']);
    Route::post('store-user-permission', [SettingsController::class, 'store_user_and_permission']);
    Route::post('delete-user', [UserController::class, 'destroy']);
});

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    // helper
    Route::get('set-shop', [DashboardController::class, 'setBranch']);

    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('dashboard2', [DashboardController::class, 'index2']);
Route::get('quotation/print', [QuotationController::class, 'printquote']);
    // Password Change
    Route::post('change-password', [UserController::class, 'changePassword']);

    // master
    Route::resource('category', CategoryController::class);
    Route::resource('item', ItemsController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('expense-category', ExpenseCategoryController::class);
    Route::resource('ingredient', IngredientController::class);
    Route::resource('production', ProductionController::class);
    Route::resource('barcode-print', BarcodeController::class);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::resource('loyalty', LoyalityController::class);
    Route::resource('offers', OfferController::class);

    // Transcation
    Route::resource('stock', ItemStockController::class);
    Route::resource('sale-order', SaleOrdersController::class);
    Route::post('sale-order/change-payment', [SaleOrdersController::class, 'changePaymentType']);
    Route::resource('expense', AdminExpenseController::class)->names([
        'index' => 'admin.expense.index',
        'create' => 'admin.expense.create',
        'store' => 'admin.expense.store',
        'show' => 'admin.expense.show',
        'edit' => 'admin.expense.edit',
        'update' => 'admin.expense.update',
        'destroy' => 'admin.expense.destroy',
    ]);
    Route::resource('purchase', PurchaseController::class);
    Route::post('change-purchase-status', [PurchaseController::class, 'change_purchase_status']);

    Route::resource('stock-transfer', StockTransferController::class);
    Route::resource('payment-transfer', PaymentTransferController::class);
    Route::post('stock-transfer/approve', [StockTransferController::class, 'approveTransfer']);

    Route::post('updatePaymentStatus', [PurchaseController::class, 'updatePaymentStatus'])->name('admin.purchases.updatePaymentStatus');
    Route::post('purchase-pay-amount', [PurchaseController::class, 'purchasePay'])->name('admin.purchases.purchasePayAmount');
    Route::post('purchasePayMultiple', [PurchaseController::class, 'purchasePayMultiple'])
        ->name('admin.purchases.purchasePayMultiple');
    Route::get('admin/purchase/{id}', [PurchaseController::class, 'showPurchaseItems'])->name('purchase.items');
    Route::delete('sale-order/{sale_order}', [SaleOrdersController::class, 'destroy']);

    Route::resource('wastage-usage', WastageUsageController::class);
Route::resource('stock-add', StockAddController::class);
   Route::resource('inventory', InventoryController::class);
    Route::get('barcode-search', [InventoryController::class, 'barcode_search']);

    // Route::post('admin/sale-order', [SaleOrdersController::class, 'updatePaymentType']);
      Route::resource('wastage-usage', WastageUsageController::class);
    Route::get('item-by-barcode', [PurchaseController::class, 'getItemByBarcode']);
    Route::get('getOfferCategories', [OfferController::class, 'getOfferCategories']);
      Route::resource('inventory', InventoryController::class);
      Route::get('barcode-search', [InventoryController::class, 'barcode_search']);
       Route::resource('quotation', QuotationController::class)->names([
        'index' => 'admin.quotation.index',
        'create' => 'admin.quotation.create',
        'store' => 'admin.quotation.store',
        'show' => 'admin.quotation.show',
        'edit' => 'admin.quotation.edit',
        'update' => 'admin.quotation.update',
        'destroy' => 'admin.quotation.destroy',
    ]);
    Route::post('quotation/customer', [QuotationController::class, 'customersave']);

    // Reports
    Route::get('bill-wise-report', [ReportController::class, 'bill_wise']);
    Route::get('category-wise-report', [ReportController::class, 'category_wise']);
    Route::get('item-wise-report', [ReportController::class, 'item_wise']);
    Route::get('order-type-wise-report', [ReportController::class, 'order_type_wise']);
    Route::get('staff-wise-report', [ReportController::class, 'staff_wise']);
    Route::get('user-wise-report', [ReportController::class, 'user_wise']);
    Route::get('driver-wise-report', [ReportController::class, 'driver_wise']);
    Route::get('customer-wise-report', [ReportController::class, 'customer_wise']);
    Route::get('payback-log', [ReportController::class, 'payback_log']);
    Route::get('perfomance-report', [ReportController::class, 'perfomance_wise']);
    Route::get('purchase-report', [ReportController::class, 'purchase_wise']);
    Route::resource('purchase-pay-log', PurchasePayController::class);
    Route::get('/purchase-pay-log', [PurchasePayController::class, 'index'])->name('purchase-pay-log.index');
    Route::get('/production_log', [ReportController::class, 'production_log']);
    Route::get('stock-moving-report', [ReportController::class, 'stock_wise']);
    Route::get('Minimum-stock-report', [ReportController::class, 'minimum_stock']);
    Route::get('available-stock', [ReportController::class, 'available_stock']);
    Route::get('stock-report', [ReportController::class, 'stock_wise']);
    Route::get('wastage-usage-report', [ReportController::class, 'wastage_usage']);

    Route::get('expense-report', [ReportController::class, 'expense']);
    Route::get('print_dashboard', [SaleController::class, 'print_file']);
    Route::get('settle-sale-report', [ReportController::class,'settle_sale']);
    Route::get('settle-sale-reprint/{settle_sale:id}', [ReportController::class,'settle_sale_re_print']);
    Route::get('supplier-outstanding', [ReportController::class,'supplier']);
    Route::get('customer-outstanding', [ReportController::class,'customer']);
    Route::get('driver-outstanding', [ReportController::class,'driver']);
    Route::get('profit-loss', [ReportController::class,'profit_loss']);
    Route::get('stock-out-report', [ReportController::class, 'stock_out']);
    Route::get('payment-book', [ReportController::class, 'paymentBook']);
    // Route::resource('testing',TestController::class);
  Route::get('production_log', [ReportController::class, 'production_log']);
  Route::get('points-history', [ReportController::class, 'points_history']);
});

// Counter
Route::group(['middleware' => ['auth', 'counter']], function () {
    Route::get('home', [SaleController::class, 'index']);
    Route::get('home/{uuid}/edit', [SaleController::class, 'edit']);
    Route::get('getOfferCategories', [OfferController::class, 'getOfferCategories']);

    // sale
    Route::post('order-post', [SaleController::class, 'store']);
    Route::post('get-ajax-customer', [SaleController::class, 'get_customer']);
    Route::post('staff-pin-check', [SaleController::class, 'staff_pin_check']);
    Route::get('print', [SaleController::class, 'print_file']);
    Route::post('item-search', [SaleController::class, 'item_search']);
    Route::post('barcode-search', [SaleController::class, 'barcode_search']);
    Route::get('delivery-list', [SaleController::class, 'delivery_list']);
    Route::get('hold-list', [SaleController::class, 'hold_list']);
    Route::post('change-delivery-status', [SaleController::class, 'change_delivery_status']);
    Route::get('fetch-items', [SaleController::class, 'fetchItems']);

 Route::get('/get-loyalty-data', function () {
        return response()->json(DB::table('loyality')->first());
    });
    Route::resource('expense', ExpenseController::class)->names([
        'store' => 'expense.store',
        'create' => 'expense.create',
    ]);
    Route::resource('credit-sale', CreditSaleController::class);
    Route::resource('recent-sale', RecentSaleController::class);
    Route::post('changePayment', [RecentSaleController::class, 'changePaymentType'])->name('changePaymentType');
    Route::resource('delivery-log', DeliverySaleController::class);
    Route::resource('settle-sale', SettleSaleController::class);
    Route::resource('open-balance', OpenCashController::class);
    Route::resource('crm', CrmController::class);
    Route::resource('open-drawer', OpenDrawer::class);
    Route::resource('pay-back', PayBackController::class)->except(['show']);
     Route::post('fetch-uuid', [SaleController::class, 'fetchUuid']);
    // Route::get('/pay-back/recent', [PayBackController::class, 'viewRecentPaybacks'])->name('viewRecentPaybacks');

    Route::get('pay-back-print', [PayBackController::class, 'create']);
    Route::get('driver-log', [DeliverySaleController::class, 'driverLog']);
    Route::post('driver-order-close', [DeliverySaleController::class, 'driver_order_close']);
    Route::post('recent-sale/change-payment', [RecentSaleController::class, 'changePaymentType']);
    Route::POST('addtocart', [SaleController::class, 'addToCart']);
    //print
    Route::get('credit-print', [CreditSaleController::class, 'show']);

    // Password change
    Route::post('change-password', [UserController::class, 'changePassword']);
      // Quotation
    Route::resource('quotation', CounterQuotationController::class);
    Route::get('print-quote', [CounterQuotationController::class, 'printquote']);
    Route::post('quotation/add-to-cart', [CounterQuotationController::class, 'addToCart']);
});

// excel route moved to excel.php file
// include 'excel.php';

Route::get('artisan/{command}', function($command) {
    // if (app()->environment('local')) {
        Artisan::call($command);
        return Artisan::output();
    // }
});


Route::fallback(function () {
    return redirect('/');
});
