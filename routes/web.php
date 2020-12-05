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

Route::get('/user/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/user/profile', '\App\Http\Controllers\HomeController@show')->name('profile');
Route::get('/user/timer', '\App\Http\Controllers\TimerController@index')->name('timer');
Route::post('/user/profile', '\App\Http\Controllers\HomeController@update')->name('update_profile');
Route::post('/user/timer', '\App\Http\Controllers\TimerController@ajaxCreate')->name('ajax_create_timer');
Route::post('/user/', '\App\Http\Controllers\SubjectController@create')->name('add_subject');
Route::delete('/user/profile', '\App\Http\Controllers\HomeController@destroy')->name('delete_account');
Route::delete('/user/timer', '\App\Http\Controllers\TimerController@destroy')->name('del_timer_rec');