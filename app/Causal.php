<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causal extends Model
{
    protected $table = "causales";

    protected $fillable = ['cannon', 'numero', 'descripcion'];

    public function causas()
    {
        return $this->belongsToMany('App\Causa')->withPivot(['sentencia', 'num_causal']);
    }

    public function scopeSearch($query, $busqueda) 
    {
    	return $query->where(function ($q) use ($busqueda) {
    		$q->where('cannon', 'LIKE', "%$busqueda%")
    		  ->orWhere('numero', '=', $busqueda)
    		  ->orWhere('descripcion', 'LIKE', "%$busqueda%");
    	});
    }
}
