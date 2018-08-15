<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    protected $table = "causas";

    protected $fillable = ['nombre', 'num_exp', 'etapa_id'];

    public function etapa()
    {
        return $this->belongsTo('App\Etapa');
    }

    public function causales()
    {
        return $this->belongsToMany('App\Causal')->withPivot(['sentencia', 'num_causal']);
    }

    public function operadores()
    {
        return $this->belongsToMany('App\Operador')->withPivot('cargo');
    }

    public function scopeSearch($query, $busqueda) 
    {
        return $query->where(function ($q) use ($busqueda) {
            $q->where('nombre', 'LIKE', "%$busqueda%")
              ->orWhere('num_exp', 'LIKE', "%$busqueda%");
        });
    }
}
