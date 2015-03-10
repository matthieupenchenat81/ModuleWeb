<?php namespace App\Http\Controllers;

use App\Models\User;
use Response;
use App\Models\Oeuvre;
use App\Models\ListeOeuvre;

class GameController extends Controller {

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
		$res = User::referents()->get();
		return view('home',['referent' => $res]);
	}

	public function findReferents($reg) {

		$res = User::referents()->name($reg)->get();
		return Response::json($res->toArray());
	}

	/**
     * Show referent games
     *
     * @param  String  $id
     * @return Response
     */
    public function showReferentGames($id)
    {
    	$listeOeuvre = $ListeOeuvre = ListeOeuvre::ofUser($id)->activeListOeuvre()->first();
    	if($listeOeuvre == '')
    		$games = [];
    	else 
    		$games = $listeOeuvre->jeux()->get();

        return view('referent_games', ['games' => $games]);
    }


	/**
     * Show one referent game
     *
     * @param  String  $id
	 * @param  String  $idGame
     * @return Response
     */
    public function showOneReferentGame($id, $idGame)
    {
        return view('one_referent_game', ['referent' => $id, 'game' => $idGame]);
    }

}
