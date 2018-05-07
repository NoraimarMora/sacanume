<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causal extends Model
{
    protected $table = "causales";

    protected $fillable = ['cannon', 'numero', 'descripcion'];

    public function causas()
    {
        return $this->belongsToMany('App\Causa')->withPivot('sentencia');
    }
}
