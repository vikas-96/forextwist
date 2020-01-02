<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Frontend')->group(function () {
    Route::post('login',"AuthController@login")->name('login');
    Route::post('forget_password',"AuthController@forgetPassword")->name('forget_password');
    Route::post('reset_password',"AuthController@resetPassword")->name('reset_password');
    Route::get('email_verify',"AuthController@emailVerification")->name('email_verify');
    Route::get('get_state_by_country/{id}', 'StateController@getStateBasedOnCountry')->name('get_state_by_country');
    Route::get('states/{id}', 'StateController@show')->name('states');
    Route::apiResource('countries', 'CountryController');
    Route::apiResource('join_now', 'JoinNowController');
    Route::apiResource('contactus', 'ContactusController');
    Route::apiResource('users', 'UserController');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout',"AuthController@logout")->name('logout');
        Route::post('change_password',"AuthController@changePassword")->name('change_password');
    });
});

Route::namespace('User')->prefix('user')->group(function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('user_bank_detail',"UserBankDetailController");
        Route::get('bank_detail_of_user/{id}',"UserBankDetailController@userBankDetails")->name('bank_detail_of_user');
        Route::apiResource('document',"DocumentController");
        Route::post('document_upload',"DocumentController@uploadFile")->name('document_upload');
        Route::get('document_of_user/{id}',"DocumentController@userDocument")->name('document_of_user');
    });
});
