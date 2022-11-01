<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Categories
Route::apiResource('categories', CategoriesController::class);

// Beritas
Route::apiResource('news', BeritaController::class);

// Pengumumans
Route::apiResource('announcements', PengumumanController::class);