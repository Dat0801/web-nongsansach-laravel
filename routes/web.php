<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WeightController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Client\Auth\LoginController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Controllers\Client\Auth\VerificationController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;


Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/dashboard', 301);

    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/login/store', [AdminLoginController::class, 'store'])->name('admin.login.store');

    Route::middleware(['auth.employee'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('/product/trash', [AdminProductController::class, 'trash'])->name('product.trash');
        Route::get('/product/restore/{id}', [AdminProductController::class, 'restore'])->name('product.restore');

        Route::resource('/category', CategoryController::class);
        Route::resource('/unit', UnitController::class);
        Route::resource('/weight', WeightController::class);
        Route::resource('/product', AdminProductController::class);
        Route::resource('/image', ImageController::class);
        Route::resource('/user', UserController::class);
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/checkout', [HomeController::class, 'index'])->name('checkout');
Route::get('/forgot-password', [HomeController::class, 'index'])->name('forgot-password');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::prefix('cart')->group(function () {
    Route::get('/cart-badge', [CartController::class, 'cartBadge']);
    Route::get('/cart-table', [CartController::class, 'cartTable']);
    Route::get('/empty-cart', [CartController::class, 'emptyCart'])->name('cart.emptyCart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::get('/add-to-cart-ajax/{id}', [CartController::class, 'addToCartAjax'])->name('cart.addToCartAjax');
    Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::get('/update-cart', [CartController::class, 'updateCart'])->name('cart.updateCart');
});

Route::middleware(['cart.notEmpty'])->group(function () {
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/verify-user', [CheckoutController::class, 'verifyUser'])->name('checkout.verifyUser');
        Route::middleware(['checkout.isFilled'])->group(function () {
            Route::get('/verify', [CheckoutController::class, 'getVerify'])->name('checkout.verify.index');
            Route::post('/verify', [CheckoutController::class, 'postVerify'])->name('checkout.verify');
            Route::get('/store', [CheckoutController::class, 'store'])->name('checkout.store');
            Route::get('/check-vnpay', [CheckoutController::class, 'checkVnpay'])->name('checkout.checkVnpay');
        });
    });
});



Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/category/{category}', [ProductController::class, 'showByCategory'])->name('product.category');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});