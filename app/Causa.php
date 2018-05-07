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
        return $this->belongsToMany('App\Causal')->withPivot('sentencia');
    }

    public function operadores()
    {
        return $this->belongsToMany('App\Operador')->withPivot('cargo');
    }
}
