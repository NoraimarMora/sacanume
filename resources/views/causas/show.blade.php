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
    <li id="menu_usuario">
        <a href="{{ action('UsuarioController@index') }}">
            <i class="fa fa-user"></i>
            <p>Usuarios</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ConfiguracionController@edit', ['id' => Auth::user()->id]) }}">
            <i class="fa fa-cogs"></i>
            <p>Configuracion</p>
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
                        <a href="{{ action('CausaController@show', ['id' => $causa->id]) }}" id="{{ $causa->id }}">
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
                Estado: 
                @if($causa_actual->etapa)
                    {{ $causa_actual->etapa->fase->descripcion }} 
                    <i class="fa fa-arrow-right"></i> 
                    {{ $causa_actual->etapa->descripcion }}
                @endif
            </p>
            @if(count($causa_actual->causales) > 0)
                <p>Causales:</p>
                <ul>
                    @foreach($causa_actual->causales as $causal)
                        <li>
                            <p>{{ $causal->cannon }}
                                @if($causal->numero)
                                    , {{ $causal->numero }}
                                @endif    
                                <i class="fa fa-arrow-right"></i> 
                                {{ $causal->descripcion }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Causales: Aun no se han definido</p>
            @endif
            @if(count($causa_actual->operadores) > 0)
                <p>Operadores:</p>
                <ul>
                    @foreach($causa_actual->operadores as $operador)
                        @switch($operador->pivot->cargo)
                            @case(1)
                                <li>
                                    <p>Juez: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                </li>
                                @break
                            @case(2)
                                <li>
                                    <p>Conjuez: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                </li>
                                @break
                            @case(3)
                                <li>
                                    <p>Conjuez: {{ $operador->nombre }} {{ $operador->apellido }}</p> 
                                </li>
                                @break
                            @case(4)
                                <li>
                                    <p>Defensor del Vinculo: {{ $operador->nombre }} {{ $operador->apellido }}</p> 
                                </li>
                                @break
                            @case(5)
                                <li>
                                    <p>Patrono Estable: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                </li>
                                @break
                        @endswitch
                    @endforeach           
                </ul>
            @else
                <p>Operadores: Aun no se han definido</p>
            @endif
        </div>
    </div>
@endsection