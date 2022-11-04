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

//Auth::routes();


Route::get('/register',[App\Http\Controllers\CustomRegisterController::class,'registerformshow'])->name('register');
Route::post('/register',[App\Http\Controllers\CustomRegisterController::class,'registerUser'])->name('register.store');
Route::get('/login',[App\Http\Controllers\CustomRegisterController::class,'loginformShow'])->name('login');
Route::post('/login',[App\Http\Controllers\CustomRegisterController::class,'loginUser'])->name('login.store');
Route::middleware(['auth'])->group(function(){
Route::post('/logout',[App\Http\Controllers\CustomRegisterController::class,'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
