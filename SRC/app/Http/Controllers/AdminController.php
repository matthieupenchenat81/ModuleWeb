<?php namespace App\Http\Controllers;

use App\User;
use Input;

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
		$user = new User;

		$user->firstname = Input::get('firstname');
		$user->email = Input::get('email');
		$user->admin = 0;
		$user->city = Input::get('city');
		$user->lastname = Input::get('lastname');
		$user->image = "pictures/user_picture/default.png";

		$user->save();
		return redirect('/admin')->with('message_add', 'Referent ajouté avec succès');
	}


	/**
	* Delete an user
	*
	*/
	public function deleteUser()
	{
		$idUser = Input::get('idUser');
		$user = User::find($idUser);
		$user->delete();
		return redirect('/admin')->with('message_delete', 'Referent supprimé avec succès');
	}

}
