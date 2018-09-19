<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $table = "etapas";

    protected $fillable = ['descripcion', 'fase_id'];

    public function fase() 
    {
        return $this->belongsTo('App\Fase');
    }

    public function causas()
    {
        return $this->hasMany('App\Causa');
    }

    public function scopeSearch($query, $busqueda) 
    {
        return $query->where(function ($q) use ($busqueda) {
            $q->where('descripcion', 'LIKE', "%$busqueda%");
        });
    }
}
