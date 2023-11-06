<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestGuidelineController;
use App\Http\Controllers\GuestMagazineController;
use App\Http\Controllers\GuestEbookController;
use App\Http\Controllers\GuestPamfletController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuidelineController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\MagazineController;
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

Route::get('/guideline', [GuestGuidelineController::class, 'index'])->name('guest.guideline.index');
Route::get('/guideline/search', [GuestGuidelineController::class, 'search'])->name('guest.guideline.search');
Route::get('/guideline/{guideline_id}', [GuestGuidelineController::class, 'show'])->name('guest.guideline.show');

Route::get('/magazine', [GuestMagazineController::class, 'index'])->name('guest.magazine.index');
Route::get('/magazine/search', [GuestMagazineController::class, 'search'])->name('guest.magazine.search');
Route::get('/magazine/{magazine_id}', [GuestMagazineController::class, 'show'])->name('guest.magazine.show');

Route::get('/ebook', [GuestEbookController::class, 'index'])->name('guest.ebook.index');
Route::get('/ebook/search', [GuestEbookController::class, 'search'])->name('guest.ebook.search');
Route::get('/ebook/{ebook_id}', [GuestEbookController::class, 'show'])->name('guest.ebook.show');

Route::get('/pamflet', [GuestPamfletController::class, 'index'])->name('guest.pamflet.index');
Route::get('/pamflet/search', [GuestPamfletController::class, 'search'])->name('guest.pamflet.search');
Route::get('/pamflet/{pamflet_id}', [GuestPamfletController::class, 'show'])->name('guest.pamflet.show');
Route::get('/pamflet/{pamflet_id}/download', [GuestPamfletController::class, 'download'])->name('guest.pamflet.download');


