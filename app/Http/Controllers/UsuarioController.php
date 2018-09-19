<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::search($request->busqueda)->orderBy('id')->paginate(10);

        return view('usuarios', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El Nombre es obligatorio',
            'apellido.required' => 'El Apellido es obligatorio',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('UsuarioController@create')->withErrors($validator)->withInput();
        }

        $usuario = new Usuario();

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->tipo = $request->tipo;
        $usuario->username = strtolower($usuario->nombre)[0] . strtolower($usuario->apellido) . '.';
        $usuario->password = bcrypt('temp123');
        $usuario->save();
        $usuario->username .= $usuario->id;
        $usuario->save();

        return redirect()->action('UsuarioController@index')->with('message', '¡Usuario creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
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

        return view('usuarios/update', ['usuario' => $usuario]);
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
        $messages = [
            'nombre.required' => 'El Nombre es obligatorio',
            'apellido.required' => 'El Apellido es obligatorio',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('UsuarioController@edit', ['id' => $id])->withErrors($validator);
        }

        $usuario = Usuario::find($id);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->username = strtolower($usuario->nombre)[0] . strtolower($usuario->apellido) . '.' . $usuario->id;
        
        if($request->password) {
            $usuario->password = bcrypt($request->password);
        }
        
        $usuario->tipo = $request->tipo;
        $usuario->save();

        return redirect()->action('UsuarioController@index')->with('message', '¡Usuario actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        $usuario->delete();

        return redirect()->action('UsuarioController@index')->with('message', '¡Usuario eliminado con éxito!');
	}
}
