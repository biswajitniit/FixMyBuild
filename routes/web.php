<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminloginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MicrosoftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\LogoutsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Admin\User\UserController as AdminUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Tradepersion\TradepersionDashboardController;
use App\Http\Controllers\Tradepersion\TradespersonFileController;
use App\Http\Controllers\Admin\Reviewer\ReviewerController;
use App\Http\Controllers\Admin\Terms\TermsController;
use App\Http\Controllers\Admin\Builder\BuildercategoryController;
use App\Http\Controllers\Admin\Builder\BuildersubcategoryController;
use App\Http\Controllers\Admin\Cms\CmsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripeController;

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

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/get-video', [MediaController::class,'get_video'])->name('get-video');

Route::post('/capture-video-streaming', [MediaController::class,'capture_video_streaming'])->name('capture-video-streaming');
Route::post('/capture-video-streaming-project-return-for-review', [MediaController::class,'capture_video_streaming_project_return_for_review'])->name('capture-video-streaming-project-return-for-review');
Route::post('/capture-photo', [MediaController::class,'capture_photo'])->name('capture-photo');
Route::post('/capture-photo-project-return-for-review', [MediaController::class,'capture_photo_project_return_for_review'])->name('capture-photo-project-return-for-review');

Route::get('/dropzoneupload', [MediaController::class, 'dropzoneupload'])->name('dropzoneupload');
Route::post('/dropzonesave', [MediaController::class, 'dropzonesave'])->name('dropzonesave');
Route::post('/dropzonedestroy', [MediaController::class, 'dropzonedestroy'])->name('dropzonedestroy');


Route::get('/admin', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'postlogin'])->name('adminLoginPost');
// Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
// Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');


// Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
//     Auth::routes();
// });

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/', function () {
      return view('welcome');
    })->name('home');

    //user section
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/user/loginpost', [LoginController::class, 'loginpost'])->name('user.loginpost');
    Route::get('/user/registration', [UserController::class, 'registration'])->name('user.registration');
    Route::post('/user/save-user', [UserController::class, 'save_user'])->name('user.save-user');
    Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');



    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/termspage/{pageid}', [HomeController::class, 'termspage'])->name('termspage');
    Route::get('/terms-of-service', [HomeController::class, 'terms_of_service'])->name('terms-of-service');


    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::get('verify-otp', [ForgotPasswordController::class, 'otpVerifyPage'])->name('otpVerify.get');
    Route::post('send-otp', [ForgotPasswordController::class, 'generateOtp'])->name('generateOtp');
    Route::post('resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('resendOtp');
    Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('otpVerify.post');
    Route::post('resetPassword', [ForgotPasswordController::class, 'resetPasswordusingOTP'])->name('reset.password-mobile-otp');


    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google-auth');
    Route::get('/google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');


    Route::get('/auth/microsoft', [MicrosoftController::class, 'redirect'])->name('microsoft-auth');
    Route::get('/microsoft/callback', [GoogleController::class, 'callbackFromMicrosoft'])->name('microsoftcallback');


    Route::get('/dashboard', function () {
        return view('Dashboard/dashboard');
    })->name('dashboard');


    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    });

    Route::get('/auth/callback', function () {
        $user = Socialite::driver('google')->user();
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    });


    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
        Route::get('/admin/logout', [LogoutController::class, 'adminlogout'])->name('/admin/logout');

        Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin.users');
        Route::any('/admin/users-list-datatable', [AdminUserController::class, 'ajax_users_list_datatable'])->name('admin.user-list-datatable');
        Route::get('/admin/user/{id}', [AdminUserController::class, 'user_detail_page'])->name('admin.user-detail');
        Route::patch('/admin/verify-account/{id}', [AdminUserController::class, 'verify_account'])->name('admin.verify-account');
        Route::patch('/admin/change-account-status/{id}', [AdminUserController::class, 'toggle_user_status'])->name('admin.toggle-status');

        Route::resource('reviewer', ReviewerController::class);
        Route::get('/admin/project', [ReviewerController::class, 'awaiting_your_review'])->name('admin/project/awaiting-your-review');
        Route::get('/admin/project/{projectid}', [ReviewerController::class, 'awaiting_your_review_show'])->name('awaiting-your-review-show');
        Route::post('/review-save', [ReviewerController::class, 'awaiting_your_review_save'])->name('awaiting-your-review-save');
        Route::post('/review-final-save', [ReviewerController::class, 'awaiting_your_review_final_save'])->name('awaiting-your-review-final-save');
        Route::post('/get-builder-subcategory-list', [ReviewerController::class, 'get_builder_subcategory_list'])->name('get-builder-subcategory-list');
        Route::get('/admin/project/final-review/{projectid}', [ReviewerController::class, 'final_review'])->name('final-review');


        Route::resource('terms', TermsController::class);



        Route::get('getbuildercategory', [BuildercategoryController::class, 'getbuildercategory'])->name('getbuildercategory');
        Route::delete('getbuildercategory/delete', [BuildercategoryController::class, 'delete'])->name('getbuildercategory.delete');
        Route::resource('buildercategory', BuildercategoryController::class);

        Route::get('getbuildersubcategory', [BuildersubcategoryController::class, 'getbuildersubcategory'])->name('getbuildersubcategory');
        Route::delete('getbuildersubcategory/delete', [BuildersubcategoryController::class, 'delete'])->name('getbuildersubcategory.delete');
        Route::resource('buildersubcategory', BuildersubcategoryController::class);


        Route::resource('admin/cms', 'App\Http\Controllers\Admin\Cms\CmsController');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function () {

        Route::delete('/users/users-delete_account', [UserController::class, 'delete_account'])->name('customer.user-delete-account');
        Route::post('/users/verify-email', [UserController::class, 'resend_verification_email'])->name('customer.resend_verification_email');

        Route::get('profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
        Route::get('projects', [CustomerController::class, 'customer_project'])->name('customer.project');
        Route::get('newproject', [CustomerController::class, 'customer_newproject'])->name('customer.newproject');
        Route::post('storeproject', [CustomerController::class, 'customer_storeproject'])->name('customer.storeproject');

        Route::get('project/{id}', [CustomerController::class,'details'])->name('customer.project_details');
        Route::get('project-return-for-review/{id}', [CustomerController::class,'project_return_for_review'])->name('customer.project-return-for-review');
        Route::post('editproject-return-for-review/{projectid}', [CustomerController::class,'customer_editproject'])->name('customer.editproject-return-for-review');

        Route::post('getcustomermediafiles', [CustomerController::class,'getcustomermediafiles'])->name('customer.getcustomermediafiles');
        Route::post('getprojectmediafiles', [CustomerController::class,'getprojectmediafiles'])->name('customer.getprojectmediafiles');

        Route::post('deletecustomermediafiles', [CustomerController::class,'deletecustomermediafiles'])->name('customer.deletecustomermediafiles');

        Route::post('project-all-payment', [CustomerController::class,'project_all_payment'])->name('customer.project-all-payment');
        Route::get('project-pay-now/{taskid}', [CustomerController::class,'project_pay_now'])->name('customer.project-pay-now');
        //Route::post('payment-capture', [CustomerController::class,'payment_capture'])->name('customer.payment-capture');

        Route::get('stripe', [StripeController::class, 'stripe']);
        Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


        // Notification Route
        Route::get('/notification', [NotificationController::class, 'index'])->name('customer.notifications.index');
        Route::post('/notification/data_store', [NotificationController::class, 'data_store'])->name('notifications.data_store');
        Route::post('/notification/data_fetch', [NotificationController::class, 'get_notification_data'])->name('notifications.data_fetch');

        Route::put('updatecustomeravatar', [CustomerController::class, 'update_avatar'])->name('customer.updateavatar');
        Route::put('updatecustomername', [CustomerController::class, 'update_name'])->name('customer.updatename');
        Route::post('changecustomerpassword', [CustomerController::class, 'change_password'])->name('customer.changepassword');
        Route::put('updatecustomerphone', [CustomerController::class, 'update_phone'])->name('customer.updatephone');


        /**
         * Logout Route
         */
        Route::get('/logout', [LogoutsController::class, 'logout'])->name('logout');
    });
    Route::get('review', [CustomerController::class,'review']);

    Route::group(['prefix' => 'tradeperson', 'middleware' => ['auth', 'steps_completed']], function () {
        Route::get('company-registration', [TradepersionDashboardController::class, 'registrationsteptwo'])->name('tradepersion.compregistration');
        Route::post('save-company-registration', [TradepersionDashboardController::class, 'saveregistrationsteptwo'])->name('tradepersion.savecompregistration');
        Route::get('bank-registration', [TradepersionDashboardController::class, 'registrationstepthree'])->name('tradepersion.bankregistration');
        Route::post('save-bank-registration', [TradepersionDashboardController::class, 'saveregistrationstepthree'])->name('tradepersion.savebankregistration');
        Route::get('get-company-details', [TradepersionDashboardController::class, 'get_companydetails']);
        Route::get('get-company-vat-details', [TradepersionDashboardController::class, 'get_company_vat_details']);
        Route::get('dashboard', [TradepersionDashboardController::class, 'dashboard'])->name('tradepersion.dashboard');
        Route::post('updateVatInfo', [TradepersionDashboardController::class, 'updateVatInfo']);
        Route::post('updateContingency', [TradepersionDashboardController::class, 'updateContingency']);
        Route::get('projects', [TradepersionDashboardController::class, 'projects'])->name('tradepersion.projects');
        Route::get('settings', [TradepersionDashboardController::class, 'settings'])->name('tradepersion.settings');

        Route::group(['as' => 'tradesperson.'], function () {
            Route::post('updateTraderName', [TradepersionDashboardController::class, 'updateTraderName'])->name('updateTraderName');
            Route::post('updateTraderDesc', [TradepersionDashboardController::class, 'updateTraderDesc'])->name('updateTraderDesc');
            Route::post('updateTraderContactInfo', [TradepersionDashboardController::class, 'updateTraderContactInfo'])->name('updateTraderContactInfo');
            Route::post('updateWorkType', [TradepersionDashboardController::class, 'updateWorkType'])->name('updateWorkType');
            Route::post('updateTraderArea', [TradepersionDashboardController::class, 'updateTraderArea'])->name('updateTraderArea');
            Route::post('updateAccount', [TradepersionDashboardController::class, 'updateAccount'])->name('updateAccount');
            Route::put('updateCompanyLogo', [TradepersionDashboardController::class, 'updateCompanyLogo'])->name('updateCompLogo');
            Route::post('deleteTraderFile', [TradepersionDashboardController::class, 'deleteTraderFile'])->name('deleteTraderFile');
            Route::post('storeTraderFile', [TradepersionDashboardController::class, 'storeTraderFile'])->name('storeTraderFile');
            // Route::post('upload-company-logo', [TradespersonFileController::class, 'storeLogo'])->name('storeLogo');
            // Route::post('upload-public-liability-insurance', [TradespersonFileController::class, 'storePLI'])->name('storePLI');
            // Route::post('upload-trader-img', [TradespersonFileController::class, 'storeTraderImg'])->name('storeTraderImg');
            // Route::post('upload-comp-addrs', [TradespersonFileController::class, 'storeCompAddr'])->name('storeCompAddr');
            // Route::post('upload-prev-projs', [TradespersonFileController::class, 'storePrevProj'])->name('storePrevProj');
            // Route::post('uploadTeamPhoto', [TradespersonFileController::class, 'storeTempTeamPhoto'])->name('storeTeamPhoto');
            Route::post('temp-store-media', [TradepersionDashboardController::class, 'storeTempTraderFile'])->name('tempTraderMedia');
        });
        Route::get('project-estimate/{project_id}', [TradepersionDashboardController::class, 'project_estimate'])->name('tradepersion.project_estimate');
        Route::post('project-estimate', [TradepersionDashboardController::class, 'projectestimate'])->name('tradepersion.p_estimate');
        Route::get('project-details/{project_id}', [TradepersionDashboardController::class, 'details'])->name('tradeperson.project_details');
        Route::post('update-milestone-price', [TradepersionDashboardController::class, 'update_milestone_price'])->name('tradeperson.update-milestone-price');
        Route::post('update-task-status', [TradepersionDashboardController::class, 'update_task_status'])->name('tradeperson.update-task-status');

    });

    Route::get('project/submit-review/{project_id}', [CustomerController::class, 'project_review'])->name('customer.project_review');
    Route::post('project/submit-review', [CustomerController::class, 'submit_review'])->name('customer.review');
});
