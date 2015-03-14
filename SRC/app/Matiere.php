<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model {

    public function oeuvre() {
        return $this->hasMany('App\Oeuvre');
    }

}
