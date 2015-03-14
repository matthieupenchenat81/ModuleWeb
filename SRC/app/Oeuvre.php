<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model {

	public function configjeu() {
        return $this->belongsToMany('App\ConfigJeu');
    }
    
    public function technique() {
        return $this->hasOne('App\Technique');
    }
    
    public function domaine() {
        return $this->hasOne('App\Domaine');
    }
    
    public function matiere() {
        return $this->hasOne('App\Matiere');
    }
    
    public function auteur() {
        return $this->belongsTo('App\Auteur');
    }
    
    public function datation() {
        return $this->hasMany('App\Datation');
    }
}
