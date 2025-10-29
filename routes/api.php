<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReflectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Complaint Route Public
Route::get('/all-complaint', [ComplaintController::class, 'all']);
Route::get('/complaint/{complaint}', [ComplaintController::class, 'show']);

// Protected Route
Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('/complaint', ComplaintController::class)->only([
        'store', 'update', 'destroy', 'index'
    ]);

    // Like Route
    Route::put('/like/{id}', [LikeController::class, 'like']);
    
    // Comment Route
    Route::apiResource('/comment', CommentController::class);

    // Reflection Route
    Route::apiResource('/reflection', ReflectionController::class);

    // Account Route
    Route::get('/account', function (Request $request) {return $request->user();});
    Route::put('/account/password', [AccountController::class, 'changePassword']);
    Route::put('/account/name', [AccountController::class, 'changeName']);
});

