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

Auth::routes(['verify' => true]);

Route::get('/user/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/user/profile', '\App\Http\Controllers\HomeController@show')->name('profile');
Route::get('/user/timer', '\App\Http\Controllers\TimerController@index')->name('timer');
Route::get('/user/quiz/index', '\App\Http\Controllers\QuizController@index')->name('quiz');
Route::get('/user/quiz/create', '\App\Http\Controllers\QuizController@createView')->name('create_quiz');
Route::get('/user/quiz/{id}/details', '\App\Http\Controllers\QuizController@show')->name('quiz_details');
Route::get('/user/notepad/index', '\App\Http\Controllers\NotepadController@index')->name('notepad');
Route::get('/user/notepad/{id}/details', '\App\Http\Controllers\NotepadController@show')->name('notepad_details');
Route::get('/user/notepad/{id}/note', '\App\Http\Controllers\NotepadController@edit')->name('edit_note');
Route::post('/user/timer', '\App\Http\Controllers\TimerController@ajaxCreate')->name('ajax_create_timer');
Route::post('/user/notepad', '\App\Http\Controllers\NotepadController@create')->name('create_note');
Route::post('/user/quiz/index', '\App\Http\Controllers\QuizController@store')->name('store_quiz');
Route::post('/user/quiz/{id}/details', '\App\Http\Controllers\QuizController@ajaxUpdate')->name('store_result');
Route::post('/user/timer/create', '\App\Http\Controllers\SubjectController@create')->name('add_subject');
Route::put('/user/profile', '\App\Http\Controllers\HomeController@update')->name('update_profile');
Route::put('/user/notepad/{id}/edit', '\App\Http\Controllers\NotepadController@update')->name('update_note');
Route::delete('/user/profile', '\App\Http\Controllers\HomeController@destroy')->name('delete_account');
Route::delete('/user/profile/{id}', '\App\Http\Controllers\SubjectController@destroy')->name('delete_subject');
Route::delete('/user/timer', '\App\Http\Controllers\TimerController@destroy')->name('del_timer_rec');
Route::delete('/user/notepad/{id}/details', '\App\Http\Controllers\NotepadController@destroy')->name('delete_note');
Route::delete('/user/quiz/{id}/details', '\App\Http\Controllers\QuizController@destroy')->name('delete_quiz');
