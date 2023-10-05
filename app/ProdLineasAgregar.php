<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdLineasAgregar extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'hours',
        'users_id',
        'report_id',
        'projects_id',
        'observations',
        'tag_id',
        'start',
        'end',

        'issue_id' // Agregado 'issue_id' a la lista de campos que se pueden llenar
    ];

    public function issue_features()
    {
        return $this->hasMany('App\ProductosLineas', 'issue_id', 'id')->with(['detail']);
    }

    public function get_tag()
    {
        return $this->hasOne('App\ProcesosProduccion', 'id', 'tag_id');
    }

    public function procesoProduccion()
    {
        return $this->belongsTo('App\ProcesosProduccion', 'tag_id', 'id');
    }

}
