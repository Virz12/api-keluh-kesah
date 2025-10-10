<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Complaint Route
Route::get('/all-complaint', [ComplaintController::class, 'all']);
Route::apiResource('/complaint', ComplaintController::class)->middleware('auth:sanctum');

// Like Route
Route::get('/like/{id}', [LikeController::class, 'like'])->middleware('auth:sanctum');

// Comment Route
Route::apiResource('/comment', CommentController::class)->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
