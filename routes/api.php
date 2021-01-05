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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//------------------------------------
//			NASABAH AUTH
//-------------------------------------
Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/register', 'Api\AuthController@register');
Route::post('auth/logout', 'Api\AuthController@logout')->middleware('auth:api');
Route::post('forgot_password', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::group(['middleware' => ['auth:api','CheckRoleApi:nasabah']], function() {
	Route::patch('/update/profile', 'Api\AuthController@update');
	Route::get('/profile', 'Api\AuthController@index');
});

Route::group(['middleware' => ['auth:api','CheckRoleApi:pengurus1']], function() {
	Route::post('/pengurus1/setoran','Api\Pengurus1Controller@create');
});




































//-------------------------------------
//			ADMIN AUTH
//------------------------------------
Route::post('auth/admin/login', 'Api\Admin\AuthController@login');
Route::post('auth/admin/register', 'Api\Admin\AuthController@register');
Route::post('auth/admin/logout', 'Api\Admin\AuthController@logout')->middleware('auth:api');

Route::group(['middleware' => ['auth:api','CheckRoleApi:admin']],function() {
	Route::patch('/update/admin/profile', 'Api\Admin\AuthController@update')->middleware('auth:api');
});
