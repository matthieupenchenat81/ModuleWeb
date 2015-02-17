<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class User extends Model {

	protected $table = 'users';

	public $timestamps = false;

	public function scopeCurrent($query)
    {
    	$email = Auth::user()->email;
        return $query->where('email', $email)->first();
    }

    public function scopeReferents($query)
    {
        return $query->where('admin', '0');
    }
}
