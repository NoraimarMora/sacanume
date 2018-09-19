<?php

use Illuminate\Database\Seeder;
use App\Usuario;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new Usuario();
/*
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->tipo = $request->tipo;
        $usuario->username = strtolower($usuario->nombre)[0] . strtolower($usuario->apellido) . '.';
        $usuario->password = bcrypt('temp123');
        $usuario->save();
        $usuario->username .= $usuario->id;
        $usuario->save();*/
    }
}
