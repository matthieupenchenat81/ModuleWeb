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

Route::get('/', 'GameController@index');
Route::get('referents/{id}/games', 'GameController@showReferentGames')->where('id', '^((?!login|referent|admin).)*$');
Route::get('referents/{id}/games/{idGame}', 'GameController@showOneReferentGame');
Route::get('password/reset', array(
  'uses' => 'LoginController@reset',
  'as' => 'password.reset'
));

Route::post('password/reset', array(
  'uses' => 'LoginController@update',
  'as' => 'password.update'
));


Route::group(['middleware' => 'guest'], function ()
{
	Route::get('login', 'LoginController@index');
	Route::post('login', 'LoginController@authenticate');
	Route::get('forgotten', 'LoginController@forgottenPassword');
	Route::post('forgotten', 'LoginController@initPassword');
});

Route::group(['middleware' => 'auth'], function ()
{
	Route::get('referent', 'ReferentController@index');
	Route::get('logout', 'LoginController@logout');	
	Route::post('update', 'ReferentController@update');
});

Route::group(['middleware' => 'admin'], function ()
{
	Route::get('admin', 'AdminController@index');
	Route::post('addUser', 'AdminController@addUser');
	Route::post('deleteUser', 'AdminController@deleteUser');
	Route::post('updateUser', 'AdminController@updateUser');
	Route::post('logAs', 'AdminController@logAs');
});