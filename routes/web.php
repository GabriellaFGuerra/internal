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
    Route::get('/', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('/', 'Auth\LoginController@auth')->name('login.auth')->middleware('guest');

    Route::get('/forgotpassword', 'Auth\ForgotPasswordController@index')->name('forgotpassword')->middleware('guest');
    Route::post('/forgotpassword', 'Auth\ForgotPasswordController@getemail')->name('getemail')->middleware('guest');

    Route::get('/recovery/{email}/{token}', 'Auth\RecoveryController@index')->name('recovery')->middleware('guest');
    Route::post('/recovery', 'Auth\RecoveryController@recover')->name('recover')->middleware('guest');


    Route::get('/register', 'UserController@index')->name('register')->middleware('guest');
    Route::post('/register', 'UserController@store')->name('register.store')->middleware('guest');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

    Route::prefix('blueprints')->group(function () {
        Route::get('/', 'BlueprintController@index')->name('blueprints')->middleware('roleCheck');
        Route::prefix('/{id_project}/{project_name}')->group(function () {
            Route::get('/', 'BlueprintController@show')->name('blueprint');
            Route::get('/new', 'BlueprintController@create')->name('createBlueprint');
            Route::post('/new', 'BlueprintController@store')->name('storeBlueprint');
            Route::get('/download/{id}', 'BlueprintController@download')->name('downloadBlueprint');
            Route::get('/delete/{id}', 'BlueprintController@delete')->name('deleteBlueprint');
        });
    });

    Route::prefix('documents')->group(function () {
        Route::get('/', 'DocumentController@index')->name('documents')->middleware('roleCheck');
        Route::get('/new', 'DocumentController@create')->name('createDoc');
        Route::post('/new', 'DocumentController@upload')->name('uploadDoc');
        Route::get('/download/{id}', 'DocumentController@download')->name('downloadDoc');
        Route::get('/delete/{id}', 'DocumentController@delete')->name('deleteDoc');
        Route::get('/trash', 'DocumentController@trash')->name('trashDoc');
        Route::get('/trash/restore/{id}', 'DocumentController@restore')->name('restoreDoc');
        Route::get('/trash/permadelete/{id}', 'DocumentController@permadelete')->name('permadeleteDoc');
    });

    Route::get('/employees', 'UserController@show')->name('employees')->middleware('roleCheck');

    Route::prefix('projects')->group(function () {
        Route::get('/', 'ProjectController@index')->name('projects')->middleware('roleCheck');
        Route::get('/new', 'ProjectController@create')->name('createProject');
        Route::post('/new', 'ProjectController@store')->name('storeProject');
        Route::get('/{id}/{name}', 'ProjectController@show')->name('project');
        Route::get('/{id}/{name}/image/{img}', 'ProjectController@showImages')->name('showImage');
        Route::get('/{id}/{name}/diary', 'ProjectController@createEntry')->name('createEntry');
        Route::post('/{id}/{name}/diary', 'ProjectController@storeEntry')->name('storeEntry');
        Route::get('/{id}/{name}/diary/{entry_id}', 'ProjectController@readEntry')->name('readEntry');
        Route::get('/{id}/{name}/diary/edit/{entry}', 'ProjectController@editEntry')->name('editEntryForm');
        Route::post('/{id}/{name}/diary/edit/{entry}', 'ProjectController@updateEntry')->name('editEntry');
    });

    Route::get('/image/{image_id}', 'ProjectController@showImage')->name('showImage');


    Route::prefix('purchases')->group(function () {
        Route::get('/', 'PurchaseController@index')->name('purchases')->middleware('roleCheck');
        Route::get('/download/{id}', 'PurchaseController@download')->name('downloadInvoice');
        Route::get('/new', 'PurchaseController@create')->name('newPurchase');
        Route::post('/new', 'PurchaseController@store')->name('storePurchase');
        Route::get('/edit/{id}', 'PurchaseController@edit')->name('editPurchase');
        Route::post('/edit/{id}', 'PurchaseController@update')->name('updatePurchase');
        Route::get('/delete/{id}', 'PurchaseController@delete')->name('deletePurchase');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', 'StockController@index')->name('stock')->middleware('roleCheck');
        Route::get('/new', 'StockController@create')->name('createStock');
        Route::post('/new', 'StockController@store')->name('storeStock');
        Route::get('/edit/{id}', 'StockController@edit')->name('editItem');
        Route::post('/edit/{id}', 'StockController@update')->name('updateItem');
        Route::get('/delete/{id}', 'StockController@delete')->name('deleteItem');
    });

    Route::get('/home', 'UserController@profile')->name('home');
    Route::post('/home', 'UserController@resetpassword')->name('resetpassword');
});
