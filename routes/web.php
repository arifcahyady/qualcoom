<?php

use Illuminate\Support\Facades\Route;

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

//-------------------------------\\
//		HALAMAN DASHBOARD 		  
//--------------------------------\\

Route::get('/login', 'Web\AuthController@login')->name('login');
Route::post('/postlogin', 'Web\AuthController@postlogin');
Route::get('/registrasi', 'Web\AuthController@registerasi');
Route::post('/postregister', 'Web\AuthController@postregister');
Route::get('/logout', 'Web\AuthController@logout')->middleware('auth');

Route::group(['middleware' => ['auth','CheckRole:admin']], function() {
	Route::get('/dashboard', 'Web\DashboardController@index');
	Route::get('/user/{id}/profile', 'Web\DashboardController@profile');
	Route::post('/pengurus/create', 'Web\DashboardController@createPengurus');
	Route::get('/pengurus/{id}/update', 'Web\DashboardController@updatePengurus');
	Route::post('/pengurus/{id}/edit', 'Web\DashboardController@editPengurus');
	Route::get('/pengurus/{id}/delete', 'Web\DashboardController@deletePengurus');
	Route::get('sampah', 'Web\TrashController@index');
	Route::post('sampah/create', 'Web\TrashController@create');
	Route::get('/sampah/{id}/update', 'Web\TrashController@update');
	Route::post('/sampah/{id}/edit', 'Web\TrashController@edit');
});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
