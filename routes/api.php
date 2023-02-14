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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login/user', 'Auth\LoginController@login');
// Route::get('/create/default', 'Auth\LoginController@createAdmin');


Route::prefix('cola')->group(function(){  // rutas de las colas o departamentos 
 Route::post('/lista', 'ColaController@Listado');
});

Route::prefix('llamadas')->group(function(){  /// listado de las llamadas
 Route::post('/lista', 'LlamadasController@Listado');
 Route::post('/lista/completas', 'LlamadasController@ListadoCompletas');
 Route::post('/create/comment', 'LlamadasController@createCommets');
 Route::post('/create/log', 'LlamadasController@createLog');
 Route::post('/change/state', 'LlamadasController@changeState');
});



