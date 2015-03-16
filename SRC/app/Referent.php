<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

class Referent extends Model implements AuthenticatableContract, CanResetPasswordContract {
    
    public function configjeu() {
        return $this->hasMany('App\ConfigJeu');
    }
    
    public function getAuthIdentifier() {
        return $this->id;
    }
    
    public function getAuthPassword() {
        return $this->motdepasse;
    }
    public function getRememberToken() {
        return $this->remember_token;
    }
    public function getEmailForPasswordReset() {
        return $this->email;
    }
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
