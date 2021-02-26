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

Route::view('/', 'index')->name('login');
Route::view('/home', 'home.index')->name('home');

Route::get('/blueprints', 'BlueprintController@index')->name('blueprints');
Route::get('/blueprints/{slug}', 'BlueprintController@show')->name('blueprint');

Route::get('/documents', 'DocumentController@index')->name('documents');

Route::get('/projects', 'ProjectController@index')->name('projects');
Route::get('/projects/{slug}', 'ProjectController@show')->name('project');

Route::get('/purchases', 'PurchaseController@index')->name('purchases');

Route::get('/stock', 'StockController@index')->name('stock');
