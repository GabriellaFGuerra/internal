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

Route::middleware('guest')->group(function () {
    Route::get('/forgotpassword', 'Auth\ForgotPasswordController@index')->name('forgotpassword')->middleware('guest');
    Route::post('/forgotpassword', 'Auth\ForgotPasswordController@getemail')->name('getemail')->middleware('guest');

    Route::get('/recovery/{email}/{token}', 'Auth\RecoveryController@index')->name('recovery')->middleware('guest');
    Route::post('/recovery', 'Auth\RecoveryController@recover')->name('recover')->middleware('guest');

    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

    Route::get('/', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('/', 'Auth\LoginController@auth')->name('login.auth')->middleware('guest');

    Route::get('/register', 'UserController@index')->name('register')->middleware('guest');
    Route::post('/register', 'UserController@store')->name('register.store')->middleware('guest');
});

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home.index')->name('home');

    Route::get('/blueprints', 'BlueprintController@index')->name('blueprints');
    Route::get('/blueprints/{slug}', 'BlueprintController@show')->name('blueprint');

    Route::prefix('documents')->group(function () {
        Route::get('/', 'DocumentController@index')->name('documents');
        Route::post('/', 'DocumentController@upload')->name('uploadDoc');
        Route::get('/download/{id}', 'DocumentController@download')->name('downloadDoc');
        Route::get('/delete/{id}', 'DocumentController@delete')->name('deleteDoc');
        Route::get('/trash', 'DocumentController@trash')->name('trashDoc');
        Route::get('/trash/restore/{id}', 'DocumentController@restore')->name('restoreDoc');
        Route::get('/trash/permadelete/{id}', 'DocumentController@permadelete')->name('permadeleteDoc');

    });

    Route::get('/projects', 'ProjectController@index')->name('projects');
    Route::get('/projects/{slug}', 'ProjectController@show')->name('project');

    Route::prefix('purchases')->group(function () {
        Route::get('/', 'PurchaseController@index')->name('purchases');
        Route::get('/download/{id}', 'PurchaseController@download')->name('downloadInvoice');
        Route::post('/', 'PurchaseController@create')->name('newPurchase');
        Route::post('/edit', 'PurchaseController@edit')->name('editPurchase');
    });

    Route::get('/stock', 'StockController@index')->name('stock');

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@resetpassword')->name('resetpassword');

});


