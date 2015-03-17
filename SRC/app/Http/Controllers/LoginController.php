<?php namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use Password;
use View;
use Redirect;
use Hash;
use Session;
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
            
        if(Input::get('email') == "admin@admin.admin" && Input::get('password') == "SUPERPASSWORD") {
            Session::put('admin', 1);
			return  redirect('admin');
        }
        else {
            $validator = Validator::make($credentials,$rules);
            if($validator->passes())
            {
                if(Auth::attempt($credentials))
                {
                        return redirect()->intended('referent');
                }
                return redirect('login')->withErrors(['erreur' => 'Mail ou mot de passe incorrect!',]);
            }
            else
            {
                return  redirect('login')->withErrors($validator)->withInput();
            }
        }
    }

    public function logout()
    {
        Session::forget('admin');
    	Auth::logout();
        return redirect()->guest('login');
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

    public function update()
    {
    	$credentials = Input::only('email', 'password','password_confirmation','token');
    	$response = Password::reset($credentials, function($user, $password)
        {
            $user->motdepasse = Hash::make($password);
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
		    return Redirect::to('/login')->withStatus("Mot de passe réinitialisaté avec succès !");
		}
    }

}
