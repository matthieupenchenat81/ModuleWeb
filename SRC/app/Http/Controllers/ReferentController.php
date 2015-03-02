<?php namespace App\Http\Controllers;

use App\Models\User;
use Input;
use Request;
use App\Models\ListeOeuvre;
use App\Models\AssoListeAOeuvre;
use App\Models\Auteur;
use App\Models\Designation;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Technique;
use App\Models\Oeuvre;
use App\Models\Jeu;
use Response;
use Session;
use Config;
use File;


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
		$games = Jeu::all();

		$dataSearch = [];
		$dataSearch['auteur'] = Auteur::orderBy('nom')->get();
		$dataSearch['designation'] = Designation::orderBy('nom')->get();
		$dataSearch['domaine'] = Domaine::orderBy('nom')->get();
		$dataSearch['matiere'] = Matiere::orderBy('nom')->get();
		$dataSearch['technique'] = Technique::orderBy('nom')->get();

		$listeoeuvres = ListeOeuvre::currentUser()->get();
			
		return view('referent', ['nameRoute' => 'Référent', 'me' => $me, 'listeoeuvres' => $listeoeuvres, 'data' => $dataSearch, 'games' => $games]);
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
		if (Session::has('listeoeuvre_current'))
		    Session::forget('listeoeuvre_current');
		
		Session::put('listeoeuvre_current', $id);
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

	public function search() 
	{
		$auteurs = (Input::get('auteur', array()))?Input::get('auteur', array()): [];
		$designations = (Input::get('designation', array()))? Input::get('designation', array()): [];
		$domaines = (Input::get('domaine', array()))? Input::get('domaine', array()): [];
		$matieres = (Input::get('matiere', array()))? Input::get('matiere', array()): [];
		$techniques = (Input::get('technique', array()))?Input::get('technique', array()): [];
		$debut = (Input::get('debut'))? Input::get('debut'): '';
		$fin = (Input::get('fin'))?Input::get('fin'): '';

		$res = Oeuvre::authorFilter($auteurs)
			->techniqueFilter($techniques)
			->designationFilter($designations)
			->domaineFilter($domaines)
			->matiereFilter($matieres)
			->debutFilter($debut)
			->finFilter($fin)
			->paginate(15);

		return Response::json($res->toArray());
	}

	public function addItemsToList() {
		;
	}

	public function updateAssoGames() {

		$idListeOeuvre = Session::get('listeoeuvre_current', 'default');
		$res = Input::get('data', array());
		$ListeOeuvre = ListeOeuvre::find($idListeOeuvre);

		$table = [];
		foreach ($res as $key => $value){
		    if($value == 'true')
		    	array_push($table, $key);
		}
		$ListeOeuvre->jeux()->sync($table);
	}

	public function getImage($filename) {

		// Append the filename to the path where our images are located
		$path = Config::get('view.images') . $filename;
		print($path);

		// Initialize an instance of Symfony's File class.
		// This is a dependency of Laravel so it is readily available.
		$file = new Symfony\Component\HttpFoundation\File\File($path);

		// Make a new response out of the contents of the file
		// Set the response status code to 200 OK
		$response = Response::make(
			File::get($path), 
			200
		);

		// Modify our output's header.
		// Set the content type to the mime of the file.
		// In the case of a .jpeg this would be image/jpeg
		$response->header(
			'Content-type',
			$file->getMimeType()
		);

		// We return our image here.
		return $response;
	}

}
