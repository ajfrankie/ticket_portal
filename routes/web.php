<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\Backend\TicketReplayController;

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

Auth::routes(['login' => false, 'logout' => false, 'verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about-us', [HomeController::class, 'index'])->name('about-us');

// Admin
Route::prefix('/admin')->group(function () {
    // Admin login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    });


     //ticket routes
    Route::prefix('/ticket')->middleware('auth')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/create', [TicketController::class, 'create'])->name('admin.ticket.create');
        Route::post('/store', [TicketController::class, 'store'])->name('admin.ticket.store');
        Route::get('/edit/{id}', [TicketController::class, 'edit'])->name('admin.ticket.edit');
        Route::put('update/{id}', [TicketController::class, 'update'])->name('admin.ticket.update');
        Route::get('delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.destroy');
    });

     Route::prefix('/replay')->middleware('auth')->group(function () {
        Route::get('/', [TicketReplayController::class, 'index'])->name('admin.replay.index');
        Route::get('/create', [TicketReplayController::class, 'create'])->name('admin.replay.create');
        Route::post('/store', [TicketReplayController::class, 'store'])->name('admin.replay.store');
        Route::get('/edit/{id}', [TicketReplayController::class, 'edit'])->name('admin.replay.edit');
        Route::put('update/{id}', [TicketReplayController::class, 'update'])->name('admin.replay.update');
        Route::delete('delete/{id}', [TicketReplayController::class, 'destroy'])->name('admin.replay.destroy');
    });
});


