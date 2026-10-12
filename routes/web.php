<?php

use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\HomePageController as AdminHomePageController;
use App\Http\Controllers\Admin\PasswordController as AdminPasswordController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GitHubWebhookController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('coming-soon');
Route::get('/home', HomeController::class)->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

Route::get('/admin/login', [AdminSessionController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminSessionController::class, 'store'])->middleware('throttle:5,1')->name('admin.login.store');
Route::post('/admin/logout', [AdminSessionController::class, 'destroy'])->middleware(EnsureAdmin::class)->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(EnsureAdmin::class)->group(function (): void {
    Route::redirect('/', '/admin/messages')->name('dashboard');
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{contactMessage}/status', [AdminContactMessageController::class, 'updateStatus'])->name('messages.status');
    Route::get('/home-page', [AdminHomePageController::class, 'edit'])->name('home-page.edit');
    Route::put('/home-page', [AdminHomePageController::class, 'update'])->name('home-page.update');
    Route::get('/password', [AdminPasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [AdminPasswordController::class, 'update'])->name('password.update');
    Route::get('/admins/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/admins', [AdminUserController::class, 'store'])->name('users.store');
});

Route::post('/deploy', GitHubWebhookController::class);
