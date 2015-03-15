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
    
    public function scopeAuteurFilter($query, $array)
    {
        if ($array == []) return $query;
        return $query->whereIn('auteur_id', $array);
    }

    public function scopeDesignationFilter($query, $designation)
    {
        if ($designation == "") return $query;
        return $query->where('designation', 'like', '%'.$designation.'%');
    }

    public function scopeDomaineFilter($query, $array)
    {
        if ($array == []) return $query;
        return $query->whereIn('domaine_id', $array);

    }

    public function scopeMatiereFilter($query, $array)
    {
        if ($array == []) return $query;
        return $query->whereIn('matiere_id', $array);

    }
    public function scopeTechniqueFilter($query, $array)
    {
        if ($array == []) return $query;
        return $query->whereIn('technique_id', $array);
    }
}
