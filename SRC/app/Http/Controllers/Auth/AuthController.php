<?php namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Auth;

class AuthController extends Controller {
	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
    
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('/admin');
        }
        return redirect('/login')->withErrors(['email' => 'The credentials you entered did not match our records. Try again?',]);
    
    }
	

    public function logout()
    {
    	Auth::logout();
    }

}
	