@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/create_causal.css') }}">
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
    <li class="active">
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
            <i class="fa fa-sign-out-alt"></i>
            <p>Salir</p>
        </a>
    </li>
@endsection

@section('contenido_sublayout')
    <div class="container">
        <form id="nuevo_causal" action="{{ action('CausalController@update', ['causal' => $causal]) }}" method="POST">
            <h3><strong>Editar Causal</strong></h3>
            <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="cannon"><strong>Cannon:</strong></label>
                    <input type="text" class="form-control" name="cannon" id="cannon" value="{{ $causal->cannon }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="numero"><strong>Numero:</strong></label>
                    <input type="number" class="form-control" name="numero" id="numero" min="1">
                </div>
            </div>
            <div class="form-group col-md-12" id="select">
                <label for="causales"><strong>Descripcion:</strong></label>
                <input type="text" class="form-control" name="descripcion" id="descripcion">
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-icon btn-sm pull-right">
                    <i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection