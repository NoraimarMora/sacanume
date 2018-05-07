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

Route::get('/', function () {
    return view('login');
});

Auth::routes();

Route::get('/inicio', 'InicioController@index');

Route::resource('/causas', 'CausaController');

Route::resource('/causales', 'CausalController');

Route::resource('/operadores', 'OperadorController');

Route::resource('/usuarios', 'UsuarioController');

Route::resource('/configuracion', 'ConfiguracionController');