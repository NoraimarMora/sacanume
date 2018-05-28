<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causal;

class CausalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causales = Causal::orderBy('cannon', 'numero')->paginate(10);
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
        $causal = new Causal();
        $causal->cannon = $request->cannon;
        $causal->numero = $request->numero;
        $causal->descripcion = $request->descripcion; 
        $causal->save();
        
        return $this->index();
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
    public function edit(Causal $causal)
    {
        return view('causales/update', ['causal' => $causal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Causal $causa)
    {
        $causal->cannon = $request->cannon;
        $causal->numero = $request->numero;
        $causal->descripcion = $request->descripcion; 
        $causal->save();
        
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causal  $causal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Causal $causal)
    {
        $causal->delete();
        return $this->index();
	}
}
