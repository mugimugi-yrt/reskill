<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// LV60
Route::get('/', [ProductController::class, 'index']) -> name('product.index');

// LV70
// Route::get('/', [CustomerController::class, 'index']);
Route::get('/customers', [CustomerController::class, 'index']) -> name('customers.index');
Route::resource('orders', OrderController::class);
Route::patch('/orders/{order}/ship', [OrderController::class, 'ship']) -> name('orders.ship');