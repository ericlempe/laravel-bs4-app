<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index');
        Route::get('/list', 'list');
        Route::post('', 'create');
        Route::post('/import', 'import');
        Route::post('/export', 'export');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});
