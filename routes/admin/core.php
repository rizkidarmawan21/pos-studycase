<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Core Routes
|--------------------------------------------------------------------------
|
| Here is where you can register core related routes for your application.
|
*/

Route::controller(TransactionController::class)->middleware('can:view_transaction')->prefix('transaction')->name('transaction.')->group(function () {
    Route::get('/', 'index')->name('index');

    // Cart Related Route
    Route::get('get-cart-data', 'getCartData')->name('getcartdata');
    Route::get('get-customer-data', 'getCustomerData')->name('getcustomerdata');
    Route::get('get-product-data', 'getProductData')->name('getproductdata');
    Route::post('add-to-cart', 'addToCart')->name('addtocart');
    Route::put('{id}/update-qty', 'updateQtyCart')->name('updateqtycart');
    Route::delete('{id}/remove-product-from-cart', 'deleteFromCart')->name('deletefromcart');

    // Order Related Route
    Route::post('create-order', 'createOrder')->name('createorder');
    Route::get('{id}/print-order', 'printOrder')->name('printorder');
});

Route::controller(ReportController::class)->middleware('can:view_report')->prefix('report')->name('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('get-data', 'getData')->name('getdata');

    // Export Route
    Route::get('report/export-excel', 'exportExcelReport')->name('exportexcel');
    Route::get('report/export-pdf', 'exportPdfReport')->name('exportpdf');
});