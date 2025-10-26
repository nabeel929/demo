<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\AuthController;

Route::middleware('api')->group(function () {
    Route::resource('posts', PostController::class);
});




//  test route
Route::get('/test', function () {
    return response()->json([
        'message' => 'NABEEL BHAI! API AB 100% CHAL RAHA HAI!',
        'name' => 'Nabeel Ashfaq',
        'roll_no' => 'mscsf23mo32',
        'personal' => [
            'height' => '5ft 8in',
            'phone' => 923016769628,
            'age' => 27
        ]
    ]);
});


// auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/comments',[CommentsController::class, 'addComment']);
    Route::get('/comments',[CommentsController::class, 'getComment']);
    Route::delete('/comments/{id}',[CommentsController::class, 'deleteComment']);
    Route::put('/comments/{id}', [CommentsController::class, 'updateComment']);





});


