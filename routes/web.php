<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminloginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Dashboard\UserdashboardController;
use App\Http\Controllers\Dashboard\UserlogoutController;

use Laravel\Socialite\Facades\Socialite;


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

Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', [AdminloginController::class, 'index'])->name('admin.login');
    Route::post('/admin/login', [AdminloginController::class, 'postlogin'])->name('adminLoginPost');
});
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');




 /**
 *
 * Frontend section start
 *
 */
Route::get('/', function () {
    return view('welcome');
});

//user section
Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('/user/loginpost', [LoginController::class,'loginpost'])->name('user.loginpost');
Route::get('/user/logout', [UserlogoutController::class,'userlogout'])->name('user.logout');


Route::get('/user/registration', [HomeController::class,'registration'])->name('user.registration');
Route::post('/user/save-user', [HomeController::class,'save_user'])->name('user.save-user');

Route::get('/user/dashboard', [UserdashboardController::class,'user_dashboard'])->name('user.dashboard');


Route::get('/auth/google', [GoogleController::class,'loginwithgoogle'])->name('login');
Route::get('/google/callback', [GoogleController::class,'callbackFromGoogle'])->name('callback');

Route::get('/dashboard', function () {
    return view('Dashboard/dashboard');
})->name('dashboard');


// Route::get('/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();
// });
