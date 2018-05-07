@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/causa_actual.css') }}">    
@endsection

@section('estado_menu')
    <li class="active">
        <a href="{{ action('InicioController@index') }}">
            <i class="fa fa-home"></i>
            <p>Inicio</p>
        </a>
    </li>
    <li>
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
        <a href="{{ action('OperadorController@index') }}">
            <i class="fa fa-users"></i>
            <p>Operadores</p>
        </a>
    </li>
    <li>
        <a href="{{ action('UsuarioController@index') }}">
            <i class="fa fa-user"></i>
            <p>Usuarios</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ConfiguracionController@index') }}">
            <i class="fa fa-cogs"></i>
            <p>Configuracion</p>
        </a>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-sign-out"></i>
            <p>Salir</p>
        </a>
    </li>
@endsection

@section('contenido_sublayout')
    <div class="last-cases col-md-3">
        <ul class="lista">
            <li class="">
                <a href="{{ action('InicioController@index') }}" id="general">
                    <p>General</p>
                </a>
            </li>
            @foreach($causas as $causa)
                @if($causa->id == $causa_actual->id)
                    <li class="active">
                @else
                    <li class="">
                @endif
                        <a href="{{ action('CausaController@show', ['causa' => $causa]) }}" id="{{ $causa->id }}">
                            <p>{{ $causa->nombre }}</p>
                        </a>
                    </li>
            @endforeach
        </ul>
    </div>
    <div class="content-section col-md-9">
        <div class="causa-content">
            <h4>{{ $causa_actual->nombre }}</h4>
            <p>Numero de expediente: {{ $causa_actual->num_exp }}</p>
            <p>
                Estado: {{ $causa_actual->etapa->fase->descripcion }} 
                <i class="fa fa-arrow-right"></i> 
                {{ $causa_actual->etapa->descripcion }}
            </p>
            <p>Causales:</p>
            <ul>
                @foreach($causa_actual->causales as $causal)
                    <li>
                        <p>{{ $causal->cannon }}
                            @if($causal->numero != NULL)
                                , {{ $causal->numero }}
                            @endif    
                            > {{ $causal->nombre }}</p>
                    </li>
                @endforeach
            </ul>
            <p>Operadores:</p>
                <ul>
                    @foreach($causa_actual->operadores as $operador)
                        @switch($operador->cargo)
                            @case(1)
                                <li>
                                    <p>Presidente del Turno: {{ $operador->nombre }}</p>
                                </li>
                                @break
                            @case(2)
                                <li>
                                    <p>Conjuez: {{ $operador->nombre }}</p>
                                </li>
                                @break
                            @case(3)
                                <li>
                                    <p>Conjuez: {{ $operador->nombre }}</p> 
                                </li>
                                @break
                            @case(4)
                                <li>
                                    <p>Defensor del Vinculo: {{ $operador->nombre }}</p> 
                                </li>
                                @break
                            @case(5)
                                <li>
                                    <p>Patrono Estable: {{ $operador->nombre }}</p>
                                </li>
                                @break
                        @endswitch
                    @endforeach           
                </ul>
        </div>
    </div>
@endsection