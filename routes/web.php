<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');



Route::middleware(['guest'])->group(function () {
    Route::get('/login',[AuthController::class,'loginPage'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('send.login');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('user',UserController::class);
    Route::resource('post',PostController::class);
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/home',[HomeController::class,'index'])->name('home');

});

