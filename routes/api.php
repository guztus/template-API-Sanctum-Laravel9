<?php

use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\AuthController;
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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::get('/people', [PersonController::class, 'index']);
Route::get('/people/{id}', [PersonController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/people/{id}', [PersonController::class, 'update']);
    Route::delete('/people/{id}', [PersonController::class, 'destroy']);
    Route::post('/people', [PersonController::class, 'store']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
