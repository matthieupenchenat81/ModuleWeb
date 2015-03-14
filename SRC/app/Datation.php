<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Datation extends Model {

    public function oeuvre() {
        return $this->belongsTo('App\Oeuvre');
    }

}
