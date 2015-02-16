<?php namespace App\Http\Controllers;

use DB;
use Auth;

class AdminController extends Controller {


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
		$user = DB::table('users')->where('name','<>',"admin")->get();

		return view('admin', ['nameRoute' => 'Admin', 'users' => $user, 'me' => $me]);
	}

}
