<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etapa;
use App\Fase;

class EtapaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $etapas = Etapa::search($request->busqueda)->orderBy('fase_id')->paginate(10);

        return view('etapas', ['etapas' => $etapas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fases = Fase::all();
        
    	return view('etapas/create', ['fases' => $fases]);
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
            'descripcion.required' => 'La Descripción es obligatoria'
        ];

        $validator = Validator::make($request->all(), [
            'descripcion' => 'required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('EtapaController@create')->withErrors($validator)->withInput();
        }

        $etapa = new Etapa();
        $etapa->descripcion = $request->descripcion;
        $etapa->fase_id = $request->fase;
        $causal->save();

        return redirect()->action('EtapaController@index')->with('message', '¡Etapa creada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etapa  $Etapa
     * @return \Illuminate\Http\Response
     */
    public function show(Etapa $etapa)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etapa  $etapa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etapa = Etapa::find($id);
        $fases = Fase::all();

    	return view('etapas/update', ['etapa' => $etapa, 'fases' => $fases]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etapa  $etapa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'descripcion.required' => 'La Descripción es obligatoria'
        ];

        $validator = Validator::make($request->all(), [
            'descripcion' => 'required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('EtapaController@edit', ['id' => $id])->withErrors($validator);
        }

        $etapa = Etapa::find($id);
        $etapa->descripcion = $request->descripcion;
        $etapa->fase_id = $request->fase;
        $causal->save();

        return redirect()->action('EtapaController@index')->with('message', '¡Etapa actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etapa  $etapa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etapa = Etapa::find($id);

        $etapa->delete();

        return redirect()->action('EtapaController@index')->with('message', '¡Etapa eliminada con éxito!');        
	}
}
