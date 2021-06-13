<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function(){
    Route::get('/fetchUser', [App\Http\Controllers\UsersController::class, 'getAuthUser']);
    Route::get('/deleteUser', [App\Http\Controllers\UsersController::class, 'deleteUser']);
    Route::post('/updateUser', [App\Http\Controllers\UsersController::class, 'updateUser']);
});

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'registerUser'])->name('register');;
Route::post('/login', [App\Http\Controllers\LoginController::class, 'Login'])->name('login');;