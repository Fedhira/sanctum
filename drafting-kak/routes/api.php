<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/debug-user', function () {
    return response()->json(Auth::user());
})->middleware('auth:sanctum');

// API untuk mendapatkan data user yang sedang login
Route::middleware(['auth:sanctum'])->get('/me', function (Request $request) {
    return response()->json([
        'id' => $request->user()->id,
        'username' => $request->user()->username,
        'email' => $request->user()->email,
        'role' => $request->user()->role
    ], 200);
});
