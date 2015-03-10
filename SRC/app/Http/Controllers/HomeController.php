<?php namespace App\Http\Controllers;
use User;

class HomeController extends Controller {

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
		return view('home',['referents' => $res]);
	}

	/**
     * Show referent games
     *
     * @param  String  $id
     * @return Response
     */
    public function showReferentGames($id)
    {
        return view('referent_games', ['referent' => $id]);
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

?>