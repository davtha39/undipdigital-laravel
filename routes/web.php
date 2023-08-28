<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestEbookController;
use App\Http\Controllers\GuestEjournalController;
use App\Http\Controllers\GuestPamfletController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EjournalController;
use App\Http\Controllers\PamfletController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index'])->name('guest.home');
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'attemptLogin']);

Route::get('/ebook', [GuestEbookController::class, 'index'])->name('guest.ebook.index');
Route::get('/ebook/search', [GuestEbookController::class, 'search'])->name('guest.ebook.search');
Route::get('/ebook/{ebook_id}', [GuestEbookController::class, 'show'])->name('guest.ebook.show');

Route::get('/ejournal', [GuestEjournalController::class, 'index'])->name('guest.ejournal.index');
Route::get('/ejournal/search', [GuestEjournalController::class, 'search'])->name('guest.ejournal.search');
Route::get('/ejournal/{ejournal_id}', [GuestEjournalController::class, 'show'])->name('guest.ejournal.show');

Route::get('/pamflet', [GuestPamfletController::class, 'index'])->name('guest.pamflet.index');
Route::get('/pamflet/search', [GuestPamfletController::class, 'search'])->name('guest.pamflet.search');
Route::get('/pamflet/{pamflet_id}', [GuestPamfletController::class, 'show'])->name('guest.pamflet.show');

Auth::routes();

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/dashboard/profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::get('/user/dashboard/profile/setting', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/dashboard/profile/setting', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/user/dashboard/ebook', [EbookController::class, 'index'])->name('user.ebook.index');
    Route::get('/user/dashboard/ebook/create', [EbookController::class, 'create'])->name('user.ebook.create');
    Route::post('/user/dashboard/ebook/create', [EbookController::class, 'store'])->name('user.ebook.store');
    Route::get('/user/dashboard/ebook/{ebook_id}', [EbookController::class, 'show'])->name('user.ebook.show');
    Route::get('/user/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'edit'])->name('user.ebook.edit');
    Route::put('/user/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'update'])->name('user.ebook.update');
    Route::delete('/user/dashboard/ebook/{ebook_id}', [EbookController::class, 'destroy'])->name('user.ebook.destroy');
    Route::get('/user/dashboard/ebook/{ebook_id}/download', [EbookController::class, 'download'])->name('user.ebook.download');

    Route::get('/user/dashboard/ejournal', [EjournalController::class, 'index'])->name('user.ejournal.index');
    Route::get('/user/dashboard/ejournal/create', [EjournalController::class, 'create'])->name('user.ejournal.create');
    Route::post('/user/dashboard/ejournal/create', [EjournalController::class, 'store'])->name('user.ejournal.store');
    Route::get('/user/dashboard/ejournal/{ejournal_id}', [EjournalController::class, 'show'])->name('user.ejournal.show');
    Route::get('/user/dashboard/ejournal/{ejournal_id}/edit', [EjournalController::class, 'edit'])->name('user.ejournal.edit');
    Route::put('/user/dashboard/ejournal/{ejournal_id}/edit', [EjournalController::class, 'update'])->name('user.ejournal.update');
    Route::delete('/user/dashboard/ejournal/{ejournal_id}', [EjournalController::class, 'destroy'])->name('user.ejournal.destroy');
    Route::get('/user/dashboard/ejournal/{ejournal_id}/download', [EjournalController::class, 'download'])->name('user.ejournal.download');

    Route::get('/user/dashboard/pamflet', [PamfletController::class, 'index'])->name('user.pamflet.index');
    Route::get('/user/dashboard/pamflet/create', [PamfletController::class, 'create'])->name('user.pamflet.create');
    Route::post('/user/dashboard/pamflet/create', [PamfletController::class, 'store'])->name('user.pamflet.store');
    Route::get('/user/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'show'])->name('user.pamflet.show');
    Route::get('/user/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'edit'])->name('user.pamflet.edit');
    Route::put('/user/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'update'])->name('user.pamflet.update');
    Route::delete('/user/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'destroy'])->name('user.pamflet.destroy');
    Route::get('/user/dashboard/pamflet/{pamflet_id}/download', [PamfletController::class, 'download'])->name('user.pamflet.download');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/admin/dashboard/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/admin/dashboard/profile/setting', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/dashboard/profile/setting', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/dashboard/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/dashboard/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/dashboard/user/create', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/dashboard/user/{users_id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/dashboard/user/{users_id}/edit', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/dashboard/user/{users_id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin/dashboard/ebook', [EbookController::class, 'index'])->name('admin.ebook.index');
    Route::get('/admin/dashboard/ebook/create', [EbookController::class, 'create'])->name('admin.ebook.create');
    Route::post('/admin/dashboard/ebook/create', [EbookController::class, 'store'])->name('admin.ebook.store');
    Route::get('/admin/dashboard/ebook/{ebook_id}', [EbookController::class, 'show'])->name('admin.ebook.show');
    Route::get('/admin/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'edit'])->name('admin.ebook.edit');
    Route::put('/admin/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'update'])->name('admin.ebook.update');
    Route::delete('/admin/dashboard/ebook/{ebook_id}', [EbookController::class, 'destroy'])->name('admin.ebook.destroy');
    Route::get('/admin/dashboard/ebook/{ebook_id}/download', [EbookController::class, 'download'])->name('admin.ebook.download');

    Route::get('/admin/dashboard/ejournal', [EjournalController::class, 'index'])->name('admin.ejournal.index');
    Route::get('/admin/dashboard/ejournal/create', [EjournalController::class, 'create'])->name('admin.ejournal.create');
    Route::post('/admin/dashboard/ejournal/create', [EjournalController::class, 'store'])->name('admin.ejournal.store');
    Route::get('/admin/dashboard/ejournal/{ejournal_id}', [EjournalController::class, 'show'])->name('admin.ejournal.show');
    Route::get('/admin/dashboard/ejournal/{ejournal_id}/edit', [EjournalController::class, 'edit'])->name('admin.ejournal.edit');
    Route::put('/admin/dashboard/ejournal/{ejournal_id}/edit', [EjournalController::class, 'update'])->name('admin.ejournal.update');
    Route::delete('/admin/dashboard/ejournal/{ejournal_id}', [EjournalController::class, 'destroy'])->name('admin.ejournal.destroy');
    Route::get('/admin/dashboard/ejournal/{ejournal_id}/download', [EjournalController::class, 'download'])->name('admin.ejournal.download');

    Route::get('/admin/dashboard/pamflet', [PamfletController::class, 'index'])->name('admin.pamflet.index');
    Route::get('/admin/dashboard/pamflet/create', [PamfletController::class, 'create'])->name('admin.pamflet.create');
    Route::post('/admin/dashboard/pamflet/create', [PamfletController::class, 'store'])->name('admin.pamflet.store');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'show'])->name('admin.pamflet.show');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'edit'])->name('admin.pamflet.edit');
    Route::put('/admin/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'update'])->name('admin.pamflet.update');
    Route::delete('/admin/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'destroy'])->name('admin.pamflet.destroy');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}/download', [PamfletController::class, 'download'])->name('admin.pamflet.download');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [LoginController::class,'logout']);
