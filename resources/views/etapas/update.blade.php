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
        
        <form id="editar_etapa" action="{{ action('EtapaController@update', ['id' => $etapa->id]) }}" method="POST">
            <h3><strong>Editar Etapa</strong></h3>
            <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group col-md-12" id="select">
                <label for="descripcion">* <strong>Descripción:</strong></label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $etapa->descripcion }}">
            </div>
            <br>
            <div class="form-group col-md-12">
                <label for="fase">* <strong>Fase:</strong></label>
                <br>
                <select id="fase" name="fase">
                    @foreach($fases as $fase)
                        @if($etapa->fase_id == $fase->id)
                            <option value="{{ $fase->id }}" selected>{{ $fase->descripcion }}</option>
                        @else
                            <option value="{{ $fase->id }}">{{ $fase->descripcion }}</option>
                        @endif
                    @endforeach
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