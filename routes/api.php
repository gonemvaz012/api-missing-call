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


Route::group(['middleware' => 'cors'], function () {


    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    

    Route::get('/logout', 'Auth\LoginController@logoutUser');
    Route::post('/login/user', 'Auth\LoginController@login');
    Route::get('/create/default', 'Auth\LoginController@createAdmin');
    
    
    Route::prefix('cola')->group(function(){  // rutas de las colas o departamentos 
     Route::post('/lista', 'ColaController@Listado');
     Route::post('/listado/admin', 'ColaController@ListadoAdmin');
     Route::post('/create', 'ColaController@Create');
     Route::post('/estadisticas', 'ColaController@estadisticasCola');
     Route::post('/update', 'ColaController@updateCola');
     Route::post('/delete', 'ColaController@deleteCola');
     
    });
    
    Route::prefix('llamadas')->group(function(){  /// listado de las llamadas
     Route::post('/lista', 'LlamadasController@Listado');
     Route::post('/lista/completas', 'LlamadasController@ListadoCompletas');
     Route::post('/create/comment', 'LlamadasController@createCommets');
     Route::post('/create/log', 'LlamadasController@createLog');
     Route::post('/change/state', 'LlamadasController@changeState');
     Route::post('/pendiente/count', 'LlamadasController@Pendientes');
    });

    Route::prefix('user')->group(function(){
        Route::post('/listado', 'UserController@Listado');
        Route::post('/create', 'UserController@createUser');
        Route::post('/update', 'UserController@updateUser');
        Route::post('/delete', 'UserController@deleteUser');
        
    });
    
    
});



