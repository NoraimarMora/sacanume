<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = "usuarios";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'nombre', 'apellido', 'tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch($query, $busqueda) 
    {
        return $query->where(function ($q) use ($busqueda) {
            $q->where('username', 'LIKE', "%$busqueda%")
              ->orWhere('nombre', 'LIKE', "%$busqueda%")
              ->orWhere('apellido', 'LIKE', "%$busqueda%");
        });
    }
}
