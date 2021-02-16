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

Route::view('/', 'home.index')->name('home');

Route::get('/blueprints', function () {
    return view('blueprints.index');
});
Route::get('/blueprints/{slug}', function () {
    return view('blueprints.blueprint');
});

Route::get('/documents', function () {
    return view('documents.index');
});
Route::get('/documents/{slug}', function () {
    return view('documents.document');
});

Route::get('/projects', function () {
    return view('projects.index');
});
Route::get('/projects/{slug}', function () {
    return view('projects.project');
});

Route::get('/purchases', function () {
   return view('purchases.index');
});

Route::get('/stock', function () {
    return view('stock.index');
});
