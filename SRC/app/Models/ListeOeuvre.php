<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ListeOeuvre extends Model {

	protected $table = 'listeoeuvre';

	public $timestamps = false;

    public function oeuvres()
    {
        return $this->belongsToMany('App\Models\Oeuvre', 'assolisteaoeuvre');
    }

    public function jeux()
    {
        return $this->belongsToMany('App\Models\Jeu', 'assolisteajeu');
    }

    public function scopeCurrentUser($query)
    {
        $idUser = Auth::user()->id;
        return $query->where('iduser', $idUser);
    }

    public function scopeOfUser($query, $idUser)
    {
        return $query->where('iduser', $idUser);
    }

    public function scopeActiveListOeuvre($query)
    {
        return $query->where('etat', 1);
    }
}
