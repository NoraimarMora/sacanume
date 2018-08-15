@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('estado_menu')
    <li>
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
    <li class="active">
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
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success" style="width: 70%;">
                {{ session('message') }}
            </div>
        @endif
        
        <form id="configuracion" action="{{ action('ConfiguracionController@update', ['id' => Auth::user()->id]) }}" method="POST">
            <h3><strong>Configuracion</strong></h3>
            <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">* <strong>Nombre:</strong></label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ Auth::user()->nombre }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="apellido">* <strong>Apellido:</strong></label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="{{ Auth::user()->apellido }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="username"><strong>Usuario:</strong></label>
                    <input type="username" class="form-control" name="username" id="username" value="{{ Auth::user()->username }}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="password"><strong>Contraseña:</strong></label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
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