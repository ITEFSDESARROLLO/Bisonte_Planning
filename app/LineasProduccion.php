<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class LineasProduccion extends Model
{
    use SoftDeletes;
    protected $fillable = ['planta','title', 'organizations_id'];

    public static function createIfNotExists($title)
    {
        $linea = self::where('title', $title)->first();

        if (!$linea) {
            $linea = self::create([
                'title' => $title,
                'organizations_id' => 1
                // Añadir cualquier otra columna o datos necesarios para el nuevo producto
            ]);
        }

        return $linea;
    }


    public function organization()
    {
        return $this->belongsTo('App\Usuarios', 'organizations_id', 'id')->withTrashed();
    }

    public function series()
    {
        return $this->hasMany('App\ProcesosProduccion', 'projects_id', 'id');
    }
}
