<?php namespace App\Http\Controllers;

use App\Referent;
use Cookie;
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
		$idRef = Cookie::get('referent');
        $ref = Referent::find($idRef);
        return view('frontend/games', ['ref' => $ref]);
	}
    
	public function choisirRef()
	{
		return view('frontend/home',['referents' => Referent::get()]);
	}

    public function changerRef($idRef)
	{
        if(Referent::find($idRef)) {
            $response = new \Illuminate\Http\RedirectResponse(url('/'));
            $response->withCookie(cookie()->forever('referent', $idRef));
            return $response;
        } else return $this->choisirRef();
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