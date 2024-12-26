<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsPenulis;
use App\Http\Middleware\IsUser;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rute untuk pengguna yang belum login (Guest)
Route::get('/', [UserController::class, 'index']); // Melihat berita
Route::get('/berita/{id}', [UserController::class, 'show']); // Melihat detail berita
Route::get('/berita', [UserController::class, 'index'])->name('berita.index'); // List berita

// Rute Untuk Login dan Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Rute untuk Admin (Akses hanya untuk admin)
Route::middleware([IsAdmin::class])->group(function(){
    Route::get('/admin/berita/index', [AdminController::class, 'showDashboard'])->name('admin.berita.index');
    Route::get('/admin/users', [AdminController::class, 'manageUsers']); // Mengelola pengguna
    Route::get('/admin/categories', [AdminController::class, 'ViewKategori'])->name('admin.kategoriIndex');
    Route::get('/admin/categories/create', [AdminController::class, 'addKategoriForm'])->name('admin.addKategoriForm'); // Form tambah kategori
    Route::post('/admin/categories', [AdminController::class, 'addKategori'])->name('admin.addKategori'); // Menambah kategori
    Route::get('/admin/categories/{id}/edit', [AdminController::class, 'editKategoriForm'])->name('admin.editKategoriForm'); // Form edit kategori
    Route::put('/admin/categories/{id}', [AdminController::class, 'editKategori'])->name('admin.editKategori'); // Mengedit kategori
    Route::delete('/admin/categories/{id}', [AdminController::class, 'deleteKategori'])->name('admin.deleteKategori'); // Menghapus kategori
    Route::get('/admin/users', [adminController::class, 'viewUsers'])->name('admin.user.index');
    Route::get('/admin/users/create', [adminController::class, 'addUserForm'])->name('admin.user.create');
    Route::post('/admin/users', [adminController::class, 'addUser'])->name('admin.user.store');
    Route::get('/admin/users/edit/{id}', [adminController::class, 'editUserForm'])->name('admin.user.edit');
    Route::put('/admin/users/edit/{id}', [adminController::class, 'editUser'])->name('admin.editUser');
    Route::delete('/admin/users/{id}', [adminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/admin/berita', [AdminController::class, 'manageBerita']); // Melihat berita admin
    Route::get('/admin/berita/create', [AdminController::class, 'addberitasForm']); // Form tambah berita
    Route::post('/admin/berita', [AdminController::class, 'addberitas'])->name('addberitas'); // Menambah berita
    Route::get('/admin/berita/{id}/edit', [AdminController::class, 'editberitasForm'])->name('admin.beritas.edit'); // Form edit berita
    Route::put('/admin/berita/{id}', [AdminController::class, 'editberitas'])->name('admin.beritas.update'); // Mengedit berita
    Route::delete('/admin/berita/{id}', [AdminController::class, 'deleteberitas']); // Menghapus berita
    Route::get('/admin/logs', [AdminController::class, 'viewLogs'])->name('admin.viewLogs');
    Route::delete('/admin/logs/{log_id}', [AdminController::class, 'deleteLog'])->name('admin.deleteLog');
});

// Rute untuk User yang sudah login (Akses hanya untuk pengguna yang terdaftar)
Route::middleware([IsUser::class])->group(function(){
    Route::get('/user/berita', [UserController::class, 'index'])->name('user.berita.index'); // List berita
    Route::get('/user/berita/{id}', [UserController::class, 'show']); // Melihat detail berita
    Route::post('/user/comment/{id}', [UserController::class, 'addComment'])->name('user.addComment'); // Menambahkan komentar
    Route::post('/user/rating/{id}', [UserController::class, 'addRating'])->name('user.addRating'); // Menambahkan rating
});
