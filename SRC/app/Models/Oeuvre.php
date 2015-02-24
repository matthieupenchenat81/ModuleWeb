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
        if ($array == []) return $query;
        $query->whereHas('auteurs', function($q) use ($array)
        {
            $q->whereIn('id', $array);
        });
    }

    public function scopeDesignationFilter($query, $array)
    {
        if ($array == []) return $query;
        $query->whereHas('designations', function($q) use ($array)
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
