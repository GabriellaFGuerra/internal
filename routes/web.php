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


Route::get('/forgotpassword', 'Auth\ForgotPasswordController@index')->name('forgotpassword')->middleware('guest');
Route::post('/forgotpassword', 'Auth\ForgotPasswordController@getemail')->name('getemail')->middleware('guest');

Route::get('/recovery/{email}/{token}', 'Auth\RecoveryController@index')->name('recovery')->middleware('guest');
Route::post('/recovery', 'Auth\RecoveryController@recover')->name('recover')->middleware('guest');

Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

Route::get('/', 'Auth\LoginController@index')->name('login')->middleware('guest');
Route::post('/', 'Auth\LoginController@auth')->name('login.auth')->middleware('guest');

Route::get('/register', 'UserController@index')->name('register')->middleware('guest');
Route::post('/register', 'UserController@store')->name('register.store')->middleware('guest');

Route::view('/home', 'home.index')->name('home')->middleware('auth');

Route::get('/blueprints', 'BlueprintController@index')->name('blueprints')->middleware('auth');
Route::get('/blueprints/{slug}', 'BlueprintController@show')->name('blueprint')->middleware('auth');

Route::get('/documents', 'DocumentController@index')->name('documents')->middleware('auth');
Route::post('/documents', 'DocumentController@upload')->name('uploadDoc')->middleware('auth');
Route::get('/documents/download/{id}', 'DocumentController@download')->name('downloadDoc')->middleware('auth');
Route::get('/documents/delete/{id}', 'DocumentController@delete')->name('deleteDoc')->middleware('auth');
Route::get('/documents/trash', 'DocumentController@trash')->name('trashDoc')->middleware('auth');
Route::get('/documents/trash/restore/{id}', 'DocumentController@restore')->name('restoreDoc')->middleware('auth');
Route::get('/documents/trash/permadelete/{id}', 'DocumentController@permadelete')->name('permadeleteDoc')->middleware('auth');

Route::get('/projects', 'ProjectController@index')->name('projects')->middleware('auth');
Route::get('/projects/{slug}', 'ProjectController@show')->name('project')->middleware('auth');

Route::get('/purchases', 'PurchaseController@index')->name('purchases')->middleware('auth');
Route::get('/purchases/download/{id}', 'PurchaseController@download')->name('downloadInvoice')->middleware('auth');
Route::post('/purchases', 'PurchaseController@create')->name('newPurchase')->middleware('auth');
Route::post('/purchases/edit', 'PurchaseController@edit')->name('editPurchase')->middleware('auth');

Route::get('/stock', 'StockController@index')->name('stock')->middleware('auth');

Route::get('/profile', 'UserController@profile')->name('profile')->middleware('auth');
Route::post('/profile', 'UserController@resetpassword')->name('resetpassword')->middleware('auth');
