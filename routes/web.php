<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Users
Route::resource('users', UserController::class);

// Packages
Route::resource('packages', PackageController::class);

// Reports
Route::view('/report', 'pages.admin.reports.report')->name('report');


