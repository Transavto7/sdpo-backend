<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/versions/list', [VersionController::class, 'list']);
Route::get('/versions/download/{version}', [VersionController::class, 'download']);

Route::middleware('auth')->group(function () {
    Route::resource('/versions', VersionController::class);
});
