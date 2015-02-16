<?php namespace App\Http\Controllers;

use DB;
use Auth;

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
		$email = Auth::user()->email;
		$me = DB::table('users')->where('email', $email)->first();
		return view('referent', ['nameRoute' => 'Référent', 'me' => $me]);
	}

}
