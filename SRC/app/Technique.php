<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Technique extends Model {

    public function oeuvre() {
        return $this->hasMany('App\Oeuvre');
    }
    
}
