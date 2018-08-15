<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    protected $table = "operadores";

    protected $fillable = ['nombre', 'apellido', 'titulo'];

    public function causas()
    {
        return $this->belongsToMany('App\Causa')->withPivot('cargo');
    }

    public function scopeSearch($query, $busqueda) 
    {
    	return $query->where(function ($q) use ($busqueda) {
    		$q->where('nombre', 'LIKE', "%$busqueda%")
    		  ->orWhere('apellido', 'LIKE', "%$busqueda%")
    		  ->orWhere('titulo', 'LIKE', "%$busqueda%");
    	});
    }
}
