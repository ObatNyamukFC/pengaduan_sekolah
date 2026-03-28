<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsSiswa;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Halaman login
Route::get('/', function () {
    return view('login_siswa');
})->name('login.siswa');

Route::get('/login-admin', function () {
    return view('login_admin');
})->name('login.admin');

// Proses login & logout
Route::post('/login-siswa/proses', [AuthController::class, 'prosesLoginSiswa'])->name('login.siswa.proses');
Route::post('/login-admin/proses', [AuthController::class, 'prosesLoginAdmin'])->name('login.admin.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Siswa
Route::middleware([IsSiswa::class])->group(function () {
    Route::get('/siswa/aspirasi', [SiswaController::class, 'index'])->name('siswa.aspirasi');
    Route::post('/siswa/aspirasi/store', [SiswaController::class, 'store'])->name('siswa.aspirasi.store');
    Route::get('/siswa/aspirasi/{id}', [SiswaController::class, 'show'])->name('siswa.aspirasi.show');
});

// Area Admin
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/aspirasi/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.update');
});