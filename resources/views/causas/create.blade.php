@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('scripts_sublayout')
    <script type="text/javascript" src="{{ asset('js/funciones.js') }}"></script>
@endsection

@section('estado_menu')
    <li>
        <a href="{{ action('InicioController@index') }}">
            <i class="fa fa-home"></i>
            <p>Inicio</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ action('CausaController@index') }}">
            <i class="fa fa-balance-scale"></i>
            <p>Causas</p>
        </a>
    </li>
    <li>
        <a href="{{ action('CausalController@index') }}">
            <i class="fa fa-book"></i>
            <p>Causales</p>
        </a>
    </li>
    <li>
        <a href="{{ action('EtapaController@index') }}">
            <i class="fa fa-list"></i>
            <p>Etapas</p>
        </a>
    </li>
    <li>
        <a href="{{ action('OperadorController@index') }}">
            <i class="fa fa-users"></i>
            <p>Operadores</p>
        </a>
    </li>
    <li id="menu_usuario">
        <a href="{{ action('UsuarioController@index') }}">
            <i class="fa fa-user"></i>
            <p>Usuarios</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ConfiguracionController@edit', ['id' => Auth::user()->id]) }}">
            <i class="fa fa-cogs"></i>
            <p>Configuración</p>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i>
            <p>Salir</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
@endsection

@section('contenido_sublayout')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="nueva_causa" action="{{ action('CausaController@store') }}" method="POST">
            <h3><strong>Nueva Causa</strong></h3>
            <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">* <strong>Nombre:</strong></label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="num_exp">* <strong>Número de Expediente:</strong></label>
                    <input type="text" class="form-control" name="num_exp" id="num_exp" value="{{ old('num_exp') }}">
                </div>
            </div>
            <div class="form-group col-md-12" id="select">
                <label for="causales"><strong>Causales:</strong></label>
                <br>
                <label>1: </label>
                <select name="causal1" class="causales">
                    <option value="0">---</option>
                    @foreach($causales as $causal)
                        <option value="{{ $causal->id }}">{{ $causal->descripcion }}</option>
                    @endforeach
                </select>
                <label class="sentencia"><input type="checkbox" name="sentencia1" id="sentencia1" class="sentencia"><i class="fa fa-gavel"></i></label>
                <br>
                <label>2: </label>
                <select name="causal2" class="causales">
                    <option value="0">---</option>
                    @foreach($causales as $causal)
                        <option value="{{ $causal->id }}">{{ $causal->descripcion }}</option>
                    @endforeach
                </select>
                <label class="sentencia"><input type="checkbox" name="sentencia2" id="sentencia2" class="sentencia"><i class="fa fa-gavel"></i></label>
                <br>
                <label>3: </label>
                <select name="causal3" class="causales">
                    <option value="0">---</option>
                    @foreach($causales as $causal)
                        <option value="{{ $causal->id }}">{{ $causal->descripcion }}</option>
                    @endforeach
                </select>
                <label class="sentencia"><input type="checkbox" name="sentencia3" id="sentencia3" class="sentencia"><i class="fa fa-gavel"></i></label>
            </div>
            <div class="form-group col-md-12">
                <label><strong>Fecha de Sentencia</strong></label>
                <br>
                <input type="date" name="fecha_sentencia" id="fecha_sentencia" class="form-control" disabled>
            </div>
            <div class="form-group col-md-12">
                <label><strong>Etapas:</strong></label>
                <ul class="lista-etapas">
                    @foreach($etapas as $etapa)
                        <li>
                            <input type="checkbox" name="etapa[]" value="{{ $etapa->id }}">
                            {{ $etapa->descripcion }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group col-md-12">
                <label><strong>Procedimiento</strong></label>
                <br>
                <input type="radio" name="procedimiento" id="proced1" value="1" checked> Procedimiento Ordinario
                <br>
                <input type="radio" name="procedimiento" id="proced2" value="2"> Procedimiento Breve                
            </div>
            <div class="form-group col-md-12">
                <label><strong>Operadores:</strong></label>
                <br>
                <ul class="operadores">
                    <li>
                        <label>Juez: </label>&nbsp;&nbsp;
                        <select name="juez" class="operador" style="width: 88%;">
                            <option value="0">---</option>
                            @foreach($operadores as $operador)
                                <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                            @endforeach
                        </select>
                    </li>
                    <div id="ordinario">
                        <li>
                            <label>Conjuez: </label>&nbsp;&nbsp;
                            <select name="conjuez1" id="conjuez1" class="operador" style="width: 85.05%;">
                                <option value="0">---</option>
                                @foreach($operadores as $operador)
                                    <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label>Conjuez: </label>&nbsp;&nbsp;
                            <select name="conjuez2" id="conjuez2" class="operador" style="width: 85.05%;">
                                <option value="0">---</option>
                                @foreach($operadores as $operador)
                                    <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                                @endforeach
                            </select>
                        </li>
                    </div>
                    <div id="breve" hidden>
                        <li>
                            <label>Instructor: </label>&nbsp;&nbsp;
                            <select name="instructor" id="instructor" class="operador" style="width: 83.55%;">
                                <option value="0">---</option>
                                @foreach($operadores as $operador)
                                    <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label>Asesor: </label>&nbsp;&nbsp;
                            <select name="asesor" id="asesor" class="operador" style="width: 86.2%;">
                                <option value="0">---</option>
                                @foreach($operadores as $operador)
                                    <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                                @endforeach
                            </select>
                        </li>
                    </div>
                    <li>
                        <label>Defensor del vínculo: </label>&nbsp;&nbsp;
                        <select name="defensor" class="operador" style="width: 73.5%;">
                            <option value="0">---</option>
                            @foreach($operadores as $operador)
                                <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <label>Abogado: </label>&nbsp;&nbsp;
                        <select name="abogado" class="operador" style="width: 84.1%;">
                            <option value="0">---</option>
                            @foreach($operadores as $operador)
                                <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <label>Vicario Judicial: </label>&nbsp;&nbsp;
                        <select name="vicario" class="operador" style="width: 78.2%;">
                            <option value="0">---</option>
                            @foreach($operadores as $operador)
                                <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <label>Notario: </label>&nbsp;&nbsp;
                        <select name="notario" class="operador" style="width: 85.5%;">
                            <option value="0">---</option>
                            @foreach($operadores as $operador)
                                <option value="{{ $operador->id }}">{{ $operador->nombre }} {{ $operador->apellido }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-icon btn-sm pull-right">
                    <i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection