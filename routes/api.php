<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\Backend\TicketReplayController;
use App\Http\Controllers\Frontend\FrontloginController;
use App\Http\Controllers\Frontend\FrontRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [FrontloginController::class, 'login']);
Route::post('/register', [FrontRegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [FrontloginController::class, 'logout']);
Route::middleware('auth:sanctum')->post('admin/ticket/store', [TicketReplayController::class, 'store']); // admin/ticket/store;


Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {
    // Admin login routes (commented)
    // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    // Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');

    // Ticket routes
    Route::prefix('/ticket')->group(function () {
        Route::post('/store', [TicketController::class, 'store']);           // admin/ticket/store
        Route::put('/update/{id}', [TicketController::class, 'update']);     // admin/ticket/update/{id}
        Route::get('/delete/{id}', [TicketController::class, 'destroy']);    // admin/ticket/delete/{id}
    });

    // Replay routes
    Route::prefix('/replay')->group(function () {});

    Route::get('/test-auth', function (Request $request) {
        return response()->json([
            'user_id' => auth()->id(),
            'user' => $request->user(),
        ]);
    });
});
