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
    
    public function scopeAuthorFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('auteur', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }

    public function scopeDesignationFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('designation', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }

    public function scopeDomaineFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('domaine', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }

    public function scopeMatiereFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('matiere', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }

    public function scopeTechniqueFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('technique', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }
}
