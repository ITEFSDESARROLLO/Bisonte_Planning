<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','codigo','unid_x_hora', 'default_value'];
    public static function createIfNotExists($name)
    {
        $product = self::where('name', $name)->first();

        if (!$product) {
            $product = self::create([
                'name' => $name,
                // Add any other necessary columns or data for the new product
            ]);
        }

        return $product;
    }


    public function series()
    {
        return $this->hasMany('App\ProcesosProduccion', 'featured_id', 'id');
    }

}

