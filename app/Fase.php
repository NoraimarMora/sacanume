<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table = "fases";

    protected $fillable = ['descrpcion'];

    public function etapas() 
    {
        return $this->hasMany('App\Etapa');
    }
}
