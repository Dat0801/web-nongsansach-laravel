<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WeightController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\UserController;


Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login/store', [LoginController::class, 'store']);

    Route::middleware(['auth.employee'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [LogoutController::class, 'index'])->name('admin.logout');
        Route::get('/product/trash', [ProductController::class, 'trash'])->name('product.trash');
        Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');

        Route::resource('/category', CategoryController::class);
        Route::resource('/unit', UnitController::class);
        Route::resource('/weight', WeightController::class);
        Route::resource('/product', ProductController::class);
        Route::resource('/image', ImageController::class);
        Route::resource('/user', UserController::class);
    });
});