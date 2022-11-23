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

Route::view('/', 'index')->name('index');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

Route::post('/registerNewAccount', [\App\Http\Controllers\authcontroller::class, 'registerNewAccount'])->name('registerNewAccount');
Route::post('/loginInAccount', [\App\Http\Controllers\authcontroller::class, 'loginInAccount'])->name('loginInAccount');
Route::post('/logout', [\App\Http\Controllers\authcontroller::class, 'logout'])->name('logout');

