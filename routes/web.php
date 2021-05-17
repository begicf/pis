<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/create_event', ['middleware' => 'auth', 'uses' => '\App\Http\Controllers\Calendar@index'])->name('create_event');
Route::any('/new_create', ['middleware' => 'auth', 'uses' => '\App\Http\Controllers\Calendar@event'])->name('new_create');

