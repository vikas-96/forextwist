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
    Route::apiResource('countries', 'CountryController');
    Route::apiResource('join_now', 'JoinNowController');
    Route::apiResource('contactus', 'ContactusController');
    Route::apiResource('users', 'UserController');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout',"AuthController@logout")->name('logout');
        Route::post('change_password',"AuthController@changePassword")->name('change_password');
    });
});

// Route::namespace('Admin')->prefix('admin/v1')->group(function () {
    
// }
