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

Route::resource('/etapas', 'EtapaController')->middleware('auth');

Route::get('/causas/pdf/reportes', 'CausaController@report')->name('causas.report');

Route::post('/causas/pdf/reportes/descarga1', 'CausaController@statisticalPdf')->name('causas.statisticalPdf');

Route::get('/causas/pdf/reportes/descarga2/{causa}', 'CausaController@individualPdf')->name('causas.individualPdf');

Auth::routes();