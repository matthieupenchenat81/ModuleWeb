<?php namespace App\Http\Controllers;

use App\Referent;
use Input;
use Auth;
use Session;
use Request;
use Password;

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
		$user = Referent::all();
		return view('backend/admin_home', ['nameRoute' => 'Admin', 'users' => $user]);
	}

	/**
	 * Add an user in database.
	 *
	 * 
	 */
	public function addUser()
	{
		$user = new Referent;
		$user->nom = Input::get('nom');
		$user->email = Input::get('email');
		$user->etablissement = Input::get('etablissement');
		$user->prenom = Input::get('prenom');
		$user->image = "imgs/avatar/default.jpg";
		$user->save();
		Password::sendResetLink(Input::only('email'));
		return redirect('/admin')->with('message_add', 'Le référent a été ajouté.');
	}


	/**
	* Delete an user
	*
	*/
	public function deleteUser($idUser)
	{
		$user = Referent::find($idUser);
		$user->delete();
		return redirect('/admin')->with('message_delete', 'Le référent a été supprimé.');
	}

	/**
	* Log as one user
	*
	*/
	public function logAs($idUser)
	{
		// logout from Auth
		Auth::logout();

		// Log as referent
		Auth::loginUsingId($idUser);

		// Redirect referent route
		return redirect('/referent');
	}

}
