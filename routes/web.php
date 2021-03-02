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


Route::view('/forgotpassword', 'forgotpassword.index')->name('forgotpassword');

Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/', 'Auth\LoginController@auth')->name('login.auth');

Route::get('/register', 'UserController@index')->name('register');
Route::post('/register', 'UserController@store')->name('register.store');

Route::view('/home', 'home.index')->name('home')->middleware('auth');

Route::get('/blueprints', 'BlueprintController@index')->name('blueprints')->middleware('auth');
Route::get('/blueprints/{slug}', 'BlueprintController@show')->name('blueprint')->middleware('auth');

Route::get('/documents', 'DocumentController@index')->name('documents')->middleware('auth');

Route::get('/projects', 'ProjectController@index')->name('projects')->middleware('auth');
Route::get('/projects/{slug}', 'ProjectController@show')->name('project')->middleware('auth');

Route::get('/purchases', 'PurchaseController@index')->name('purchases')->middleware('auth');

Route::get('/stock', 'StockController@index')->name('stock')->middleware('auth');
