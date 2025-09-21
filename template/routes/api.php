<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// Getting logged-in USER
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// PUBLIC END-POINTS(APIs):
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/viewPost/{id}', [PostController::class, 'show']);


// PROTECTED END-POINTS(APIs):
Route::middleware('auth:sanctum')->group(function (){

    Route::post('/createPost', [PostController::class, 'store'])->middleware('role:admin');
    Route::put('/updatePost/{id}', [PostController::class, 'update'])->middleware('role:admin');
    Route::delete('/deletePost/{id}', [PostController::class, 'destroy'])->middleware('role:admin');
    Route::get('/users', [AuthController::class, 'users'])->middleware('role:admin');
    Route::get('/user', function (Request $request){
        return $request->user();
    }); 
    Route::post('/logout', [AuthController::class, 'logout']);
});




