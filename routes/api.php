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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers')->group(function() {

    Route::post('seguir/', 'UserInteractionsController@follow')->name('follow') ;

    Route::post('favorito/', 'UserInteractionsController@favorite')->name('favorite') ;

    Route::post('gostei/', 'UserInteractionsController@like')->name('like') ;

    Route::post('comentario/', 'UserInteractionsController@comment')->name('comment') ;
    Route::post('remover-comentario/', 'UserInteractionsController@commentRemove')->name('comment-remove') ;
}) ;
