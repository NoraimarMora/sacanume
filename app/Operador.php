<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    protected $table = "operadores";

    protected $fillable = ['nombre', 'titulo'];

    public function causas()
    {
        return $this->belongsToMany('App\Causa')->withPivot('cargo');
    }
}
