<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'showRegisterform'])->name('register');
Route::post('/register',[AuthController::class,'register']);


Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);




// grp route middleware with auth
Route::middleware(['auth'])->group(function(){
    // Route::get('/dashboard',function (){
    //     return view('dashboard');
    // });
    Route::get('/dashboard',[TodoController::class,'index'])->name('dashboard');
    Route::post('/dashboard',[TodoController::class,'store'])->name('create.store');
    Route::delete('/dashboard/{id}',[TodoController::class,'destroy'])->name('post.delete');
    Route::get('/dashboard/{id}/edit',[TodoController::class,'edit'])->name('post.edit');
    Route::put('/dashboard/{id}',[TodoController::class,'update'])->name('post.update');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
