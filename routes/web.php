<?php

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

Route::get('/', 'Auth\LoginController@index');

Route::get('/inicio', 'InicioController@index')->name('inicio')->middleware('auth');

Route::resource('/causas', 'CausaController')->middleware('auth');

Route::resource('/causales', 'CausalController')->middleware('auth');

Route::resource('/operadores', 'OperadorController')->middleware('auth');

Route::resource('/usuarios', 'UsuarioController')->middleware('auth');

Route::resource('/configuracion', 'ConfiguracionController')->middleware('auth');

Auth::routes();