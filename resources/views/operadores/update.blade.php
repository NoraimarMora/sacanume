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
    <li class="active">
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
        
        <form id="editar_operador" action="{{ action('OperadorController@update', ['id' => $operador->id]) }}" method="POST">
            <h3><strong>Editar Operador</strong></h3>
            <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">* <strong>Nombre:</strong></label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $operador->nombre }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="apellido">* <strong>Apellido:</strong></label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="{{ $operador->apellido }}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="titulo">* <strong>Titulo:</strong></label>
                <br>
                <select id="titulo" name="titulo">
                    @if($operador->titulo == 'Obispo')
                        <option value="Obispo" selected>Obispo</option>
                    @else
                        <option value="Obispo">Obispo</option>
                    @endif
                    
                    @if($operador->titulo == 'Monseñor')
                        <option value="Monseñor" selected>Monseñor</option>
                    @else
                        <option value="Monseñor">Monseñor</option>
                    @endif 
                    @if($operador->titulo == 'Licenciado/a')
                        <option value="Licenciado/a" selected>Licenciado/a</option>
                    @else
                        <option value="Licenciado/a">Licenciado/a</option>
                    @endif
                    @if($operador->titulo == 'Otro')
                        <option value="Otro" selected>Otro</option>
                    @else
                        <option value="Otro">Otro</option>
                    @endif 
                </select>
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