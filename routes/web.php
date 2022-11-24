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
Route::name('admin')->group(function (){
    Route::view('/admin', 'admin');
    Route::get('/admin', [\App\Http\Controllers\getdatacontroller::class,'GetAdminData'])->middleware('admin');
})->middleware('admin');
Route::name('hackathoneditor')->group(function (){
    Route::view('/hackathoneditor', 'hackathoneditor');
    Route::get('/hackathoneditor', [\App\Http\Controllers\getdatacontroller::class,'GetHackathonEditorData'])->middleware('hackathoneditor');
})->middleware('admin');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/createteam', 'createteam')->name('createteam')->middleware('auth');
Route::view('/private', 'private')->name('private')->middleware('auth');

Route::post('/registerNewAccount', [\App\Http\Controllers\authcontroller::class, 'registerNewAccount'])->name('registerNewAccount');
Route::post('/loginInAccount', [\App\Http\Controllers\authcontroller::class, 'loginInAccount'])->name('loginInAccount');
Route::post('/logout', [\App\Http\Controllers\authcontroller::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/addHackathon', [\App\Http\Controllers\uploadcontroller::class, 'addHackathon'])->name('addHackathon')->middleware('admin');
Route::post('/addNews', [\App\Http\Controllers\uploadcontroller::class, 'addNews'])->name('addNews')->middleware('admin');
Route::post('/addTrack', [\App\Http\Controllers\uploadcontroller::class, 'addTrack'])->name('addTrack')->middleware('admin');
Route::post('/editHackathon', [\App\Http\Controllers\uploadcontroller::class, 'editHackathon'])->name('editHackathon')->middleware('admin');
Route::post('/deleteHackathon', [\App\Http\Controllers\uploadcontroller::class, 'deleteHackathon'])->name('deleteHackathon')->middleware('admin');
Route::post('/createTeam', [\App\Http\Controllers\uploadcontroller::class, 'createTeam'])->name('createTeam')->middleware('auth');
Route::post('/requestToTeam', [\App\Http\Controllers\uploadcontroller::class, 'requestToTeam'])->name('requestToTeam')->middleware('auth');
Route::post('/acceptRequest', [\App\Http\Controllers\uploadcontroller::class, 'acceptRequest'])->name('acceptRequest')->middleware('auth');
Route::post('/declineRequest', [\App\Http\Controllers\uploadcontroller::class, 'declineRequest'])->name('declineRequest')->middleware('auth');
Route::post('/participate', [\App\Http\Controllers\uploadcontroller::class, 'participate'])->name('participate')->middleware('auth');
