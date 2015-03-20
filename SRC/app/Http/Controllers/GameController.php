<?php namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
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
        return view('frontend/memo_level');
    }
    public function chooseDifPuzzle() {
        return view('frontend/puzzle_level');
    }

    public function playMemo($niveau) {
        $idRef = Cookie::get('referent');
        $configjeu = Referent::find($idRef)->configjeu()->where('actifMemo', '=', '1')->first();
        if($configjeu && count($configjeu->oeuvres) >= 1) {
            $oes = $configjeu->oeuvres;
						$params = json_decode($configjeu->parametres);
						$bloc = $params->{"m".$niveau};
        } else {
            $oes = Oeuvre::orderByRaw("RAND()")->take(8)->get();
						if($niveau == 1) {$bloc = 2;} elseif($niveau == 2){$bloc = 3;} else {$bloc = 4;}
        }


        return view('frontend/memo',  ['oeuvres' => $oes, 'niveau' => $niveau, 'nbBloc'=>$bloc]);
    }


    public function playPuzzle($niveau) {
        try {
            $idRef = Cookie::get('referent');
            $ref = Referent::findOrFail($idRef);
            $configjeu = $ref->configjeu()->where('actifPuzzle', '=', '1')->firstOrFail();

            if(count($configjeu->oeuvres->count()) >= 1) {
                $oes = $configjeu->oeuvres()->select('image')->get();
                $params = json_decode($configjeu->parametres);
                $nbTab = $params->pt;
                $dimension = $params->{"p" . $niveau};
                if(!(isset($dimension) && is_numeric($dimension))) throw new ModelNotFoundException();
            } else throw new ModelNotFoundException();
        } catch(ModelNotFoundException $e) {
            $oes = Oeuvre::orderByRaw("RAND()")->take(5)->select('image')->get();
            $nbTab = 3;
            $dimension = 2;
        }
		return view('frontend/puzzle', ['oeuvres' => $oes, 'dimension' => $dimension, 'nbTab' => $nbTab, 'niveau' => $niveau]);
    }

	public function index() {
        $res = User::referents()->get();
        return view('home', ['referent' => $res]);
    }

    public function setRecords($idTrophee) {

        $values = Cookie::get('trophee');
        
        if ($values === false)
            $values = [0, 0, 0];

        switch ($idTrophee) {
            
            case '1':
                $values[0] = intval($values[0]) + 1;
                break;
                        
            case '2':
                $values[1] = intval($values[1]) + 1;
                break;

            case '3':
                $values[2] = intval($values[2]) + 1;;
                break;
            
            default:
                break;
        }

        return Response::make('all good!')->withCookie(Cookie::forever('trophee', $values));
    }

}
