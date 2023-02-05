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
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Tradepersion\TradepersionDashboardController;
use Illuminate\Http\Request;
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

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::post('/capture-video-streaming', [MediaController::class,'capture_video_streaming'])->name('capture-video-streaming');
Route::post('/capture-photo', [MediaController::class,'capture_photo'])->name('capture-photo');

Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    //user section
    Route::get('/login', [LoginController::class,'login'])->name('login');
    Route::post('/user/loginpost', [LoginController::class,'loginpost'])->name('user.loginpost');
    Route::get('/user/registration', [HomeController::class,'registration'])->name('user.registration');
    Route::post('/user/save-user', [HomeController::class,'save_user'])->name('user.save-user');
    // Route::get('/auth/google', [GoogleController::class,'loginwithgoogle'])->name('login');
    // Route::get('/google/callback', [GoogleController::class,'callbackFromGoogle'])->name('callback');

    // Route::get('/dashboard', function () {
    //     return view('Dashboard/dashboard');
    // })->name('dashboard');


    // Route::get('/auth/redirect', function () {
    //     return Socialite::driver('google')->redirect();
    // });

    // Route::get('/auth/callback', function () {
    //     $user = Socialite::driver('google')->user();
    // });



    Route::group(['prefix' => 'customer','middleware' => 'auth'], function () {


        Route::get('profile', [CustomerController::class,'customer_profile'])->name('customer.profile');
        Route::get('project', [CustomerController::class,'customer_project'])->name('customer.project');
        Route::get('notifications', [CustomerController::class,'customer_notifications'])->name('customer.notifications');
        Route::get('newproject', [CustomerController::class,'customer_newproject'])->name('customer.newproject');

        /**
        * Logout Route
        */
        Route::get('/logout', [LogoutsController::class,'logout'])->name('logout');
    });

    
    Route::group(['prefix' => 'tradeperson','middleware' => 'auth'], function () {
        Route::get('company-registration', [TradepersionDashboardController::class,'registrationsteptwo'])->name('tradepersion.compregistration');
    });
});
