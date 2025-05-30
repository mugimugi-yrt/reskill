<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;

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
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile/edit', [HomeController::class, 'edit'])->name('edit');
Route::patch('/home', [HomeController::class, 'update'])->name('update');
Route::delete('/', [HomeController::class, 'destroy'])->name('destroy');
Route::resource('messages', MessageController::class);