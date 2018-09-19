<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Causa;
use App\Etapa;
use App\Causal;
use App\Operador;
use Validator;
use Barryvdh\DomPDF\Facade as PDF;



class CausaController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $causas = Causa::search($request->busqueda)->orderBy('id')->paginate(10);

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
        $causales = Causal::all();
        $operadores = Operador::all();

        return view('causas/create', ['etapas' => $etapas, 'causales' => $causales, 'operadores' => $operadores]);
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
            'nombre.unique' => 'El Nombre debe ser únixo',
            'num_exp.required' => 'El Número de Expediente es obligatorio',
            'num_exp.unique' => 'El Número de Expediente debe ser único',
            'num_exp.numeric' => 'El Número de Expediente debe ser un valor numérico'
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:causas',
            'num_exp' => 'required|unique:causas|numeric'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('CausaController@create')->withErrors($validator)->withInput();
        }

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

        $causa->procedimiento = $request->procedimiento;
        $causa->fecha_sentencia = $request->fecha_sentencia;

        $causa->save();

        $num_causal = 0;

        if($request->causal1 != 0) {
            if($request->sentencia1) 
                $sentencia = true;
            else
                $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal1,
                'sentencia' => $sentencia,
                'num_causal' => 1
            ]);
        }

        if($request->causal2 != 0) {
            if($request->sentencia2) 
                $sentencia = true;
            else
                $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal2,
                'sentencia' => $sentencia,
                'num_causal' => 2
            ]);
        }

        if($request->causal3 != 0) {
            if($request->sentencia3) 
                $sentencia = true;
            else
                $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal3,
                'sentencia' => $sentencia,
                'num_causal' => 3
            ]);
        }

        if($request->juez != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->juez,
                'cargo' => 1
            ]);
        }

        if($request->conjuez1 != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->conjuez1,
                'cargo' => 2
            ]);
        }

        if($request->conjuez2 != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->conjuez2,
                'cargo' => 3
            ]);
        }

        if($request->defensor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->defensor,
                'cargo' => 4
            ]);
        }

        if($request->abogado != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->abogado,
                'cargo' => 5
            ]);
        }

        if($request->vicario != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->vicario,
                'cargo' => 6
            ]);
        }

        if($request->notario != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->notario,
                'cargo' => 7
            ]);
        }

        if($request->instructor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->instructor,
                'cargo' => 8
            ]);
        }

        if($request->asesor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->asesor,
                'cargo' => 9
            ]);
        }

        $causa->save();

        return redirect()->action('CausaController@index')->with('message', '¡Causa creada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $causa = Causa::find($id);
        $causas = Causa::all()->sortByDesc('id')->take(5);

        return view('causas/show', ['causa_actual' => $causa, 'causas' => $causas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Causa  $causa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $causa = Causa::find($id);
        $etapas = Etapa::all();
        $operadores = Operador::all();
        $causales = Causal::all();

        $etapas_completadas = collect(unserialize($causa->etapas_completadas));

        $cSeleccionados = array();
        $cSeleccionados['causal1'] = 0;
        $cSeleccionados['sentencia1'] = false;
        $cSeleccionados['causal2'] = 0;
        $cSeleccionados['sentencia2'] = false;
        $cSeleccionados['causal3'] = 0;
        $cSeleccionados['sentencia3'] = false;

        foreach ($causa->causales as $causal) {
            switch ($causal->pivot->num_causal) {
                case '1':
                    $cSeleccionados['causal1'] = $causal->pivot->causal_id;
                    $cSeleccionados['sentencia1'] = $causal->pivot->sentencia;
                    break;
                case '2':
                    $cSeleccionados['causal2'] = $causal->pivot->causal_id;
                    $cSeleccionados['sentencia2'] = $causal->pivot->sentencia;
                    break;
                case '3':
                    $cSeleccionados['causal3'] = $causal->pivot->causal_id;
                    $cSeleccionados['sentencia3'] = $causal->pivot->sentencia;
                    break;
            }
        }

        $cargos = array();

        $cargos['juez']     = 0;
        $cargos['conjuez1'] = 0;
        $cargos['conjuez2'] = 0;
        $cargos['defensor'] = 0;
        $cargos['abogado']  = 0;
        $cargos['vicario']  = 0;
        $cargos['notario']  = 0;
        $cargos['instructor'] = 0;
        $cargos['asesor'] = 0;

        foreach($causa->operadores as $operador) {
            switch ($operador->pivot->cargo) {
                case '1':
                    $cargos['juez'] = $operador->pivot->operador_id;
                    break;
                case '2':
                    $cargos['conjuez1'] = $operador->pivot->operador_id;
                    break;
                case '3':
                    $cargos['conjuez2'] = $operador->pivot->operador_id;
                    break;
                case '4':
                    $cargos['defensor'] = $operador->pivot->operador_id;
                    break;
                case '5':
                    $cargos['abogado'] = $operador->pivot->operador_id;
                    break;
                case '6':
                    $cargos['vicario'] = $operador->pivot->operador_id;
                    break;
                case '7':
                    $cargos['notario'] = $operador->pivot->operador_id;
                    break;
                case '8':
                    $cargos['instructor'] = $operador->pivot->operador_id;
                    break;
                case '9':
                    $cargos['asesor'] = $operador->pivot->operador_id;
                    break;
            }
        }

        return view('causas/update', ['causa' => $causa, 'etapas' => $etapas, 'etapas_completadas' => $etapas_completadas, 'operadores' => $operadores, 'cargos' => $cargos, 'causales' => $causales, 'cSeleccionados' => $cSeleccionados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'El Nombre es obligatorio',
            'num_exp.required' => 'El Número de Expediente es obligatorio',
            'num_exp.numeric' => 'El Número de Expediente debe ser un valor numérico'
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'num_exp' => 'required|numeric'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('CausaController@edit', ['id' => $id])->withErrors($validator);
        }

        $etapas = $request->etapa;

        $causa = Causa::find($id);
        $causa->nombre = $request->nombre;
        $causa->num_exp = $request->num_exp;

        if(!empty($request->etapa)) {
            $causa->etapa_id = end($etapas);
            $causa->etapas_completadas = serialize($etapas);
        } else {
            $causa->etapa_id = NULL;
            $causa->etapas_completadas = NULL;
        }

        $causa->procedimiento = $request->procedimiento;
        $causa->fecha_sentencia = $request->fecha_sentencia;

        $causa->save();

        $existe1 = false;
        $existe2 = false;
        $existe3 = false;

        foreach ($causa->causales as $causal) {
            switch ($causal->pivot->num_causal) {
                case '1':
                    $existe1 = true;
                    break;
                case '2':
                    $existe2 = true;
                    break;
                case '3':
                    $existe3 = true;
                    break;
            }
        }

        if($existe1) {
            if($request->causal1 != 0) {
                if($request->sentencia1)
                    $sentencia = true;
                else
                    $sentencia = false;

                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 1])->update(['causal_id' => $request->causal1, 'sentencia' => $sentencia]);
            } else {
                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 1])->delete();
            }
        } elseif (!$existe1 && $request->causal1 != 0) {
            if($request->sentencia1)
                    $sentencia = true;
                else
                    $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal1,
                'sentencia' => $sentencia,
                'num_causal' => 1
            ]);
        }

        if($existe2) {
            if($request->causal2 != 0) {
                if($request->sentencia2)
                    $sentencia = true;
                else
                    $sentencia = false;

                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 2])->update(['causal_id' => $request->causal2, 'sentencia' => $sentencia]);
            } else {
                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 2])->delete();
            }
        } elseif (!$existe2 && $request->causal2 != 0) {
            if($request->sentencia2)
                    $sentencia = true;
                else
                    $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal2,
                'sentencia' => $sentencia,
                'num_causal' => 2
            ]);
        }

        if($existe3) {
            if($request->causal3 != 0) {
                if($request->sentencia3)
                    $sentencia = true;
                else
                    $sentencia = false;                

                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 3])->update(['causal_id' => $request->causal1, 'sentencia' => $sentencia]);
            } else {
                DB::table('causa_causal')->where(['causa_id' => $causa->id, 'num_causal' => 3])->delete();
            }
        } elseif (!$existe3 && $request->causal3 != 0) {
            if($request->sentencia3)
                    $sentencia = true;
                else
                    $sentencia = false;

            $causa->causales()->save($causa, [
                'causal_id' => $request->causal3,
                'sentencia' => $sentencia,
                'num_causal' => 3
            ]);
        }

        $juez = false;
        $conjuez1 = false;
        $conjuez2 = false;
        $defensor = false;
        $abogado = false;
        $vicario = false;
        $notario = false;
        $instructor = false;
        $asesor = false;

        foreach ($causa->operadores as $operador) {
            switch ($operador->pivot->cargo) {
                case '1':
                    $juez = true;
                    break;
                case '2':
                    $conjuez1 = true;
                    break;
                case '3':
                    $conjuez2 = true;
                    break;
                case '4':
                    $defensor = true;
                    break;
                case '5':
                    $abogado = true;
                    break;
                case '6':
                    $vicario = true;
                    break;
                case '7':
                    $notario = true;
                    break;
                case '8':
                    $instructor = true;
                    break;
                case '9':
                    $asesor = true;
                    break;
            }
        }

        if($juez) {
            if($request->juez != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 1])->update(['operador_id' => $request->juez]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 1])->delete();
            }
        } elseif (!$juez && $request->juez != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->juez,
                'cargo' => 1
            ]);
        }

        if($conjuez1) {
            if($request->conjuez1 != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 2])->update(['operador_id' => $request->conjuez1]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 2])->delete();
            }
        } elseif (!$conjuez1 && $request->conjuez1 != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->conjuez1,
                'cargo' => 2
            ]);
        }

        if($conjuez2) {
            if($request->conjuez2 != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 3])->update(['operador_id' => $request->conjuez2]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 3])->delete();
            }
        } elseif (!$conjuez2 && $request->conjuez2 != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->conjuez2,
                'cargo' => 3
            ]);
        }

        if($defensor) {
            if($request->defensor != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 4])->update(['operador_id' => $request->defensor]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 4])->delete();
            }
        } elseif (!$defensor && $request->defensor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->defensor,
                'cargo' => 4
            ]);
        }

        if($abogado) {
            if($request->abogado != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 5])->update(['operador_id' => $request->abogado]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 5])->delete();
            }
        } elseif (!$abogado && $request->abogado != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->abogado,
                'cargo' => 5
            ]);
        }

        if($vicario) {
            if($request->vicario != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 6])->update(['operador_id' => $request->vicario]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 6])->delete();
            }
        } elseif (!$vicario && $request->vicario != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->vicario,
                'cargo' => 6
            ]);
        }

        if($notario) {
            if($request->notario != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 7])->update(['operador_id' => $request->notario]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 7])->delete();
            }
        } elseif (!$notario && $request->notario != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->notario,
                'cargo' => 7
            ]);
        }

        if($instructor) {
            if($request->instructor != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 8])->update(['operador_id' => $request->instructor]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 8])->delete();
            }
        } elseif (!$instructor && $request->instructor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->instructor,
                'cargo' => 8
            ]);
        }

        if($asesor) {
            if($request->asesor != 0) {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 8])->update(['operador_id' => $request->asesor]);
            } else {
                DB::table('causa_operador')->where(['causa_id' => $causa->id, 'cargo' => 8])->delete();
            }
        } elseif (!$asesor && $request->asesor != 0) {
            $causa->operadores()->save($causa, [
                'operador_id' => $request->asesor,
                'cargo' => 8
            ]);
        }

        return redirect()->action('CausaController@index')->with('message', '¡Causa actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Causa  $causa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $causa = Causa::find($id);

        foreach ($causa->operadores as $operador) {
            $operador->pivot->delete();
        }

        foreach ($causa->causales as $causal) {
            $causal->pivot->delete();
        }

        $causa->delete();

        return redirect()->action('CausaController@index')->with('message', '¡Causa eliminada con éxito!');
    }
    
    public function report()
    {
        return view('pdf/create');
    }

    public function statisticalPdf(Request $request)
    {
        $messages = [
            'inicio.required' => 'Indique la fecha de inicio',
            'fin.required' => 'Indique la fecha de fin'
        ];
        
        $validator = Validator::make($request->all(), [
            'inicio' => 'required',
            'fin' => 'required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->action('CausalController@report')->withErrors($validator);
        }

        $r = Causa::whereBetween('fecha_sentencia', [$request->inicio, $request->fin])->get();

        $c_fase_previa   = 0;
        $c_proceso       = 0;
        $c_fase_pruebas  = 0;
        $c_finalizada    = 0;
        $c_sentenciada   = 0;

        $result = array();
        $result['total'] = 0;
        $result['c_fase_previa']   = 0;
        $result['c_proceso']       = 0;
        $result['c_fase_prueba']   = 0;
        $result['c_finalizada']    = 0;
        $result['c_sentenciada']   = 0;
            
        foreach($r as $rr) {
            if($rr->etapa) {
                switch($rr->etapa->fase_id) {
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
            if(count($rr->causales) > 0) {
                foreach ($rr->causales as $causal) {
                    if($causal->pivot->sentencia) {
                        $c_sentenciada++;
                        break;
                    }
                }
            }
        }

        $result['total'] = count($r);
        $result['c_fase_previa']   = $c_fase_previa;
        $result['c_proceso']       = $c_proceso;
        $result['c_fase_prueba']   = $c_fase_pruebas;
        $result['c_finalizada']    = $c_finalizada;
        $result['c_sentenciada']   = $c_sentenciada;
        
        $pdf = PDF::loadView('pdf/estadistico', ['result' => $result, 'request' => $request]);

        $hoy = getDate();

        return $pdf->download('reporte_estadistico.pdf');
    }

    public function individualPdf($id)
    {
        $causa = Causa::find($id);

        $pdf = PDF::loadView('pdf/individual', ['causa' => $causa]);

        return $pdf->download($causa->nombre . '.pdf');
    }

}

