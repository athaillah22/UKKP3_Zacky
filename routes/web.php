<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController; 
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\PengaduanController as CustomerPengaduanController; 
use App\Http\Controllers\Customer\ProfileController; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Route Autentikasi Manual
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
     ->middleware('auth')
     ->name('logout');

/*
|--------------------------------------------------------------------------
| Route Khusus Admin
| - auth: harus login
| - role:admin: harus punya role admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
             ->name('dashboard');

        // CRUD User
        Route::resource('users', UserController::class);
        
        // CRUD Kategori
        Route::resource('kategori', KategoriController::class);
        
        // CRUD Pengaduan (Admin)
        Route::resource('pengaduan', AdminPengaduanController::class);
        
    });

/*
|--------------------------------------------------------------------------
| Route Khusus Customer
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        
        // Pengaduan (Hanya index, create, store, show untuk customer)
        Route::resource('pengaduan', CustomerPengaduanController::class)->only(['index', 'create', 'store', 'show']);
        
        // Edit Profil
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });