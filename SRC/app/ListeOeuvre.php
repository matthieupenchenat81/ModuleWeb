<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ListeOeuvre extends Model {

	protected $table = 'listeoeuvre';

	public $timestamps = false;

    public function oeuvres()
    {
        return $this->belongsToMany('App\Oeuvre', 'assolisteaoeuvre');
    }

    public function jeux()
    {
        return $this->belongsToMany('App\Jeu', 'assolisteajeu');
    }

    public function scopeCurrentUser($query)
    {
        $idUser = Auth::user()->id;
        return $query->where('idusers', $idUser);
    }
}
