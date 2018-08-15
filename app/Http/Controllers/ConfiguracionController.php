<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Validator;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);

        return view('configuracion', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->username = strtolower($usuario->nombre)[0] . strtolower($usuario->apellido) . '.' . $usuario->id;

        if($request->password) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->action('ConfiguracionController@edit', ['id' => $id])->with('message', 'Informacion actualizada con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
	}
}
