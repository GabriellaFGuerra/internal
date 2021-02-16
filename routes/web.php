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
})->name('blueprints');
Route::get('/blueprints/{slug}', function ($slug) {
    return view('blueprints.blueprint', ['slug' => $slug]);
})->name('blueprint');

Route::get('/documents', function () {
    return view('documents.index');
})->name('documents');
Route::get('/documents/{slug}', function ($slug) {
    return view('documents.document', ['slug' => $slug]);
})->name('document');

Route::get('/projects', function () {
    return view('projects.index');
})->name('projects');
Route::get('/projects/{slug}', function ($slug) {
    return view('projects.project', ['slug' => $slug]);
})->name('project');

Route::get('/purchases', function () {
    return view('purchases.index');
})->name('purchases');

Route::get('/stock', function () {
    return view('stock.index');
})->name('stock');
