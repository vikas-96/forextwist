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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Frontend')->group(function () {
    Route::apiResource('countries', 'CountryController');
    Route::apiResource('join_now', 'JoinNowController');
    Route::apiResource('contactus', 'ContactusController');
});

// Route::namespace('Admin')->prefix('admin/v1')->group(function () {
    
// }
