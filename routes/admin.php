<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminloginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\LogoutController;
//use App\Http\Controllers\Dashboard\UserdashboardController;
use App\Http\Controllers\LogoutsController;

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\CustomerController;

use Laravel\Socialite\Facades\Socialite;
use App\Models\Admin;


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

// Route::get('/admin', [AdminloginController::class, 'index'])->name('admin.login');
// Route::post('/admin/login', [AdminloginController::class, 'postlogin'])->name('adminLoginPost');

// Route::group(['middleware' => ['auth:admin']], function() {
// 	// Admin Dashboard
//     Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
//     Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');

//     Route::get('/admin/users', [UserController::class, 'users'])->name('admin/users');
//     Route::any('/admin/users-list-datatable', [UserController::class, 'ajax_users_list_datatable'])->name('admin.user-list-datatable');
// });
