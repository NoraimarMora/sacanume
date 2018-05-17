<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causa;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causas = Causa::all();

        $c_registradas   = count($causas);
        $c_fase_previa   = 0;
        $c_proceso       = 0;
        $c_fase_pruebas  = 0;
        $c_finalizada    = 0;

        $ultimas_causas = $causas->sortByDesc('id')->take(5);
        
        foreach($causas as $causa) {
            if($causa->etapa) {
                switch($causa->etapa->fase->id) {
                    case 1:
                        $c_fase_previa++;
                        break;
                    case 2:
                        $c_proceso++;
                        break;
                    case 3:
                        $c_fase_pruebas++;
                        break;
                    case 4:
                        $c_finalizada++;
                        break; 
                }
            }
        }

        $estadisticas = array();

        $estadisticas['c_registradas']  = $c_registradas;
        $estadisticas['c_fase_previa']  = $c_fase_previa;
        $estadisticas['c_proceso']      = $c_proceso;
        $estadisticas['c_fase_prueba']  = $c_fase_pruebas;
        $estadisticas['c_finalizada']   = $c_finalizada;

        return view('inicio', ['causas' => $ultimas_causas, 'estadisticas' => $estadisticas]);
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
    public function store(Request $request)
    {
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
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
	}
}
