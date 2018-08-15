<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causal;
use Validator;

class CausalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $causales = Causal::search($request->busqueda)->orderBy('cannon')->paginate(10);

        return view('causales', ['causales' => $causales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('causales/create');
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
            'cannon.required' => 'El Cannon es obligatorio',
            'descripcion.required' => 'La Descripcion es obligatorio',
            'numero.numeric' => 'El Numero debe ser un valor numerico'
        ];

        $validator = Validator::make($request->all(), [
            'cannon' => 'required',
            'descripcion' => 'required',
            'numero' => 'numeric'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('CausalController@create')->withErrors($validator);
        }

        $causal = new Causal();

        $causal->cannon = $request->cannon;
        $causal->numero = $request->numero;
        $causal->descripcion = $request->descripcion; 
        $causal->save();
        
        return redirect()->action('CausalController@index')->with('message', 'Causal creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function show(Causal $causal)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $causal = Causal::find($id);

        return view('causales/update', ['causal' => $causal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'cannon.required' => 'El Cannon es obligatorio',
            'descripcion.required' => 'La Descripcion es obligatorio',
            'numero.numeric' => 'El Numero debe ser un valor numerico'
        ];

        $validator = Validator::make($request->all(), [
            'cannon' => 'required',
            'descripcion' => 'required',
            'numero' => 'numeric'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('CausalController@edit', ['id' => $id])->withErrors($validator);
        }

        $causal = Causal::find($id);

        $causal->cannon = $request->cannon;
        $causal->numero = $request->numero;
        $causal->descripcion = $request->descripcion; 
        $causal->save();
        
        return redirect()->action('CausalController@index')->with('message', 'Causal actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $causal = Causal::find($id);

        foreach ($causal->causas as $causa) {
            $causa->pivot->delete();
        }

        $causal->delete();
        
        return redirect()->action('CausalController@index')->with('message', 'Causal eliminado con exito!');
	}
}
