<?php namespace App\Http\Controllers;

use App\Models\User;
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
		$user->droits = (Input::get('isadmin'))?1:0;
		$user->school = Input::get('city');
		$user->lastname = Input::get('lastname');
		$user->image = "pictures/user_picture/default.jpg";
		$user->save();

		Password:: sendResetLink(Input::get('email'));
		return redirect('/admin')->with('message_add', 'User ajouté avec succès');
	}



	/**
	 * updateUser an user in database.
	 *
	 * 
	 */
	public function updateUser()
	{
		
		$idUser = Input::get('idUser');
		$user = User::find($idUser);		
		
		if (Request::hasFile('file'))
		{
			Request::file('file')->move("./pictures/user_picture/", $idUser);
			$user->image = "pictures/user_picture/".$idUser;
		}

		$user->firstname = Input::get('firstname');
		$user->email = Input::get('email');
		$user->school = Input::get('city');
		$user->lastname = Input::get('lastname');
		

		$user->save();
		return redirect('/admin')->with('message_update', 'User mis à jour avec succès');
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
		return redirect('/admin')->with('message_delete', 'User supprimé avec succès');
	}

	/**
	* Log as one user
	*
	*/
	public function logAs()
	{
		// Saving idUser in Session
		$me = Auth::user()->id;
		Session::put('admin', $me);

		// logout from Auth
		Auth::logout();

		// Log as referent
		$idUser = Input::get('idUser');
		Auth::loginUsingId($idUser);

		// Redirect referent route
		return redirect('/referent');
	}

}
