<?php

use App\Http\Controllers\CategoriaController;
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

//rota de registro
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//rota de login
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    //rota de logout
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('/categoria', [CategoriaController::class, 'store']);
    Route::get('/categorias/{id}', [CategoriaController::class, 'index']);
});