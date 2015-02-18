<?php namespace App\Http\Controllers;

use App\User;
use Input;
use Request;
use App\ListeOeuvre;
use App\AssoListeAOeuvre;


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

		// List Oeuvre of one user
		$sessions = ListeOeuvre::currentUser()->get();

		return view('referent', ['nameRoute' => 'Référent', 'me' => $me, 'sessions' => $sessions]);
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
	public function addSession() 
	{
		// TODO
		$ListeOeuvre = new ListeOeuvre;
		$ListeOeuvre->iduser = 2;
		$ListeOeuvre->nom = "Linux";
		$ListeOeuvre->etat = 1;
		$ListeOeuvre->save();

		$assolistaoeuvre = new AssoListeAOeuvre;
		$assolistaoeuvre->liste_oeuvre_id = 1;
		$assolistaoeuvre->oeuvre_id = 1;
		$assolistaoeuvre->save();

		$assolistaoeuvre2 = new AssoListeAOeuvre;
		$assolistaoeuvre2->liste_oeuvre_id = 1;
		$assolistaoeuvre2->oeuvre_id = 2;
		$assolistaoeuvre2->save();
	}


	/**
	*	get all user sessions
	*
	*/
	private function getSessions() 
	{
		// TODO
	}


	


}
