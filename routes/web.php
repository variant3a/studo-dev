<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () { return view('welcome'); });
Route::get('/privacy', function () { return view('privacy'); })->name('privacy');

Auth::routes();

Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/profile', [\App\Http\Controllers\HomeController::class, 'show'])->name('profile');
Route::get('/user/timer', [\App\Http\Controllers\TimerController::class, 'index'])->name('timer');
Route::post('/user/profile', [\App\Http\Controllers\HomeController::class, 'update'])->name('update_profile');
Route::delete('/user/profile', [\App\Http\Controllers\HomeController::class, 'destroy'])->name('delete_account');