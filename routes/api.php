<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TransacoesController;
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
//---------------------------rotas de categorias------------------------------------------//
    //rota de logout
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    //rota cadastro de categoria
    Route::post('/categoria', [CategoriaController::class, 'store']);
    //rota get de categorias
    Route::get('/categorias/{id}', [CategoriaController::class, 'index']);
    //update
    Route::put('/categoria/{id}', [CategoriaController::class, 'update']);
    //delete
    Route::delete('/categoriadelete/{id}', [CategoriaController::class, 'destroy']);
//---------------------------------------------------------------------------------------//

//---------------------------rotas de transacoes------------------------------------------//

    Route::post('/transacoes', [TransacoesController::class, 'store']);

    Route::get('/transacoes/{id}', [TransacoesController::class, 'index']);
});