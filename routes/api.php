<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Models\Format;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::apiResource('albums', AlbumController::class);

Route::middleware('auth:api')->get('/formats', function () {
    return response()->json(Format::all());
});
