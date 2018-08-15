<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operador;
use Validator;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $operadores = Operador::search($request->busqueda)->orderBy('id')->paginate(10);
        
        return view('operadores', ['operadores' => $operadores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operadores/create');
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
            return redirect()->action('OperadorController@create')->withErrors($validator);
        }

        $operador = new Operador();

        $operador->titulo = $request->titulo;
        $operador->nombre = $request->nombre;
        $operador->apellido = $request->apellido;
        $operador->save();

        return redirect()->action('OperadorController@index')->with('message', 'Operador credo con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function show(Operador $operador)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operador = Operador::find($id);

        return view('operadores/update', ['operador' => $operador]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operador  $operador
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
            return redirect()->action('OperadorController@edit', ['id' => $id])->withErrors($validator);
        }

        $operador = Operador::find($id);

        $operador->titulo = $request->titulo;
        $operador->nombre = $request->nombre;
        $operador->apellido = $request->apellido;
        $operador->save();

        return redirect()->action('OperadorController@index')->with('message', 'Operador actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operador = Operador::find($id);

        foreach ($operador->causas as $causa) {
            $causa->pivot->delete();
        }

        $operador->delete();

        return redirect()->action('OperadorController@index')->with('message', 'Operador eliminado con exito!');
	}
}
