<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Api')->group(function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/signup', 'AuthController@signup');
    Route::post('/third-party-login', 'AuthController@login_with_third_party');
    Route::post('/third-party-signup', 'AuthController@authenticate_with_third_party');
    Route::post('/verify-email', 'AuthController@verify_email');
    Route::post('/forgot-password', 'PasswordController@forgot_password');
    Route::post('/verify-otp', 'PasswordController@verify_otp');
    Route::post('/create-password', 'PasswordController@create_password');
    Route::get('get-categories-and-sub-categories', 'BuilderController@get_categories_and_sub_categories');
    Route::get('get-areas', 'BuilderController@get_areas');


    Route::middleware('auth:sanctum')->group(function() {
      Route::post('/terms-of-service/update', 'AuthController@update_terms_of_service_acceptance');
      Route::post('/change-password', 'UserController@change_password');
      Route::get('/profile', 'UserController@get_profile');
      Route::get('last-used-address','AddressController@last_used_address');
      Route::get('address-from-postcode','AddressController@get_area_from_postcode');
      Route::apiResource('projects', 'ProjectController',);
      Route::post('projects','ProjectController@add_project');
      Route::post('projects/{project_id}/update','ProjectController@update_project');
      Route::post('projects/{project_id}/cancel','ProjectController@cancel_project');
      Route::post('projects/{project_id}/pause','ProjectController@pause_project');
      Route::post('projects/{project_id}/resume','ProjectController@resume_project');
      Route::apiResource('address', 'AddressController',);
      Route::get('/builder-category', 'BuilderController@get_builders');
      Route::post('save-company-general-information', 'BuilderController@save_company_general_information');
      Route::post('save-company-additional-information', 'BuilderController@save_company_additional_information');
      Route::post('save-trader-areas', 'BuilderController@save_trader_areas');
      Route::post('save-trader-works', 'BuilderController@save_trader_works');
      Route::post('save-bank-details', 'BuilderController@save_bank_details');
      Route::post('save-notification-settings', 'BuilderController@save_notification_settings');
      Route::post('save-default-contingency', 'BuilderController@save_default_contingency');
      Route::get('settings', 'UserController@get_settings');
      Route::get('projects/{project_id}/milestones', 'MilestoneController@index');
      Route::get('milestone/{milestone}', 'MilestoneController@show');
      Route::post('milestone/{milestone}/update', 'MilestoneController@update');
      Route::get('projects/{project_id}/milestone-wizard','MilestoneController@milestone_wizard');
      Route::get('company/{trader_id}/','BuilderController@get_company_details');
      Route::get('company/{trader_id}/reviews','ProjectController@get_reviews');

      // Trader Specific routes
      Route::prefix('trader/')->group(function() {
        Route::get('projects/', 'TradespersonProjectController@index');
        Route::get('estimate/{id}', 'EstimateController@show');
        Route::post('projects/{project_id}/write-estimate', 'EstimateController@store');
        Route::post('projects/{project_id}/write-estimate/update', 'EstimateController@update');
        Route::post('projects/{project_id}/reject', 'TradespersonProjectController@reject');
        Route::get('projects/{project_id}/recommendation', 'TradespersonProjectController@recommendation');
        Route::post('estimates/{estimate}/recall', 'EstimateController@recall');
        Route::post('settings', 'BuilderController@save_settings');
    });

      // Customer Specific routes
      Route::prefix('customer/')->group(function() {
        Route::get('projects/{project}/estimates', 'EstimateController@index');
        Route::post('estimates/{estimate}/accept', 'EstimateController@accept');
        Route::post('estimates/{estimate}/reject', 'EstimateController@reject');
        Route::post('projects/{project}/review/submit', 'ProjectController@submit_review');
        Route::post('settings', 'CustomerController@email_notifications');
      });

      Route::prefix('chat/')->group(function() {
        Route::post('get_user_list_by_session_user', 'ChatController@index');
        Route::post('get_unread_chat_count_two_user', 'ChatController@get_unread_chat_count_two_user');
        Route::post('get_chat_details_by_two_user', 'ChatController@get_chat_details_by_two_user');
      });

    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    return response()->json(['error' => '404 - Not found!'], 404);
});
