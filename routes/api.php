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
    Route::post('/verify-email', 'AuthController@verify_email');
    Route::post('/forgot-password', 'PasswordController@forgot_password');
    Route::post('/verify-otp', 'PasswordController@verify_otp');
    Route::post('/create-password', 'PasswordController@create_password');
    


    Route::middleware('auth:sanctum')->group(function() {
      Route::post('/change-password', 'UserController@change_password');
      Route::get('/profile', 'UserController@get_profile');
      Route::apiResource('projects', 'ProjectController',);
      Route::post('projects','ProjectController@add_project');
      Route::put('projects','ProjectController@update_project');
      Route::apiResource('address', 'AddressController',);
      Route::get('/builder-category', 'BuilderController@get_builders');
    });
  });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
