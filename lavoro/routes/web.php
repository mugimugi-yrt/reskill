<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminPlanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReservationController;

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

// トップページ
Route::get('/', function () { return view('auth.login_user'); });

// ログイン画面 (良くない子)
// Route::get('/login', function () { return view('auth.login_user'); }) -> name('user.login'); 

// 管理者ログイン画面
Route::get('/admin/login', function () { return view('auth.login_admin'); }) -> name('admin.login'); 

// 新規会員登録画面
Route::post('/register/check', [UserController::class, 'create_check']) -> name('users.create.check');

// ログイン後の画面
Route::group(['middleware' => ['auth']], function () {
    // ログイン分岐
    Route::get('/home', [LoginController::class, 'switch']) ->name('home');

    // 管理者 : ユーザー操作関連
    Route::resource('admin/users', AdminUserController::class) -> names('admin.users');  // 管理者トップ画面 ( route(admin.users.index) )
    Route::post('/admin/users/create/check', [AdminUserController::class, 'create_check']) -> name('admin.users.create.check');
    Route::post('/admin/users/{id}/edit/check', [AdminUserController::class, 'edit_check']) -> name('admin.users.edit.check');

    // 管理者 : 宿操作関連
    Route::resource('admin/hotels', AdminHotelController::class) -> names('admin.hotels');
    Route::post('/admin/hotels/create/check', [AdminHotelController::class, 'create_check']) -> name('admin.hotels.create.check');
    Route::post('/admin/hotels/{id}/edit/check', [AdminHotelController::class, 'edit_check']) -> name('admin.hotels.edit.check');

    // 管理者 : プラン操作関連
    Route::resource('admin/plans', AdminPlanController::class) -> names('admin.plans');
    Route::post('/admin/plans/create/check', [AdminPlanController::class, 'create_check']) -> name('admin.plans.create.check');
    Route::post('/admin/plans/{id}/edit/check', [AdminPlanController::class, 'edit_check']) -> name('admin.plans.edit.check');

    // 管理者 : 認証関連
    Route::get('/admin/requests', [AdminController::class, 'request']) -> name('admin.request');
    Route::post('/admin/requests/check', [AdminController::class, 'request_check']) -> name('admin.request.check');

    // ユーザー : 予約前関連
    Route::get('/plan/search', [SearchController::class, 'search']) -> name('searches.top');
    Route::post('/plan/search/index', [SearchController::class, 'index']) -> name('searches.index');
    Route::get('/plan/{id}/show', [SearchController::class, 'show_plan']) -> name('searches.plans.show');
    Route::get('/hotel/{id}/show', [SearchController::class, 'show_hotel']) -> name('searches.hotels.show');
    Route::post('/likes', [SearchController::class, 'create_like']) -> name('hotels.likes.create');
    Route::delete('/likes', [SearchController::class, 'destroy_like']) -> name('hotels.likes.destroy');

    // ユーザー : 予約関連
    Route::resource('reservations', ReservationController::class, ['only' => ['index', 'create', 'edit', 'store', 'update']]);
    Route::post('/reservations/create/check', [ReservationController::class, 'create_check']) -> name('reservations.create.check');
    Route::post('/reservations/{id}/edit/check', [ReservationController::class, 'edit_check']) -> name('reservations.edit.check');
    Route::post('/reservations/reviews', [ReservationController::class, 'update_reviews']) -> name('reservations.edit.update.reviews');

    // ユーザー : 認証関連
    Route::get('/users/{id}/edit', [UserController::class, 'edit']) -> name('users.edit');
    Route::post('/users/{id}/edit/check', [UserController::class, 'edit_check']) -> name('users.edit.check');
    Route::delete('/users/{id}', [UserController::class, 'destroy']) -> name('users.destroy');
});