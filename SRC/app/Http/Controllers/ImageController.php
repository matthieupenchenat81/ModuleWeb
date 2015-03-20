<?php namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Cache;
use Image;

class ImageController extends Controller {

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
	 * 
	 *
	 * @return Response
	 */
	public function getImage($size,$url)
	{
		$size = htmlspecialchars($size);
		$url = htmlspecialchars($url);
		$key = $size.$url;
		if (Cache::has($key))
		{
			//On recupere notre image en cache
		    $r = Cache::get($key);
		}
		else
		{
			// recup image sur le serveur
			$ch = curl_init();// set url
			curl_setopt($ch, CURLOPT_URL, "http://www.augustins.org/documents/10180/156407/".$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec($ch);
			curl_close($ch);

			
			//redimensionnement
			$img = Image::make($content)->resize($size, $size, function ($constraint) {
				$constraint->aspectRatio();
			});

			$r = $img->response('jpg');

		    //Met en cache l'image avec son header pendant 6 mois sur le serveur
			Cache::add($key, $r, 241920);
		}
		return $r;
	}

}
