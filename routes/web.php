<?php


// Controller
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('users', [UserController::class, 'index'])->name('user.index');

// Route::resource('categories', CategoriesController::class);
Route::get('categories', [CategoriesController::class, 'index'])->name('category.index');
Route::get('categories/store', [CategoriesController::class, 'store'])->name('category.index');