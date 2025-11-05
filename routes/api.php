<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthJwtController;

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

Route::post('/login', [AuthJwtController::class, 'login']);


Route::middleware(['jwt.auth'])->group(function () {

    //rutas de autenticacion de la api por jwt
    Route::get('/me', [AuthJwtController::class, 'me']);
    Route::post('/logout', [AuthJwtController::class, 'logout']);
    Route::post('/refresh', [AuthJwtController::class, 'refresh']);

    // rutas funcionales de los requerimientos
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/process-users', [UserController::class, 'process'])->middleware('can:admin.jobs.manage');
    Route::get('/user-result/{id}', [UserController::class, 'result']);
});