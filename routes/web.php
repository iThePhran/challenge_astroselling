<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/home');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/process-users', [UserController::class, 'process'])->middleware('can:admin.jobs.manage');
    Route::get('/user-result/{id}', [UserController::class, 'result']);
});