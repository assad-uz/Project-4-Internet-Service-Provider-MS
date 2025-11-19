<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\DistributionBoxController;

Route::get('/', function () {
    return view('pages.portal.home');
})->name('home');

// Newsletter Subscription 
// (POST method for form submission)
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
// (GET method for See the List)
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('admin.newsletters.index');
// (DELETE method)
Route::delete('/newsletter/{subscription}', [NewsletterController::class, 'destroy'])->name('admin.newsletters.destroy');

// Admin Route

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Users
Route::resource('users', UserController::class);

// Customer types
Route::resource('customer_types', CustomerTypeController::class);

// Packages
Route::resource('packages', PackageController::class);

// Areas
Route::resource('areas', AreaController::class);

// Distribution Box
Route::resource('distribution_boxes', DistributionBoxController::class);

// Customers
Route::resource('customers', CustomerController::class);

// Connections
Route::resource('connections', ConnectionController::class);

// Billings
Route::get('billings/{billing}/invoice', [BillingController::class, 'invoice'])->name('billings.invoice');
Route::resource('billings', BillingController::class);

// Payments
Route::resource('payments', PaymentController::class);

// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('pages.admin.reports.index');
