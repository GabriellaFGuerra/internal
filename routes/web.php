<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoveryController;
use App\Http\Controllers\BluePrintController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'auth'])->name('login.auth');

    Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
    Route::post('/forgotpassword', [ForgotPasswordController::class, 'getemail'])->name('getemail');

    Route::get('/recovery/{email}/{token}', [RecoveryController::class, 'index'])->name('recovery');
    Route::post('/recovery', [RecoveryController::class, 'recover'])->name('recover');

    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

    Route::prefix('blueprints')->group(function () {
        Route::get('/', [BluePrintController::class, 'index'])->name('blueprints');
        Route::prefix('/{id_project}/{project_name}')->group(function () {
            Route::get('/', [BluePrintController::class, 'show'])->name('blueprint');
            Route::get('/new', [BluePrintController::class, 'create'])->name('createBlueprint');
            Route::post('/new', [BluePrintController::class, 'store'])->name('storeBlueprint');
            Route::get('/download/{id}', [BluePrintController::class, 'download'])->name('downloadBlueprint');
            Route::get('/delete/{id}', [BluePrintController::class, 'delete'])->name('deleteBlueprint');
        });
    });

    Route::prefix('documents')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('documents');
        Route::get('/new', [DocumentController::class, 'create'])->name('createDoc');
        Route::post('/new', [DocumentController::class, 'upload'])->name('uploadDoc');
        Route::get('/download/{id}', [DocumentController::class, 'download'])->name('downloadDoc');
        Route::get('/delete/{id}', [DocumentController::class, 'delete'])->name('deleteDoc');
        Route::get('/trash', [DocumentController::class, 'trash'])->name('trashDoc');
        Route::get('/trash/restore/{id}', [DocumentController::class, 'restore'])->name('restoreDoc');
        Route::get('/trash/permadelete/{id}', [DocumentController::class, 'permadelete'])->name('permadeleteDoc');
    });

    Route::get('/employees', [UserController::class, 'show'])->name('employees');

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects');
        Route::get('/new', [ProjectController::class, 'create'])->name('createProject');
        Route::post('/new', [ProjectController::class, 'store'])->name('storeProject');
        Route::get('/delete/{id}', [ProjectController::class, 'delete'])->name('deleteProject');
        Route::get('/{id}/{name}', [ProjectController::class, 'show'])->name('project');
        Route::get('/{id}/{name}/image/{img}', [ProjectController::class, 'showImages'])->name('showImage');
        Route::get('/{id}/{name}/diary', [ProjectController::class, 'createEntry'])->name('createEntry');
        Route::post('/{id}/{name}/diary', [ProjectController::class, 'storeEntry'])->name('storeEntry');
        Route::get('/{id}/{name}/diary/{entry_id}', [ProjectController::class, 'readEntry'])->name('readEntry');
        Route::get('/{id}/{name}/diary/edit/{entry}', [ProjectController::class, 'editEntry'])->name('editEntryForm');
        Route::post('/{id}/{name}/diary/edit/{entry}', [ProjectController::class, 'updateEntry'])->name('editEntry');
        Route::get('/{id}/{name}/diary/{entry}/download/{id_image}', [ProjectController::class, 'downloadImage'])->name('downloadImage');
        Route::get('/{id}/{name}/diary/{entry}/delete-image/{id_image}', [ProjectController::class, 'deleteImage'])->name('deleteImage');
    });

    Route::get('/image/{image_id}', [ProjectController::class, 'showImage'])->name('showImage');

    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases');
        Route::get('/download/{id}', [PurchaseController::class, 'download'])->name('downloadInvoice');
        Route::get('/new', [PurchaseController::class, 'create'])->name('newPurchase');
        Route::post('/new', [PurchaseController::class, 'store'])->name('storePurchase');
        Route::get('/edit/{id}', [PurchaseController::class, 'edit'])->name('editPurchase');
        Route::post('/edit/{id}', [PurchaseController::class, 'update'])->name('updatePurchase');
        Route::get('/delete/{id}', [PurchaseController::class, 'delete'])->name('deletePurchase');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stock');
        Route::get('/new', [StockController::class, 'create'])->name('createStock');
        Route::post('/new', [StockController::class, 'store'])->name('storeStock');
        Route::get('/edit/{id}', [StockController::class, 'edit'])->name('editItem');
        Route::post('/edit/{id}', [StockController::class, 'update'])->name('updateItem');
        Route::get('/delete/{id}', [StockController::class, 'delete'])->name('deleteItem');
    });

    Route::get('/home', [UserController::class, 'profile'])->name('home');
    Route::post('/home', [UserController::class, 'resetpassword'])->name('resetpassword');
});

