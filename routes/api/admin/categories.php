<?php

use App\Http\Controllers\Api\CategoryController;

Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('get-data', 'getData')->name('getdata');
    Route::post('create', 'createData')->name('create');
    Route::post('{id}/update', 'updateData')->name('update');
    Route::delete('{id}/delete', 'deleteData')->name('delete');
});
