<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignaciones extends Model
{
    use SoftDeletes;
    protected $fillable = ['path', 'organizations_id', 'projects_id', 'date_begin', 'date_finish'];

    public function project()
    {
        return $this->belongsTo('App\LineasProduccion', 'projects_id', 'id')
            ->with(['organization']);
    }

    public function ProdLineasAgregar()
    {
        return $this->hasMany('App\ProdLineasAgregar', 'report_id', 'id')
            ->with(['issue_features', 'get_tag']);
    }


    public function series()
    {
        return $this->hasMany('App\ProdLineasAgregar', 'report_id', 'id')
            ->with(['issue_features']);
    }

    public function procesoProduccion()
    {
        return $this->hasOne('App\ProcesosProduccion', 'tag_id', 'id');
    }

    public function getIssueTag()
    {
        return $this->hasMany('App\ProcesosProduccion', 'id', 'tag_id');
    }

    public function procesoProduccio() // Corregir el nombre del método
    {
        return $this->belongsTo(ProcesosProduccion::class, 'projects_id', 'projects_id');
    }
}
