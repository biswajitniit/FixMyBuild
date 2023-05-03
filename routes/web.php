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
use App\Http\Controllers\Admin\Reviewer\ReviewerController;
use App\Http\Controllers\Admin\Terms\TermsController;
use App\Http\Controllers\Admin\Builder\BuildercategoryController;
use App\Http\Controllers\Admin\Cms\CmsController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/dropzoneupload', [MediaController::class,'dropzoneupload'])->name('dropzoneupload');
Route::post('/dropzonesave', [MediaController::class,'dropzonesave'])->name('dropzonesave');
Route::post('/dropzonedestroy', [MediaController::class,'dropzonedestroy'])->name('dropzonedestroy');


 Route::get('/admin', [AdminLoginController::class, 'index'])->name('admin.login');
 Route::post('/admin/login', [AdminLoginController::class, 'postlogin'])->name('adminLoginPost');
    // Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
    // Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');







// Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
//     Auth::routes();
// });

Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    //user section
    Route::get('/login', [LoginController::class,'login'])->name('login');
    Route::post('/user/loginpost', [LoginController::class,'loginpost'])->name('user.loginpost');
    Route::get('/user/registration', [HomeController::class,'registration'])->name('user.registration');
    Route::post('/user/save-user', [HomeController::class,'save_user'])->name('user.save-user');

    Route::get('/about-us', [HomeController::class,'about_us'])->name('about-us');
    Route::get('/contact-us', [HomeController::class,'contact_us'])->name('contact-us');
    Route::get('/privacy-policy', [HomeController::class,'privacy_policy'])->name('privacy-policy');
    Route::get('/termspage/{pageid}', [HomeController::class,'termspage'])->name('termspage');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');




    Route::get('/auth/google', [GoogleController::class,'redirect'])->name('google-auth');
    Route::get('/google/callback', [GoogleController::class,'callbackFromGoogle'])->name('callback');


    Route::get('/dashboard', function () {
        return view('Dashboard/dashboard');
    })->name('dashboard');


    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    });

    Route::get('/auth/callback', function () {
        $user = Socialite::driver('google')->user();
    });

    Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {

    });


    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
        Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');

        Route::get('/admin/users', [UserController::class, 'users'])->name('admin/users');
        Route::any('/admin/users-list-datatable', [UserController::class, 'ajax_users_list_datatable'])->name('admin.user-list-datatable');

        Route::resource('reviewer', ReviewerController::class);
        Route::get('/admin/project/awaiting-your-review', [ReviewerController::class, 'awaiting_your_review'])->name('admin/project/awaiting-your-review');
        Route::get('/admin/project/awaiting-your-review-show/{projectid}', [ReviewerController::class, 'awaiting_your_review_show'])->name('awaiting-your-review-show');
        Route::post('/awaiting-your-review-save', [ReviewerController::class, 'awaiting_your_review_save'])->name('awaiting-your-review-save');
        Route::post('/awaiting-your-review-final-save', [ReviewerController::class, 'awaiting_your_review_final_save'])->name('awaiting-your-review-final-save');
        Route::post('/get-builder-subcategory-list', [ReviewerController::class,'get_builder_subcategory_list'])->name('get-builder-subcategory-list');
        Route::get('/admin/project/final-review/{projectid}', [ReviewerController::class,'final_review'])->name('final-review');


        Route::resource('terms', TermsController::class);



        Route::get('getbuildercategory', 'App\Http\Controllers\Admin\Builder\BuildercategoryController@getbuildercategory')->name('getbuildercategory');
        Route::delete('getbuildercategory/delete', 'App\Http\Controllers\Admin\Builder\BuildercategoryController@delete')->name('getbuildercategory.delete');
        Route::resource('buildercategory', 'App\Http\Controllers\Admin\Builder\BuildercategoryController');

        Route::get('getbuildersubcategory', 'App\Http\Controllers\Admin\Builder\BuildersubcategoryController@getbuildersubcategory')->name('getbuildersubcategory');
        Route::delete('getbuildersubcategory/delete', 'App\Http\Controllers\Admin\Builder\BuildersubcategoryController@delete')->name('getbuildersubcategory.delete');
        Route::resource('buildersubcategory', 'App\Http\Controllers\Admin\Builder\BuildersubcategoryController');


        Route::resource('admin/cms', 'App\Http\Controllers\Admin\Cms\CmsController');



    });

    Route::group(['prefix' => 'customer','middleware' => 'auth'], function () {


        Route::get('profile', [CustomerController::class,'customer_profile'])->name('customer.profile');
        Route::get('project', [CustomerController::class,'customer_project'])->name('customer.project');
        Route::get('notifications', [CustomerController::class,'customer_notifications'])->name('customer.notifications');
        Route::get('newproject', [CustomerController::class,'customer_newproject'])->name('customer.newproject');
        Route::post('storeproject', [CustomerController::class,'customer_storeproject'])->name('customer.storeproject');


        Route::post('getcustomermediafiles', [CustomerController::class,'getcustomermediafiles'])->name('customer.getcustomermediafiles');
        Route::post('deletecustomermediafiles', [CustomerController::class,'deletecustomermediafiles'])->name('customer.deletecustomermediafiles');
        /**
        * Logout Route
        */
        Route::get('/logout', [LogoutsController::class,'logout'])->name('logout');
    });


    Route::group(['prefix' => 'tradeperson','middleware' => 'auth'], function () {
        Route::get('company-registration', [TradepersionDashboardController::class,'registrationsteptwo'])->name('tradepersion.compregistration');
        Route::post('save-company-registration', [TradepersionDashboardController::class,'saveregistrationsteptwo'])->name('tradepersion.savecompregistration');
        Route::get('bank-registration', [TradepersionDashboardController::class,'registrationstepthree'])->name('tradepersion.bankregistration');
        Route::post('save-bank-registration', [TradepersionDashboardController::class,'saveregistrationstepthree'])->name('tradepersion.savebankregistration');
        Route::get('get-company-details', [TradepersionDashboardController::class, 'get_companydetails']);
        Route::get('get-company-vat-details', [TradepersionDashboardController::class, 'get_company_vat_details']);

    });
});
