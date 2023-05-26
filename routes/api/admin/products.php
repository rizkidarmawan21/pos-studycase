<?php

use App\Http\Controllers\Api\Product\ProductController;

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('get-data', 'getData')->name('getdata');
    Route::post('create', 'createData')->name('create');
    Route::post('{id}/update', 'updateData')->name('update');
    Route::delete('{id}/delete', 'deleteData')->name('delete');
});
