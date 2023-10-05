<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class usuarios extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'contact', 'url', 'email'];

    public function lineasProduccion()
    {
        return $this->belongsTo('App\LineasProduccion', 'organizations_id', 'id');
    }
}
