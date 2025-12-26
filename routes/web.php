<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/tentangKami', [WebController::class, 'tentang'])->name('tentangKami');

Route::get('/produkKami', [WebController::class, 'produk'])->name('produkKami');
Route::get('/detailProduk/{slug}', [WebController::class, 'detailProduk'])->name('detailProduk');
Route::get('/pesanProduk', [WebController::class, 'pesanProduk'])->name('pesanProduk');
Route::get('/cariProduk', [ProdukController::class, 'search'])->name('cariProduk');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('cekLogin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/edit{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('user/update{id}', [UserController::class, 'update'])->name('userUpdate');

    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategoriStore');
    Route::post('kategori/update{id}', [KategoriController::class, 'update'])->name('kategoriUpdate');
    Route::delete('kategori/destroy{id}', [KategoriController::class, 'destroy'])->name('kategoriDestroy');

    Route::get('produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produkCreate');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produkStore');
    Route::get('produk/edit{id}', [ProdukController::class, 'edit'])->name('produkEdit');
    Route::post('produk/update{id}', [ProdukController::class, 'update'])->name('produkUpdate');
    Route::delete('produk/destroy{id}', [ProdukController::class, 'destroy'])->name('produkDestroy');

    Route::get('faq', [FaqController::class, 'index'])->name('faq');
    Route::get('faq/create', [FaqController::class, 'create'])->name('faqCreate');
    Route::post('faq/store', [FaqController::class, 'store'])->name('faqStore');
    Route::get('faq/edit{id}', [FaqController::class, 'edit'])->name('faqEdit');
    Route::post('faq/update{id}', [FaqController::class, 'update'])->name('faqUpdate');
    Route::delete('faq/destroy{id}', [FaqController::class, 'destroy'])->name('faqDestroy');

});