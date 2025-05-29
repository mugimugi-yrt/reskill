<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

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

Route::get('/', [MemoController::class, 'index']);
Route::resource('memos', MemoController::class);

// ルートを追加する
Route::get('memos/{memo}/delete', [MemoController::class, 'delete']) -> name('memos.delete');