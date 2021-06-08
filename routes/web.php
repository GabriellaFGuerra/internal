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

    Route::get('/', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('/', 'Auth\LoginController@auth')->name('login.auth')->middleware('guest');

    Route::get('/register', 'UserController@index')->name('register')->middleware('guest');
    Route::post('/register', 'UserController@store')->name('register.store')->middleware('guest');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');
    Route::view('/home', 'home.index')->name('home')->middleware('roleCheck');

    Route::prefix('blueprints')->group(function () {
        Route::get('/', 'BlueprintController@index')->name('blueprints')->middleware('roleCheck');
        Route::get('/{id_project}/{project_name}', 'BlueprintController@show')->name('blueprint');
        Route::post('/{id_project}/{project_name}', 'BlueprintController@upload')->name('uploadBlueprint');
        Route::get('/{id_project}/{project_name}/download/{id}', 'BlueprintController@download')->name('downloadBlueprint');
    });

    Route::prefix('documents')->group(function () {
        Route::get('/', 'DocumentController@index')->name('documents')->middleware('roleCheck');
        Route::post('/', 'DocumentController@upload')->name('uploadDoc');
        Route::get('/download/{id}', 'DocumentController@download')->name('downloadDoc');
        Route::get('/delete/{id}', 'DocumentController@delete')->name('deleteDoc');
        Route::get('/trash', 'DocumentController@trash')->name('trashDoc');
        Route::get('/trash/restore/{id}', 'DocumentController@restore')->name('restoreDoc');
        Route::get('/trash/permadelete/{id}', 'DocumentController@permadelete')->name('permadeleteDoc');
    });

    Route::get('/employees/', 'UserController@show')->name('employees')->middleware('roleCheck');

    Route::prefix('projects')->group(function () {
        Route::get('/', 'ProjectController@index')->name('projects')->middleware('roleCheck');
        Route::post('/', 'ProjectController@create')->name('newProject');
        Route::get('/{id}/{name}', 'ProjectController@show')->name('project');
        Route::get('/{id}/{name}/image/{img}', 'ProjectController@showImages')->name('showImage');
        Route::get('/{id}/{name}/diary', 'ProjectController@newEntryIndex')->name('newEntry');
        Route::post('/{id}/{name}/diary', 'ProjectController@newEntryCreate')->name('createEntry');
        Route::get('/{id}/{name}/diary/{entry_id}', 'ProjectController@readEntry')->name('readEntry');
        Route::get('/{id}/{name}/diary/edit/{entry}', 'ProjectController@entryEditIndex')->name('editEntryForm');
        Route::post('/{id}/{name}/diary/edit/{entry}', 'ProjectController@entryEdit')->name('editEntry');
    });

    Route::get('/image/{image_id}', 'ProjectController@showImage')->name('showImage');


    Route::prefix('purchases')->group(function () {
        Route::get('/', 'PurchaseController@index')->name('purchases')->middleware('roleCheck');
        Route::get('/download/{id}', 'PurchaseController@download')->name('downloadInvoice');
        Route::post('/', 'PurchaseController@create')->name('newPurchase');
        Route::post('/edit', 'PurchaseController@edit')->name('editPurchase');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', 'StockController@index')->name('stock')->middleware('roleCheck');
        Route::post('/', 'StockController@create')->name('newStock');
        Route::post('/edit', 'StockController@edit')->name('editStock');
    });

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@resetpassword')->name('resetpassword');
});


