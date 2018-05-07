@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/create_causa.css') }}">
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
        <form id="nueva_causa" action="{{ action('CausaController@store') }}" method="POST">
            <h3><strong>Nueva Causa</strong></h3>
            <br>
            <div class="form-group col-md-6">
                <label for="nombre"><strong>Nombre:</strong></label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="num_exp"><strong>Numero de Expediente:</strong></label>
                <input type="number" class="form-control" name="num_exp" id="num_exp" min="1">
            </div>
            <div class="form-group col-md-12" id="select">
                <label for="causales"><strong>Causales:</strong></label>
                <br>
                <select name="causales[]" id="causales">
                    <option>Causal 1</option>
                </select>
                <a href="#"><i class="fa fa-plus-circle"></i></a>
            </div>
            <div class="form-group col-md-12">
                <label><strong>Etapas:</strong></label>
                <ul class="lista-etapas">
                    @foreach($etapas as $etapa)
                        <li>
                            <input type="checkbox" name="etapa[]" value="{{ $etapa->id }}">
                            {{ $etapa->descripcion }}.
                            @if($etapa->id == 6)
                                &nbsp;Fecha:
                                <input type="date" class="form-control" name="fecha" id="fecha">
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group col-md-12">
                <label><strong>Operadores:</strong></label>
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