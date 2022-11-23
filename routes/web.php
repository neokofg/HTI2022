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

Route::name('index')->group(function (){
    Route::view('/', 'index');
    Route::get('/', [\App\Http\Controllers\getdatacontroller::class,'GetAllData']);
});
Route::name('teams')->group(function (){
    Route::view('/teams', 'teams');
    Route::get('/teams', [\App\Http\Controllers\getdatacontroller::class,'GetTeamsData']);
});
Route::name('hackathon')->group(function (){
    Route::view('/hackathon', 'hackathon');
    Route::get('/hackathon', [\App\Http\Controllers\getdatacontroller::class,'GetHackathonData']);
});
Route::name('hackathons')->group(function (){
    Route::view('/hackathons', 'hackathons');
    Route::get('/hackathons', [\App\Http\Controllers\getdatacontroller::class,'GetHackathonsData']);
});
Route::name('team')->group(function (){
    Route::view('/team', 'team');
    Route::get('/team', [\App\Http\Controllers\getdatacontroller::class,'GetTeamData'])->middleware('auth');
});
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/admin', 'admin')->name('admin');
Route::view('/createteam', 'createteam')->name('createteam');

Route::post('/registerNewAccount', [\App\Http\Controllers\authcontroller::class, 'registerNewAccount'])->name('registerNewAccount');
Route::post('/loginInAccount', [\App\Http\Controllers\authcontroller::class, 'loginInAccount'])->name('loginInAccount');
Route::post('/logout', [\App\Http\Controllers\authcontroller::class, 'logout'])->name('logout');
Route::post('/addHackathon', [\App\Http\Controllers\uploadcontroller::class, 'addHackathon'])->name('addHackathon');
Route::post('/addNews', [\App\Http\Controllers\uploadcontroller::class, 'addNews'])->name('addNews');
Route::post('/createTeam', [\App\Http\Controllers\uploadcontroller::class, 'createTeam'])->name('createTeam');
Route::post('/requestToTeam', [\App\Http\Controllers\uploadcontroller::class, 'requestToTeam'])->name('requestToTeam');
Route::post('/acceptRequest', [\App\Http\Controllers\uploadcontroller::class, 'acceptRequest'])->name('acceptRequest');
