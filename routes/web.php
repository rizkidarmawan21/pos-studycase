<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard.index'));
});

Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login');
        Route::middleware(['auth'])->group(function () {
            Route::post('logout', 'logout')->name('logout');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return redirect(route('dashboard.index'));
        });

        Route::controller(DashboardController::class)->middleware('can:view_general_dashboard')->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard.index');
            Route::get('/dashboard/get_total_revenue', 'get_total_revenue')->name('dashboard.gettotalrevenue');
            Route::get('/dashboard/get_total_product', 'get_total_products')->name('dashboard.gettotalproducts');
            Route::get('/dashboard/get_most_sales_product', 'most_sales_product')->name('dashboard.getmostsalesproduct');
        });

        require __DIR__ . '/admin/settings.php';
        require __DIR__ . '/admin/master_data.php';
        require __DIR__ . '/admin/core.php';
    });
});