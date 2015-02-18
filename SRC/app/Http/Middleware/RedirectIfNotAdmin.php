<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Auth;


class RedirectIfNotAdmin {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//Retour d'un admin loguer comme un referent
		if($this->auth->check() AND Session::has('admin'))
		{
			Auth::logout();
			Auth::loginUsingId(Session::get('admin'));
			Session::forget('admin');
		}

		//verification de l'identité de l'admin
		if (!$this->auth->check() OR Auth::user()->droits ==  0)
		{
				return new RedirectResponse(url('/login'));
		}
		return $next($request);
	}

}
