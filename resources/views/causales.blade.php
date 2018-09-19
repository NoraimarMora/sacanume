@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/listado.css') }}">
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

@section('controller')
{{ action('CausalController@create') }}
@endsection

@section('buscador')
{{ action('CausalController@index') }}
@endsection

@section('buscar')
causal...
@endsection

@section('contenido_sublayout')
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <style type="text/css">
        #file_button {
            display: none;
        }
    </style>
    
    <div class="lista">
        <table class="table-hover">
            <thead>
                <tr>
                    <th class="text-center">Cannon</th>
                    <th class="text-center">#</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center accion" id="accion">Acción</th>                                        
                </tr>
            </thead>
            <tbody>
                @if(count($causales) == 0)
                    <tr>
                        <td class="text-center" colspan="4">No se encontraron registros</td>
                    </tr>
                @endif

                @foreach($causales as $causal)
                    <tr>
                        <td class="text-center">{{ $causal->cannon }}</td>
                        <td>
                            @if($causal->numero)
                                {{ $causal->numero }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $causal->descripcion }}</td>
                        <td class="text-center accion">
                            <form id="editar{{ $causal->id }}" action="{{ action('CausalController@edit', ['id' => $causal->id]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <form id="eliminar{{ $causal->id }}" action="{{ action('CausalController@destroy', ['id' => $causal->id]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <button class="btn btn-success btn-icon btn-sm " type="submit" form="editar{{ $causal->id }}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-icon btn-sm " type="submit" form="eliminar{{ $causal->id }}" onclick="return confirm('Esta seguro que desea eliminar el registro?');"><i class="fa fa-trash"></i></button>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="links">
            {{ $causales->links() }}
        </div>
    </div>
@endsection