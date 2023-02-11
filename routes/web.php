<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

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

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/dashboard_user', [WebsiteController::class, 'dashboard_user'])->name('dashboard_user')->middleware('auth');
Route::get('/dashboard_admin', [WebsiteController::class, 'dashboard_admin'])->name('dashboard_admin')->middleware('admin');
Route::get('/settings', [WebsiteController::class, 'settings'])->name('settings')->middleware('admin');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');
Route::post('/login-submit', [WebsiteController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');



Route::get('/register', [WebsiteController::class, 'register'])->name('register');
Route::post('/register-submit', [WebsiteController::class, 'register_submit'])->name('register_submit');
Route::get('/register/verify/{token}/{email}', [WebsiteController::class, 'register_verify']);



Route::get('/forget-password', [WebsiteController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password-submit', [WebsiteController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [WebsiteController::class, 'reset_password'])->name('reset_password');
Route::post('/reset_password_submit', [WebsiteController::class, 'reset_password_submit'])->name('reset_password_submit');






