<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model {

    public function oeuvre() {
        return $this->hasMany('App\Oeuvre');
    }

}
