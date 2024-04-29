<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/post', [PostController::class,'index'])->name('post.index');
    Route::post('/post/new', [PostController::class,'store'])->name('post.store');
    Route::put('/post/update/{id}', [PostController::class,'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [PostController::class,'destroy'])->name('post.delete');
    Route::get('/post/{id}', [PostController::class,'show'])->name('post.edit'); 
});