<?php namespace App\Http\Controllers;

use App\User;
use Input;
use Request;
use App\ListeOeuvre;
use App\AssoListeAOeuvre;
use Response;


class ReferentController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$me = User::current();
		$user = User::all();

		//$ListeOeuvre = ListeOeuvre::find(2);
		//$ListeOeuvre->oeuvres()->attach([22, 23, 24, 25, 26]);

		$listeoeuvres = ListeOeuvre::currentUser()->get();
		return view('referent', ['nameRoute' => 'Référent', 'me' => $me, 'listeoeuvres' => $listeoeuvres]);
	}

	/**
	 * updateUser an user informations in database.
	 *
	 * 
	 */
	public function update()
	{
		$idUser = Input::get('idUser');
		$user = User::find($idUser);

		if (Request::hasFile('file'))
		{
			Request::file('file')->move("./pictures/user_picture/", $idUser);
			$user->image = "pictures/user_picture/".$idUser;
		}


		$user->firstname = Input::get('firstname');
		$user->email = Input::get('email');
		$user->city = Input::get('city');
		$user->lastname = Input::get('lastname');

		$user->save();
		return redirect('/referent')->with('message_update', 'Referent mis à jour avec succès');
	}

	/**
	*	create a new session
	*
	*/
	public function addListeOeuvre() 
	{
		$ListeOeuvre = new ListeOeuvre;
		$ListeOeuvre->iduser = Input::get('idUser');
		$ListeOeuvre->nom = Input::get('name');
		$ListeOeuvre->etat = 0;
		$ListeOeuvre->save();

		return redirect('/referent');

	}


	public function showListeOeuvres($id) 
	{
		return Response::json(ListeOeuvre::find($id)->oeuvres->toArray());
	}

	public function deleteListeOeuvre() 
	{
		$idListeOeuvre = Input::get('idListeOeuvre');
		$ListeOeuvre = ListeOeuvre::find($idListeOeuvre);
		$ListeOeuvre->delete();

		return redirect('/referent');		
	}

	public function setListOeuvres ()
	{	
		
		$idListeOeuvre = Input::get('idListeOeuvre');
		$idconcats = Input::get('oeuvres');
		$list_oeuvres_id = explode("-", $idconcats);
		
		$ListeOeuvre = ListeOeuvre::find($idListeOeuvre);
		$ListeOeuvre->oeuvres()->detach();
		$ListeOeuvre->oeuvres()->attach($list_oeuvres_id);
		return Response::json(array());
	}

}
