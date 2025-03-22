<?php

use App\Http\Controllers\Admin\ExcelPrintController;
use Illuminate\Support\Facades\Route;

/**
 * laravel excel and print route.
 * It was developed but now it was not in use due to js excel print pdf added
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {

    // excel-print
    Route::get('bill-wiser-excel', [ExcelPrintController::class,'bill_wise']);
    Route::get('bill-wiser-print', [ExcelPrintController::class,'bill_wise_print']);

    Route::get('category-wise-excel', [ExcelPrintController::class,'category_wise']);
    Route::get('category-wise-print', [ExcelPrintController::class,'category_wise_print']);

    Route::get('item-wise-excel', [ExcelPrintController::class,'item_wise']);
    Route::get('item-wise-print', [ExcelPrintController::class,'item_wise_print']);

    Route::get('order-type-excel', [ExcelPrintController::class,'order_type']);
    Route::get('order-type-print', [ExcelPrintController::class,'order_type_print']);

    Route::get('staff-wise-excel', [ExcelPrintController::class,'staff_wise']);
    Route::get('staff-wise-print', [ExcelPrintController::class,'staff_wise_print']);

    Route::get('user-wise-excel', [ExcelPrintController::class,'user_wise']);
    Route::get('user-wise-print', [ExcelPrintController::class,'user_wise_print']);

    Route::get('driver-wise-excel', [ExcelPrintController::class,'driver_wise']);
    Route::get('driver-wise-print', [ExcelPrintController::class,'driver_wise_print']);

    Route::get('customer-wise-excel', [ExcelPrintController::class,'customer_wise']);
    Route::get('customer-wise-print', [ExcelPrintController::class,'customer_wise_print']);

    Route::get('perfomance-excel', [ExcelPrintController::class,'perfomance']);
    Route::get('perfomance-print', [ExcelPrintController::class,'perfomance_print']);

    Route::get('purchase-excel', [ExcelPrintController::class,'purchase_wise']);
    Route::get('purchase-print', [ExcelPrintController::class,'purchase_print']);

    Route::get('stock-excel', [ExcelPrintController::class,'stock']);
    Route::get('stock-print', [ExcelPrintController::class,'stock_print']);

    Route::get('logs-excel', [ExcelPrintController::class,'logs_wise']);
    Route::get('logs-print', [ExcelPrintController::class,'logs_print']);

    Route::get('expense-excel', [ExcelPrintController::class,'expense_wise']);
    Route::get('expense-print', [ExcelPrintController::class,'expense_print']);

    Route::get('settle-excel', [ExcelPrintController::class,'settle_sale']);
    Route::get('settle-print', [ExcelPrintController::class,'settle_sale_print']);

});
