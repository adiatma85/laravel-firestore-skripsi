<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\KependudukanController;
use App\Http\Controllers\Api\PeraturanController;

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

// Authentiaction
Route::post('login', [AuthController::class, 'login']);;
Route::post('register', [AuthController::class, 'register']);

// Categories
Route::apiResource('categories', CategoriesController::class);

// Beritas
Route::apiResource('news', BeritaController::class);

// Pengumumans
Route::apiResource('announcements', PengumumanController::class);

// Kependudukan
Route::apiResource('kependudukans', KependudukanController::class);

// Rules
Route::apiResource('rules', PeraturanController::class);

// Request PDF

// Untuk saat ini kita selesaikain skeleton terlebih dahulu


