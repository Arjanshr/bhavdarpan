<?php

use App\Http\Controllers\GitHubWebhookController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('coming-soon');
Route::view('/home', 'home')->name('home');

Route::post('/deploy', GitHubWebhookController::class);
