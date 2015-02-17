<?php namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use Password;
use DB;

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
    	switch ($response = Password::remind(Input::only('email')))
    	{
    		case Password::INVALID_USER:
    			return redirect('forgotten')->withErrors($response)->withInput();
    		case Password::REMINDER_SENT:
    			return redirect('forgotten')->withStatus($response)->withInput();
    	}
    }

}
