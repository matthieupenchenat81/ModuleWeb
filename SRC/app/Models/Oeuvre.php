<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model {

	protected $table = 'oeuvre';

	public $timestamps = false;

	public function designations()
    {
        return $this->belongsToMany('App\Models\Designation', 'assodesignationaoeuvre');
    }

    public function auteurs()
    {
        return $this->belongsToMany('App\Models\Auteur', 'assoauteuraoeuvre');
    }

    public function technique()
    {
        return $this->belongsTo('App\Models\Technique', 'idtechnique', 'id');
    }

    public function domaine()
    {
        return $this->belongsTo('App\Models\Domaine', 'iddomaine', 'id');
    }

    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere', 'idmatiere', 'id');
    }

    public function datation()
    {
        return $this->belongsTo('App\Models\Datation', 'iddate', 'id');
    }

    public function scopeAuthorFilter($query, $array)
    {
        foreach ($array as $author_id){

            if ($author_id === reset($array)){
                $query->whereHas('auteurs', function($q) use ($author_id)
                {
                    $q->where('id', '=', $author_id);
                });
            }else{
                $query->orWhereHas('auteurs', function($q) use ($author_id)
                {
                    $q->where('id', '=', $author_id);
                });
            }
        }
    }

    public function scopeDesignationFilter($query, $array)
    {
        $q = $query;

        foreach ($array as $designation_id){

            if ($designation_id === reset($array)){
                $query->whereHas('designations', function($q) use ($designation_id)
                {
                    $q->where('id', '=', $designation_id);
                });
            }else{
                $query->orWhereHas('designations', function($q) use ($designation_id)
                {
                    $q->where('id', '=', $designation_id);
                });
            }
        }
    }

    public function scopeDomaineFilter($query, $array)
    {
        $q = $query;

        foreach ($array as $domaine_id){

            if ($domaine_id === reset($array)){
                $query->whereHas('domaine', function($q) use ($domaine_id)
                {
                    $q->where('id', '=', $domaine_id);
                });
            }else{
                $query->orWhereHas('domaine', function($q) use ($domaine_id)
                {
                    $q->where('id', '=', $domaine_id);
                });    
            } 
        }
    }

    public function scopeMatiereFilter($query, $array)
    {
        foreach ($array as $matiere_id){

            if ($matiere_id === reset($array)){
                $query->whereHas('matiere', function($q) use ($matiere_id)
                {
                    $q->where('id', '=', $matiere_id);
                });
            }else{
                $query->orWhereHas('matiere', function($q) use ($matiere_id)
                {
                    $q->where('id', '=', $matiere_id);
                });
            }
        }
    }

    public function scopeTechniqueFilter($query, $array)
    {

        foreach ($array as $technique_id){

            if ($technique_id === reset($array)){
                $query->whereHas('technique', function($q) use ($technique_id)
                {
                    $q->where('id', '=', $technique_id);
                });
            }else{
                $query->orWhereHas('technique', function($q) use ($technique_id)
                {
                    $q->where('id', '=', $technique_id);
                });
            }
            
        }
    }


    public function scopeDebutFilter($query, $date)
    {
        if ($date == '') return $query;
        $query->whereHas('datation', function($q) use ($date)
            {
                $q->where('debut', '>=', $date);
            });
    }

    public function scopeFinFilter($query, $date)
    {
        if ($date == '') return $query;
        $query->whereHas('datation', function($q) use ($date)
        {
            $q->where('debut', '<=', $date);
        });
    }
}
