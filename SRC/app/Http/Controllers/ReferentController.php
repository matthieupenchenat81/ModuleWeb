<?php namespace App\Http\Controllers;

use App\Referent;
use App\ConfigJeu;
use App\Auteur;
use App\Domaine;
use App\Oeuvre;
use App\Matiere;
use App\Technique;
use Input;
use Request;
use Response;
use Session;
use Config;
use File;
use Auth;
use Hash;

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

        $me = Auth::user();
        $listeoeuvres = $me ->configjeu;
		return view('backend/ref_home', ['me' => $me, 'meslistes' => $listeoeuvres]);
	}

	/**
	 * updateUser an user informations in database.
	 *
	 * 
	 */
	public function update()
	{
		$idUser = Input::get('idUser');
		$user = Referent::find($idUser);
        $user->prenom = Input::get('prenom');
        $user->email = Input::get('email');
        $user->nom = Input::get('nom');
        $passwd = Input::get('password');
        $passwd_conf = Input::get('password_confirm');
        
        if ($passwd == "" && $passwd_conf == "")
        {
        	//le mot de passe ne change pas, on peut sauvegarder avec l'ancien
        	$user->save();
        }
        else //le mot de passe n'est pas vide
        {
        	if($passwd == $passwd_conf) //verifie les donnees pareils
        	{
        		if (strlen($passwd) >= 6) //verifie la longueur de chaine
        		{
        			$user->motdepasse = Hash::make($passwd); // encrypt le mot de passe
        			$user->save(); //sauvegarde le mot de passe
        		}
        		else
        			return redirect('/referent')->with('erreur', 'Mot de passe inferieure à 6 caractères.');
				}        
        	else
        	{
        		return redirect('/referent')->with('erreur', 'Mot de passe incorrect.');
			}
        }	
        
		
		if (Request::hasFile('file'))
		{
            $extension = Input::file('file')->getClientOriginalExtension();
            $allowed = ['jpg', 'png', 'jpeg'];
            if(in_array(strtolower($extension), $allowed)) {
                
                Request::file('file')->move("imgs/avatar/",  $idUser . "." . $extension);
                $user->image = "imgs/avatar/" . $idUser . "." . $extension;
                $user->save();

                return redirect('/referent')->with('message', 'Votre compte a été mit à jour avec succès.');
            } else
                $user->save();
                return redirect('/referent')->with('erreur', 'Votre image n\'est pas valide.');
        } else {
                $user->save();
                return redirect('/referent')->with('message', 'Votre compte a été mit à jour avec succès.');
            
        }
        
        

	}


	public function ajouterListeOeuvre() 
	{
		$newConfig = new ConfigJeu();
		$newConfig->referent_id = Auth::user()->id;
		$newConfig->nom = Input::get('nomListe');
        $newConfig->parametres = json_encode(['p1' => 2, 'p2' => 3, 'p3' => 4, 'pt' => '3',
                                             'm1' => 2, 'm2' => 3, 'm3' => 4, 'mt' => '3']);
		$newConfig->save();

		return redirect('/referent');

	}

	public function supprimerListeOeuvre($idListe) 
	{
		$ListeOeuvre = Auth::user()->configjeu->find($idListe)->delete();
		return redirect('/referent');		
	}
    
	public function modifierListeOeuvre($idListe) 
	{
        $me = Auth::user();
        $listeoeuvres = Oeuvre::simplePaginate(1);
        $meslistes = $me->configjeu;
        $mesoeuvres = $me->configjeu->find($idListe);
        
        return view('backend/ref_home',['meslistes' => $meslistes, 'mesoeuvres' => $mesoeuvres, 'me' => $me, 'listeoeuvres' => $listeoeuvres,
                                    'auteurs' => Auteur::all(), 'domaines' => Domaine::all(), 'matieres' => Matiere::all(), 'techniques' => Technique::all(), 'paramjeu' => json_decode($mesoeuvres->parametres)
                                       ]);
	}

    public function changerParamListe() {
        
        Auth::user()->configjeu()->update(array('actifMemo' => 0));
        Auth::user()->configjeu()->update(array('actifPuzzle' => 0));
        
        if(Input::get('memo') != 0)
        ConfigJeu::where('referent_id', '=', Auth::user()->id)->find(Input::get('memo'))->update(array('actifMemo' => 1));
        if(Input::get('puzzle') != 0)
        ConfigJeu::where('referent_id', '=', Auth::user()->id)->find(Input::get('puzzle'))->update(array('actifPuzzle' => 1));
        
        return ;
    }
    
    public function ajouterOeuvresDansListe($id) {
        //todo verifier user
        $cj = ConfigJeu::find($id);
        $cj->oeuvres()->attach(Input::get('toadd'));
            
        Session::flash('message', 'Vous avez ajouter des oeuvres dans votre liste.');
        return redirect()->back();
    }
    
    public function supprimerOeuvresDansListe($id) {
        //todo verifier user

        $cj = ConfigJeu::find($id);
        if(count(Input::get('todel')) >= 1)
            $cj->oeuvres()->detach(Input::get('todel'));
        
        Session::flash('erreur', 'Vous avez supprimer des oeuvres de votre liste.');
        return redirect()->back();
    }
    
    
    public function changeParamListe($id) { 
        $me = Auth::user();
        $configjeu = $me->configjeu->find($id);
        $paramsToSave = Input::all();
        unset($paramsToSave['_token']);
        $valid = true;
        foreach($paramsToSave as $p) {
            if(!(is_numeric($p) && $p > 0 && $p<= 10)) $valid = false;
        }

        
        if(!$valid)
            Session::flash('erreur', 'Les paramètres du jeu sont incorrect. Rééessayez.');
        else { 
            Session::flash('message', 'Vos modifications ont été prise en compte.');
            $configjeu->parametres = json_encode($paramsToSave);
            $configjeu->save();
        }
        return redirect()->back();
    }
    
}
