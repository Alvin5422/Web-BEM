<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAspirationController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationCenterController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Publik)
|--------------------------------------------------------------------------
*/

// 1. Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Tentang BEM
Route::get('/tentang', [AboutController::class, 'index'])->name('about');

// 3. Berita & Kegiatan
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// 4. Pusat Informasi (5 Tab: Proker, Kalender, Timeline, Galeri, Aspirasi)
Route::get('/informasi', [InformationCenterController::class, 'index'])->name('information.index');
Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspirations.store');
Route::get('/aspirasi/lacak', [AspirationController::class, 'track'])->name('aspirations.track');

// 5. Hubungi Kami
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::redirect('/login', '/admin/login')->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Panel Administrasi Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil BEM
    Route::get('/profil', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profil', [AdminProfileController::class, 'update'])->name('profile.update');

    // Kepengurusan & Periode
    Route::resource('periods', PeriodController::class)->except(['show']);
    Route::post('periods/{period}/toggle-active', [PeriodController::class, 'toggleActive'])->name('periods.toggle-active');
    Route::resource('members', MemberController::class)->except(['show']);

    // Publikasi & Kategori
    Route::resource('posts', AdminPostController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);

    // Program Kerja & Agenda
    Route::resource('programs', AdminProgramController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);

    // Media & Dokumentasi
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Ruang Aspirasi
    Route::get('/aspirations', [AdminAspirationController::class, 'index'])->name('aspirations.index');
    Route::get('/aspirations/{aspiration}', [AdminAspirationController::class, 'show'])->name('aspirations.show');
    Route::put('/aspirations/{aspiration}/status', [AdminAspirationController::class, 'updateStatus'])->name('aspirations.update-status');
    Route::delete('/aspirations/{aspiration}', [AdminAspirationController::class, 'destroy'])->name('aspirations.destroy');

    // Kotak Masuk
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::put('/messages/{message}/notes', [MessageController::class, 'updateNotes'])->name('messages.update-notes');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Pengaturan Website
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Manajemen Akun Admin
    Route::resource('users', UserController::class)->except(['show', 'create', 'edit']);
});
