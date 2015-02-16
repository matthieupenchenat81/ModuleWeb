<?php namespace App\Http\Controllers;

use DB;
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
		$res = DB::select('SELECT * FROM `users` where `admin` = 0');
		return view('home',['referent' => $res]);
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
