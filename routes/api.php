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

// Permissions
Route::apiResource('permissions', PermissionController::class);

// Roles
Route::apiResource('roles', RoleController::class);

// Users
// Awaiting after Jmeter is success in both repository

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

// Add ons
// Categories
Route::apiResource('categories', CategoriesController::class);

// // Removed 'auth.sanctum' for testing the performance testing
// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => []], function () {
//     // Permissions
//     Route::apiResource('permissions', 'PermissionsApiController');

//     // Roles
//     Route::apiResource('roles', 'RolesApiController');

//     // Users
//     Route::apiResource('users', 'UsersApiController');

//     // Kependudukan
//     Route::apiResource('kependudukans', 'KependudukanApiController');

//     // Entry Mail
//     Route::post('entry-mails/media', 'EntryMailApiController@storeMedia')->name('entry-mails.storeMedia');
//     Route::apiResource('entry-mails', 'EntryMailApiController');

//     // Berita
//     Route::post('berita/media', 'BeritaApiController@storeMedia')->name('berita.storeMedia');
//     Route::apiResource('berita', 'BeritaApiController');

//     // Pengumuman
//     Route::post('pengumumen/media', 'PengumumanApiController@storeMedia')->name('pengumumen.storeMedia');
//     Route::apiResource('pengumumen', 'PengumumanApiController');

//     // Rule
//     Route::apiResource('rules', 'RuleApiController');
// });