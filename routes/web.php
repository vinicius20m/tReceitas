<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth ;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('App\Http\Controllers')->group(function() {

    Route::get('/', 'HomeController@home')->name('begin') ;

    // PROFILE
    Route::get('perfil/{user:slug}', 'ProfileController@show' )->name('profile-show') ;
    Route::get('meu-perfil/minhas-receitas', 'ProfileController@posts' )->name('profile-posts') ;
    Route::get('meu-perfil/favoritas', 'ProfileController@favorites' )->name('profile-favorites') ;
    Route::get('meu-perfil/seguindo', 'ProfileController@following' )->name('profile-following') ;
    Route::post('perfil/editando-perfil/{user:slug}', 'ProfileController@update')->name('profile-update') ;
    Route::get('perfil/excluindo-perfil/{user:slug}', 'ProfileController@destroy')->name('profile-destroy') ;

    // CATEGORY
    Route::get('categorias', 'CategoryController@index' )->name('category') ;
    Route::get('categorias/nova-categoria', 'CategoryController@create')->name('category-create') ;
    Route::post('categorias/salvando-categoria', 'CategoryController@store')->name('category-store') ;
    Route::get('categorias/editar-categoria/{category:slug}', 'CategoryController@edit')->name('category-edit') ;
    Route::post('categorias/editando-categoria/{category:slug}', 'CategoryController@update')->name('category-update') ;
    Route::get('categorias/excluindo-categoria/{category:slug}', 'CategoryController@destroy')->name('category-destroy') ;

    // TAG
    Route::get('tags', 'TagController@index' )->name('tag') ;
    Route::get('tags/nova-tag', 'TagController@create')->name('tag-create') ;
    Route::post('tags/salvando-tag', 'TagController@store')->name('tag-store') ;
    Route::get('tags/editar-tag/{tag:slug}', 'TagController@edit')->name('tag-edit') ;
    Route::post('tags/editando-tag/{tag:slug}', 'TagController@update')->name('tag-update') ;
    Route::get('tags/excluindo-tag/{tag:slug}', 'TagController@destroy')->name('tag-destroy') ;

    // POST
    Route::get('receita/{post:slug}', 'PostController@show' )->name('post-show') ;
    Route::get('receitas', 'PostController@index' )->name('post') ;
    Route::get('receitas/nova-receita', 'PostController@create')->name('post-create') ;
    Route::post('receitas/salvando-receita', 'PostController@store')->name('post-store') ;
    Route::get('receitas/editar-receita/{post:slug}', 'PostController@edit')->name('post-edit') ;
    Route::post('receitas/editando-receita/{post:slug}', 'PostController@update')->name('post-update') ;
    Route::get('receitas/excluindo-receita/{post:slug}', 'PostController@destroy')->name('post-destroy') ;
}) ;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
