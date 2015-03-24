<?php namespace App\Http\Controllers;

use App\Referent;
use Cookie;
use Request;

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
        $values = json_decode(Cookie::get('trophee'));
        if (!is_array($values))
            $values = [0, 0, 0];

        $nbOr = $values[2];
        $nbArgent = $values[1];
        $nbBronze = $values[0];

		$idRef = Cookie::get('referent');
        $ref = Referent::find($idRef);
        return view('frontend/games', ['ref' => $ref, 'nbOr' => $nbOr, 'nbArgent' => $nbArgent, 'nbBronze' => $nbBronze]);
	}
    
	public function choisirRef()
	{
        $value = Request::cookie('infoBar');
        if (!isset($value))
            $value = 'open';

        $refs = Referent::take(5)->select(['nom', 'prenom', 'image', 'id'])->get();
		return view('frontend/home',['referents' => $refs, 'cookie' => $value]);
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

    public function updateStatusBar() {

        $value = Request::cookie('infoBar');
        if (!isset($value))
            $value = 'open';

        switch ($value) {
             case 'open':
                 $value = 'close';
                 break;
             
             case 'close':
                 $value = 'open';
                 break;

             default:
                 break;
         }

        $response = new \Illuminate\Http\RedirectResponse(url('/'));
        $response->withCookie(cookie()->forever('infoBar', $value));
        return $response;
    }

}

?>