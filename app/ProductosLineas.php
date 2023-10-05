<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductosLineas extends Model
{
    use SoftDeletes;
    protected $fillable = ['issue_id', 'featured_id', 'hours'];

    public function detail()
    {
        return $this->belongsTo('App\Producto', 'featured_id', 'id');
    }

    public function procesoProduccion()
    {
        return $this->belongsTo('App\ProcesosProduccion', 'featured_id', 'featured_id');
    }

    public function prodLineasAgregar()
    {
        return $this->belongsTo('App\ProdLineasAgregar', 'issue_id', 'id');
    }
}

