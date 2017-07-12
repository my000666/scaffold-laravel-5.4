<?php

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

Auth::routes();

Route::get('/', 'MainController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('home', 'HomeController');
    Route::resource('profile', 'ProfileController');
    Route::resource('role', 'RoleController');
    Route::resource('admin', 'AdminController');
    Route::resource('user', 'UserController');
    Route::resource('mode', 'ModeController');
});