<?php

use App\Http\Controllers\Api\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('authentication')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::post('login', 'login');
        Route::middleware('JwtMiddleware')->group(function () {
            Route::get('logout', 'logout');
            Route::post('refresh', 'refresh');
        });
    });
});

Route::middleware('JwtMiddleware')->group(function () {
    require __DIR__ . '/api/admin/products.php';
    require __DIR__ . '/api/admin/categories.php';
});
