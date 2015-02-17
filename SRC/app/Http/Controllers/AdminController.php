<?php namespace App\Http\Controllers;

use App\User;

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
		$me = User::current();
		$user = User::all();
		return view('admin', ['nameRoute' => 'Admin', 'users' => $user, 'me' => $me]);
	}

	/**
	 * Add an user in database.
	 *
	 * 
	 */
	public function addUser()
	{
		$firstname = Request::input('firstname');
		$lastname = Input::get('lastname');
		$email = Input::get('email');
		$city = Input::get('city');
		//print('ok');
	}

}
