<?php namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use Password;
use View;
use Redirect;
use Hash;
class LoginController extends Controller {

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
		return view('auth.login');
	}

	public function authenticate()
    {
    	$credentials = [
			'email'=>Input::get('email'),
			'password'=>Input::get('password')
		];
		$rules = [
			'email' => 'required',
			'password'=>'required'
		];
		$validator = Validator::make($credentials,$rules);
		if($validator->passes())
		{
			if(Auth::attempt($credentials))
			{
				if (Auth::user()->droits != 0)
					return redirect()->intended('admin');
				else
					return redirect()->intended('referent');
			}
			return redirect('login')->withErrors(['erreur' => 'Mail ou mot de passe incorrect!',]);
		}
		else
		{
			return  redirect('login')->withErrors($validator)->withInput();
		}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('login');
    }

    public function forgottenPassword()
    {
    	return view('auth.password');
    }

    public function initPassword()
    {
    	switch ($response = Password:: sendResetLink(Input::only('email')))
    	{
    		case Password::INVALID_USER:
    			return redirect('forgotten')->withErrors("Mail Invalide !")->withInput();
    		case Password::REMINDER_SENT:
    			return redirect('forgotten')->withStatus("Mail de réinitialisation envoyée !")->withInput();
    	}
    }

    public function reset($token)
    {
    	return View::make('auth.reset')->with('token', $token);
    }

    public function update($token)
    {
    	$credentials = array('token' => Input::get('token'), 'password' => Input::get('password'), 'password_confirmation' => Input::get('password_confirmation'));
    	$response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);
            $user->save();
        });

        switch ($response)
		{
		  case Password::INVALID_PASSWORD:
		  	return Redirect::back()->withErrors("Mot de passe non valide")->withInput();
		  case Password::INVALID_TOKEN:
		  	return Redirect::back()->withErrors("Clé invalide")->withInput();
		  case Password::INVALID_USER:
		    return Redirect::back()->withErrors("Utilsateur invalide")->withInput();
		  case Password::PASSWORD_RESET:
		    return Redirect::to('/login');
    }

}
