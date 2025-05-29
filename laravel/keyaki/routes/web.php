<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;

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

// Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])
//     ->middleware(['guest'])
//     ->name('login');

// Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])
//     ->middleware(['guest']);

Route::group(['middleware' => ['auth']], function () {
    // my page
    // Route::get('/loading', [HomeController::class, 'check'])->name('home');
    Route::get('/home', [HomeController::class, 'check'])->name('home');
    Route::get('/mypage', [HomeController::class, 'index'])->name('mypage');

    // books resource
    Route::resource('books', BookController::class);

    // likes route
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
    Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});