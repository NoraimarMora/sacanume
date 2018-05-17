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

        $request->validate([
            'nombre' => 'required',
            'num_exp' => 'required|numeric'
        ]);

        $etapas = $request->etapa;

        $causa = new Causa();
        $causa->nombre = $request->nombre;
        $causa->num_exp = $request->num_exp;
        if(!empty($request->etapa)) {
            $causa->etapa_id = end($etapas);
            $causa->etapas_completadas = serialize($etapas);
        } else {
            $causa->etapa_id = NULL;
            $causa->etapas_completadas = NULL;
        }
        $causa->save();

        return $this->index();
        
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
        $etapas = Etapa::all();
        $etapas_completadas = collect(unserialize($causa->etapas_completadas));
        return view('causas/update', ['causa' => $causa, 'etapas' => $etapas, 'etapas_completadas' => $etapas_completadas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Causa $causa)
    {
        $request->validate([
            'nombre' => 'required',
            'num_exp' => 'required|numeric'
        ]);

        $etapas = $request->etapa;

        $causa->nombre = $request->nombre;
        $causa->num_exp = $request->num_exp;
        if(!empty($request->etapa)) {
            $causa->etapa_id = end($etapas);
            $causa->etapas_completadas = serialize($etapas);
        } else {
            $causa->etapa_id = NULL;
            $causa->etapas_completadas = NULL;
        }
        $causa->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causa  $causa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Causa $causa)
    {
        $causa->delete();
        return $this->index();
	}
}
