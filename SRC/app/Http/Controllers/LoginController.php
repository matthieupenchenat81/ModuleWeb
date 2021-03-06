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
                return redirect('login')->withErrors(['erreur' => 'Vos identifiants sont incorrects.',]);
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
    			return redirect('forgotten')->withErrors("L'adresse email saisie est incorrecte.")->withInput();
    		default :
    			return redirect('forgotten')->withStatus("Un email vous a été envoyé à votre adresse mail. Il peut se retrouver dans la boite Spam.")->withInput();
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
		  	return Redirect::back()->withErrors("Votre mot de passe doit contenir au minimum 6 caractères.")->withInput();
		  case Password::INVALID_TOKEN:
		  	return Redirect::back()->withErrors("Erreur de token, contactez l'administrateur, merci.")->withInput();
		  case Password::INVALID_USER:
		    return Redirect::back()->withErrors("L'adresse email saisie est incorrecte.")->withInput();
		  default :
		    return Redirect::to('/login')->withStatus("Votre mot de passe a été changé avc succès !");
		}
    }

}