Auth::routes();

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/dashboard/profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::get('/user/dashboard/profile/setting', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/dashboard/profile/setting', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/user/dashboard/guideline', [GuidelineController::class, 'index'])->name('user.guideline.index');
    Route::get('/user/dashboard/guideline/create', [GuidelineController::class, 'create'])->name('user.guideline.create');
    Route::post('/user/dashboard/guideline/create', [GuidelineController::class, 'store'])->name('user.guideline.store');
    Route::get('/user/dashboard/guideline/{guideline_id}', [GuidelineController::class, 'show'])->name('user.guideline.show');
    Route::get('/user/dashboard/guideline/{guideline_id}/edit', [GuidelineController::class, 'edit'])->name('user.guideline.edit');
    Route::put('/user/dashboard/guideline/{guideline_id}/edit', [GuidelineController::class, 'update'])->name('user.guideline.update');
    Route::delete('/user/dashboard/guideline/{guideline_id}', [GuidelineController::class, 'destroy'])->name('user.guideline.destroy');
    Route::get('/user/dashboard/guideline/{guideline_id}/download', [GuidelineController::class, 'download'])->name('user.guideline.download');

    Route::get('/user/dashboard/magazine', [MagazineController::class, 'index'])->name('user.magazine.index');
    Route::get('/user/dashboard/magazine/create', [MagazineController::class, 'create'])->name('user.magazine.create');
    Route::post('/user/dashboard/magazine/create', [MagazineController::class, 'store'])->name('user.magazine.store');
    Route::get('/user/dashboard/magazine/{magazine_id}', [MagazineController::class, 'show'])->name('user.magazine.show');
    Route::get('/user/dashboard/magazine/{magazine_id}/edit', [MagazineController::class, 'edit'])->name('user.magazine.edit');
    Route::put('/user/dashboard/magazine/{magazine_id}/edit', [MagazineController::class, 'update'])->name('user.magazine.update');
    Route::delete('/user/dashboard/magazine/{magazine_id}', [MagazineController::class, 'destroy'])->name('user.magazine.destroy');
    Route::get('/user/dashboard/magazine/{magazine_id}/download', [MagazineController::class, 'download'])->name('user.magazine.download');

    Route::get('/user/dashboard/ebook', [EbookController::class, 'index'])->name('user.ebook.index');
    Route::get('/user/dashboard/ebook/create', [EbookController::class, 'create'])->name('user.ebook.create');
    Route::post('/user/dashboard/ebook/create', [EbookController::class, 'store'])->name('user.ebook.store');
    Route::get('/user/dashboard/ebook/{ebook_id}', [EbookController::class, 'show'])->name('user.ebook.show');
    Route::get('/user/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'edit'])->name('user.ebook.edit');
    Route::put('/user/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'update'])->name('user.ebook.update');
    Route::delete('/user/dashboard/ebook/{ebook_id}', [EbookController::class, 'destroy'])->name('user.ebook.destroy');
    Route::get('/user/dashboard/ebook/{ebook_id}/download', [EbookController::class, 'download'])->name('user.ebook.download');

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

    Route::get('/admin/dashboard/guideline', [GuidelineController::class, 'index'])->name('admin.guideline.index');
    Route::get('/admin/dashboard/guideline/create', [GuidelineController::class, 'create'])->name('admin.guideline.create');
    Route::post('/admin/dashboard/guideline/create', [GuidelineController::class, 'store'])->name('admin.guideline.store');
    Route::get('/admin/dashboard/guideline/{guideline_id}', [GuidelineController::class, 'show'])->name('admin.guideline.show');
    Route::get('/admin/dashboard/guideline/{guideline_id}/edit', [GuidelineController::class, 'edit'])->name('admin.guideline.edit');
    Route::put('/admin/dashboard/guideline/{guideline_id}/edit', [GuidelineController::class, 'update'])->name('admin.guideline.update');
    Route::delete('/admin/dashboard/guideline/{guideline_id}', [GuidelineController::class, 'destroy'])->name('admin.guideline.destroy');
    Route::get('/admin/dashboard/guideline/{guideline_id}/download', [GuidelineController::class, 'download'])->name('admin.guideline.download');

    Route::get('/admin/dashboard/magazine', [MagazineController::class, 'index'])->name('admin.magazine.index');
    Route::get('/admin/dashboard/magazine/create', [MagazineController::class, 'create'])->name('admin.magazine.create');
    Route::post('/admin/dashboard/magazine/create', [MagazineController::class, 'store'])->name('admin.magazine.store');
    Route::get('/admin/dashboard/magazine/{magazine_id}', [MagazineController::class, 'show'])->name('admin.magazine.show');
    Route::get('/admin/dashboard/magazine/{magazine_id}/edit', [MagazineController::class, 'edit'])->name('admin.magazine.edit');
    Route::put('/admin/dashboard/magazine/{magazine_id}/edit', [MagazineController::class, 'update'])->name('admin.magazine.update');
    Route::delete('/admin/dashboard/magazine/{magazine_id}', [MagazineController::class, 'destroy'])->name('admin.magazine.destroy');
    Route::get('/admin/dashboard/magazine/{magazine_id}/download', [MagazineController::class, 'download'])->name('admin.magazine.download');

    Route::get('/admin/dashboard/ebook', [EbookController::class, 'index'])->name('admin.ebook.index');
    Route::get('/admin/dashboard/ebook/create', [EbookController::class, 'create'])->name('admin.ebook.create');
    Route::post('/admin/dashboard/ebook/create', [EbookController::class, 'store'])->name('admin.ebook.store');
    Route::get('/admin/dashboard/ebook/{ebook_id}', [EbookController::class, 'show'])->name('admin.ebook.show');
    Route::get('/admin/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'edit'])->name('admin.ebook.edit');
    Route::put('/admin/dashboard/ebook/{ebook_id}/edit', [EbookController::class, 'update'])->name('admin.ebook.update');
    Route::delete('/admin/dashboard/ebook/{ebook_id}', [EbookController::class, 'destroy'])->name('admin.ebook.destroy');
    Route::get('/admin/dashboard/ebook/{ebook_id}/download', [EbookController::class, 'download'])->name('admin.ebook.download');

    Route::get('/admin/dashboard/pamflet', [PamfletController::class, 'index'])->name('admin.pamflet.index');
    Route::get('/admin/dashboard/pamflet/create', [PamfletController::class, 'create'])->name('admin.pamflet.create');
    Route::post('/admin/dashboard/pamflet/create', [PamfletController::class, 'store'])->name('admin.pamflet.store');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'show'])->name('admin.pamflet.show');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'edit'])->name('admin.pamflet.edit');
    Route::put('/admin/dashboard/pamflet/{pamflet_id}/edit', [PamfletController::class, 'update'])->name('admin.pamflet.update');
    Route::delete('/admin/dashboard/pamflet/{pamflet_id}', [PamfletController::class, 'destroy'])->name('admin.pamflet.destroy');
    Route::get('/admin/dashboard/pamflet/{pamflet_id}/download', [PamfletController::class, 'download'])->name('admin.pamflet.download');
});

Route::get('/custom-404', function () {
    return view('errors.404');
})->name('custom-404');

Route::get('logout', [LoginController::class,'logout']);
