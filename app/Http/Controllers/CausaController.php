<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causa;
use App\Etapa;

class CausaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causas = Causa::orderBy('id')->paginate(10);
        return view('causas', ['causas' => $causas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etapas = Etapa::all();
        return view('causas/create', ['etapas' => $etapas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Para encriptar:
         *  bcrypt($request->password())
         */

        /*
         * $causa = new Causa($request->all());
         * $causa->save();
         */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Causa  $causa
     * @return \Illuminate\Http\Response
     */
    public function show(Causa $causa)
    {
        $causas = Causa::all()->sortByDesc('id')->take(5);
        return view('causas/show', ['causa_actual' => $causa, 'causas' => $causas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Causa  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Causa $causa)
    {
        dd('Editar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /* 
         * Hacer que al momento de mostrar la plantilla para 
         * actualizar se carguen todas las etapas ya marcadas
         * anteriormente
         * 
         * Para obtener los elementos seleccionados en el checkbox 
         * colocar de nombre en el input etapa[]. Verificar si esta 
         * vacio, si no es el caso -> json_encode y luego serialize 
         * y actualizar campo de la tabla etapas_completadas
         * 
         * Para obtener el ultimo valor del arreglo usar end($arreglo).
         * Este sera el valor que se almacene en 'etapa_id'
         * 
         */

        /*
         * $causa = Causa::find($id);
         * $causa->nombre = $request->nombre;
         * $causa->num_exp = $request->num_exp;
         * $causa->etapa_id = end($request->etapa[]);
         * $causa->etapas_completadas
         * $causa->save();
         */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causa  $causa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Causa $causa)
    {
        dd('Eliminar');

        /*  $causa->delete();
            return view()
        */
	}
}
