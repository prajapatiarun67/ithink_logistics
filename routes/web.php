<?php

use App\Http\Controllers\web\DashboardController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route; 

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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', [UserController::class, 'index'])->name('login');
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/store', [UserController::class, 'store'])->name('store');

Route::middleware('check.api.session')->group(function () {
    Route::get('/change-password', [UserController::class, 'change_password'])->name('change-password');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
