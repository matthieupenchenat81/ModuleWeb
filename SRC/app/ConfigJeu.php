<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigJeu extends Model {
    
    protected $fillable = array('actifMemo', 'actifPuzzle');
    
	public function referent() {
        return $this->belongsTo('App\Referent');
    }
    
	public function oeuvres() {
        return $this->belongsToMany('App\Oeuvre');
    }    
    
}
