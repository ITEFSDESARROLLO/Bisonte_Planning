<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class ProcesosProduccion extends Model
{
    use HasTrixRichText;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'cantidad',
        'color',
        'projects_id',
        'featured_id',
        'start_at',
        'deadline_at',
        'inicio_dia',
        'fin_dia'

    ];

    public function setStartAtAttributes($value)
    {
        $this->attributes['featured_id'] = $value;

    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = $value;

    }

    public function setDeadlineAtAttribute($value)
    {
        $this->attributes['deadline_at'] = $value;
    }

    public function setDeadlineAtAttri($value)
    {
        $this->attributes['tag_id'] = $value;
    }

    public function setProjectsIdAttributo($value)
    {
        $this->attributes['projects_id'] = $value;
    }

    public function setProjectsIdAttributpo($value)
    {
        $this->attributes['featured_id'] = $value;
    }

    public function LineasProduccion()
    {
        return $this->belongsTo('App\LineasProduccion', 'projects_id', 'id');
    }

    public function Producto()
    {
        return $this->belongsTo('App\Producto', 'featured_id', 'id');
    }
    public function Productos()
    {
        return $this->belongsTo('App\Producto', 'featured_id', 'featured_id');
    }
    // En el modelo ProcesosProduccion.php
    public function Productoss()
    {
    return $this->belongsTo('App\Producto');
    }
    public function proodLineasAgregar()
    {
        return $this->hasMany('App\ProdLineasAgregar', 'tag_id', 'id');
    }
    public function productosLineas()
    {
        return $this->hasMany('App\ProductosLineas', 'featured_id', 'featured_id');
    }

    public function prodLineasAgregar()
    {
        return $this->hasMany('App\ProdLineasAgregar', 'tag_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\LineasProduccion', 'projects_id', 'featured_id', 'id')
            ->with(['organization']);
    }

    public function procesoProduccion()
    {
        return $this->belongsTo('App\ProcesosProduccion', 'projects_id', 'projects_id', 'featured_id');
    }

    public function asignacion()
    {
    return $this->hasOne(Asignaciones::class, 'report_id', 'id');
    }


    public function asignaciones()
    {
        return $this->hasOne(Asignaciones::class, 'projects_id', 'projects_id');
    }
    public function asignacioness()
    {
        return $this->hasOne(Asignaciones::class, 'projects_id', 'projects_id');
    }


    public function get_calc($arg)
    {
        $query = ProdLineasAgregar::where('tag_id', $arg);
        return [
            'start' => $query->orderBy('start', 'ASC')->pluck('start')->first(),
            'end' => $query->orderBy('end', 'DESC')->pluck('end')->last(),

            'report_id' => $query->orderBy('end', 'DESC')->pluck('report_id')->last(),
        ];
    }

}
