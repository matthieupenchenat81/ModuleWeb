<?php namespace App\Http\Controllers;

use Response;
use App\Referent;
use App\ConfigJeu;
use App\Oeuvre;
use Cookie;
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
    public function chooseDifMemo() {
        $nbOr = Cookie::get('referent');
        return view('frontend/memo_level', ['nbOr' => $nbOr]);
    }

    public function playMemo($niveau) {
        $idRef = Cookie::get('referent');
        $configjeu = Referent::find($idRef)->configjeu()->where('actifMemo', '=', '1')->first();
        if($configjeu && count($configjeu->oeuvres) >= 1) {
            $oes = $configjeu->oeuvres;
        } else {
            $oes = Oeuvre::orderByRaw("RAND()")->take(8)->get();
						$niveau = 1;
        }
				$params = json_decode($configjeu->parametres);

        return view('frontend/memo',  ['oeuvres' => $oes, 'niveau' => $niveau, 'nbBloc'=>$params->{"m".$niveau}]);
    }

    public function chooseDifPuzzle() {
        return view('frontend/puzzle_level');
    }

    public function playPuzzle($niveau) {

        $idRef = Cookie::get('referent');
        $ref = Referent::find($idRef);
        $configjeu = $ref->configjeu()->where('actifPuzzle', '=', '1')->first();

        if($configjeu && count($configjeu->oeuvres) >= 1) {
            $oes = $configjeu->oeuvres;
            $params = json_decode($configjeu->parametres);
            $nbTab = $params->pt;
            $dimension = $params->{ "p".$niveau};

        } else {
            $oes = Oeuvre::orderByRaw("RAND()")->take(5)->get();
            $nbTab = 3;
            $dimension = 2;
        }

		return view('frontend/puzzle', ['oeuvres' => $oes, 'dimension' => $dimension, 'nbTab' => $nbTab]);

    }
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
