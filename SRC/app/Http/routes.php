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
// FRONT END PART
Route::get('choisirref', 'HomeController@choisirRef');
Route::get('changerref/{id}', 'HomeController@changerRef');

// API FOR AJAX REQUESTS
Route::get('api/searchRef/{reg?}', 'APIController@refByName');
Route::get('api/searchOeuvres', 'APIController@searchOeuvres');

//API FOR IMAGE RESIZE
Route::get('/image/{size}/{url}', 'ImageController@getImage');

Route::get('/setRecords/{idTrophee}','GameController@setRecords');


// LOGIN RESET
Route::get('password/reset/{token}', array(
  'uses' => 'LoginController@reset',
  'as' => 'password.reset'
));
Route::post('password/reset', array(
  'uses' => 'LoginController@update',
  'as' => 'password.update'
));

// OTHER
Route::group(['middleware' => 'ifGuestWithRef'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('memo', 'GameController@chooseDifMemo');
    Route::get('memo/jouer/{niv}', 'GameController@playMemo');
    Route::get('puzzle', 'GameController@chooseDifPuzzle');
    Route::get('puzzle/jouer/{niv}', 'GameController@playPuzzle');
});

Route::group(['middleware' => 'ifGuest'], function ()
{
	Route::get('login', 'LoginController@index');
	Route::post('login', 'LoginController@authenticate');
	Route::get('forgotten', 'LoginController@forgottenPassword');
	Route::post('forgotten', 'LoginController@initPassword');
});

Route::group(['middleware' => 'ifReferent'], function ()
{
	Route::get('referent', 'ReferentController@index');
	Route::post('referent/ajouterliste', 'ReferentController@ajouterListeOeuvre');
	Route::get('referent/supprimerliste/{id}', 'ReferentController@supprimerListeOeuvre');
	Route::get('referent/modifierliste/{id}', 'ReferentController@modifierListeOeuvre');
	Route::post('referent/modifierliste/supprimer/{id}', 'ReferentController@supprimerOeuvresDansListe');
	Route::post('referent/modifierliste/ajouter/{id}', 'ReferentController@ajouterOeuvresDansListe');
    Route::post('referent/changerparamliste', 'ReferentController@changerParamListe');
    Route::post('referent/changeParamListe/{id}', 'ReferentController@changeParamListe');
    Route::post('referent/update', 'ReferentController@update');

});

// ADMIN PART
Route::group(['middleware' => 'ifAdmin'], function ()
{
	Route::get('admin', 'AdminController@index');
	Route::post('admin/addUser', 'AdminController@addUser');
	Route::get('admin/deleteUser/{id}', 'AdminController@deleteUser');
	Route::get('admin/updateUser/{id}', 'AdminController@updateUser');
	Route::get('admin/logAs/{id}', 'AdminController@logAs');
});

Route::get('logout', 'LoginController@logout');
