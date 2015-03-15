<?php namespace App\Http\Controllers;

use App\Oeuvre;
use App\Auteur;
use App\Referent;
use Response;
use Input;

class APIController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}
    
    public function refByName($reg = "") {
        
        if(!empty($reg))
            $res = User::referents()->name($reg)->get();
        else
            $res = User::referents()->get();
		return Response::json($res->toArray());
	}
    
    
    public function searchOeuvres() {
		/*		$auteurs = (Input::get('auteur', array()))?Input::get('auteur', array()): [];
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
*/
        //::whereIn('technique_id', $techniques)
		//$res = Oeuvre::paginate(15);
        //$listeoeuvres = Oeuvre::where('auteur_id', '=', Input::get('auteur'))->simplePaginate(1);

        $auteurs = (Input::get('auteur', array()))?Input::get('auteur', array()): [];
		$designations = (Input::get('designation')) ? Input::get('designation') : "";
		$domaines = (Input::get('domaine', array()))? Input::get('domaine', array()): [];
		$matieres = (Input::get('matiere', array()))? Input::get('matiere', array()): [];
		$techniques = (Input::get('technique', array()))?Input::get('technique', array()): [];

		$listeoeuvres = Oeuvre::auteurFilter($auteurs)
			->techniqueFilter($techniques)
			->designationFilter($designations)
			->domaineFilter($domaines)
			->matiereFilter($matieres)
			->simplePaginate(10);
        
        return view('backend/ref_listeoeuvres',['oeuvres' => $listeoeuvres]);
	
		//return Response::json($res->toArray());
	}
}