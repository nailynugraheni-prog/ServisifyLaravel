<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\User\ArticleController as UserArticleController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// USER ROUTES
Route::middleware('auth.session')->prefix('user')->name('user.')->group(function () {
    // Katalog
    Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');

    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('keranjang.add');
    Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('keranjang.remove');
    Route::post('/keranjang/update', [CartController::class, 'update'])->name('keranjang.update');

    // Pembayaran
    Route::get('/pembayaran', [UserTransactionController::class, 'showPayment'])->name('pembayaran');
    Route::post('/pembayaran/proses', [UserTransactionController::class, 'processPayment'])->name('pembayaran.proses');

    // Artikel
    Route::get('/artikel', [UserArticleController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{slug}', [UserArticleController::class, 'show'])->name('artikel.show');

    // History
    Route::get('/history', [UserTransactionController::class, 'history'])->name('history.index');
    Route::get('/history/{id}', [UserTransactionController::class, 'historyDetail'])->name('history.show');
});

// ADMIN ROUTES
Route::middleware('auth.admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Produk
    Route::get('/produk', [AdminProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [AdminProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [AdminProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [AdminProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [AdminProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [AdminProductController::class, 'destroy'])->name('produk.destroy');

    // Pengguna
    Route::get('/pengguna', [AdminUserController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [AdminUserController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [AdminUserController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [AdminUserController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [AdminUserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [AdminUserController::class, 'destroy'])->name('pengguna.destroy');

    // Artikel
    Route::get('/artikel', [AdminArticleController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/create', [AdminArticleController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [AdminArticleController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [AdminArticleController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [AdminArticleController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [AdminArticleController::class, 'destroy'])->name('artikel.destroy');
    Route::patch('/artikel/{id}/status', [AdminArticleController::class, 'updateStatus'])->name('artikel.status');

    // Transaksi
    Route::get('/transaksi', [AdminTransactionController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [AdminTransactionController::class, 'show'])->name('transaksi.show');
    Route::put('/transaksi/{id}', [AdminTransactionController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [AdminTransactionController::class, 'destroy'])->name('transaksi.destroy');
});

// Redirect root
Route::get('/', function () {
    if (session('user')) {
        $user = session('user');
        return $user['role'] === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.katalog.index');
    }
    return redirect()->route('login');
});