<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;

// Api Controllers
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\KependudukanController;
use App\Http\Controllers\Api\PeraturanController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\EntryMailController;
use App\Http\Controllers\Api\UserController;

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


// Route to testing in skripsi
Route::prefix('v1')->group(function(){
    // Permissions
    Route::apiResource('permissions', PermissionController::class);

    // Roles
    Route::apiResource('roles', RoleController::class);

    // Users
    Route::apiResource('users', UserController::class);

    // Kependudukan
    Route::apiResource('kependudukans', KependudukanController::class);

    // Entry Mail
    Route::apiResource('entry_mails', EntryMailController::class);

    // Beritas
    Route::apiResource('news', BeritaController::class);

    // Pengumumans
    Route::apiResource('announcements', PengumumanController::class);

    // Rules
    Route::apiResource('rules', PeraturanController::class);
});


// Add ons
// Categories
Route::apiResource('categories', CategoriesController::class);