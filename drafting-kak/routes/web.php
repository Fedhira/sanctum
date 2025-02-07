<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

// **Halaman login sebagai halaman awal**
Route::get('/', function () {
    return view('auth.login'); // Menampilkan halaman login
})->name('login');

// **Menampilkan halaman login**
Route::get('/login', function () {
    return view('auth.login'); // Pastikan file ada di resources/views/auth/login.blade.php
})->name('login');

// **Logout - Redirect ke login setelah logout**
Route::get('/logout', function () {
    return redirect('/login')->with('status', 'Logged out successfully');
})->name('logout');


// **Dashboard untuk setiap role**
Route::middleware(['auth:sanctum'])->group(function () {
    // **Dashboard Admin**
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/kategori', [AdminController::class, 'kategori'])->name('admin.kategori');
        Route::get('/daftar', [AdminController::class, 'daftar'])->name('admin.daftar');
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
        Route::get('/faq', [AdminController::class, 'faq'])->name('admin.faq');

        // CRUD Users
        Route::post('/users/store', [AdminController::class, 'store'])->name('admin.users.store');
        Route::post('/users/update/{id}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

        // CRUD Kategori
        Route::post('/kategori/store', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
        Route::post('/kategori/update/{id}', [AdminController::class, 'updateKategori'])->name('admin.kategori.update');
        Route::delete('/kategori/{id}', [AdminController::class, 'destroyKategori'])->name('admin.kategori.destroy');
    });

    // **Dashboard Staff/User**
    Route::middleware([RoleMiddleware::class . ':staff'])->prefix('user')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/daftar', [UserController::class, 'daftar'])->name('user.daftar');
        Route::get('/draft', [UserController::class, 'draft'])->name('user.draft');
        Route::get('/add_draft', [UserController::class, 'add_draft'])->name('user.add_draft');
        Route::get('/edit_draft/{id}', [UserController::class, 'edit_draft'])->name('user.edit_draft');
        Route::get('/upload_draft/{id}', [UserController::class, 'upload_draft'])->name('user.upload_draft');
        Route::get('/laporan', [UserController::class, 'laporan'])->name('user.laporan');
        Route::get('/faq', [UserController::class, 'faq'])->name('user.faq');

        // CRUD Draft
        Route::post('/draft/store', [UserController::class, 'store'])->name('user.draft.store');
        Route::post('/draft/update/{id}', [UserController::class, 'update'])->name('user.draft.update');
        Route::delete('/draft/{id}', [UserController::class, 'destroy'])->name('user.draft.destroy');
    });

    // **Dashboard Supervisor**
    Route::middleware([RoleMiddleware::class . ':supervisor'])->prefix('supervisor')->group(function () {
        Route::get('/index', [SupervisorController::class, 'index'])->name('supervisor.index');
        Route::get('/daftar', [SupervisorController::class, 'daftar'])->name('supervisor.daftar');
        Route::get('/laporan', [SupervisorController::class, 'laporan'])->name('supervisor.laporan');
        Route::get('/faq', [SupervisorController::class, 'faq'])->name('supervisor.faq');

        // Menyetujui & Menolak KAK
        Route::post('/kak/reject', [SupervisorController::class, 'rejectKak'])->name('supervisor.kak.reject');
        Route::post('/kak/disetujui/{id}', [SupervisorController::class, 'approve'])->name('supervisor.approve');
    });
});
