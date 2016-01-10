<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



Route::get('tcpdf', 'TcpdfController@index');
Route::get('tcpdf/archivo', 'TcpdfController@archivo');
Route::get('tcpdf/descargar', 'TcpdfController@descargar');

Route::get('merkurio', 'MerkurioController@index');
Route::get('merkurio/archivo', 'MerkurioController@archivo');
Route::get('merkurio/redirectToProvider', 'MerkurioController@redirectToProvider');
Route::get('merkurio/handleProviderCallback', 'MerkurioController@handleProviderCallback');
Route::get('merkurio/xls', 'MerkurioController@xls');

Route::controller('admin', 'AdminController');
Route::controller('categorias', 'CategoriasController');
Route::controller('redes', 'RedesController');

Route::controller('fluent', 'FluentController');
Route::controller('eventos', 'EventosController');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'eloquent' => 'EloquentController',
]);
