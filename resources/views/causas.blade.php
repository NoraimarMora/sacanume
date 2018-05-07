@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" href="{{ asset('css/causas.css') }}">
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

@section('controller')
    {{ action('CausaController@create') }}
@endsection

@section('contenido_sublayout')
    <div class="lista">
        <table class="table-hover">
            <thead>
                <tr>
                    <th class="text-center"># Exp.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th class="text-center">Accion</th>                                        
                </tr>
            </thead>
            <tbody>
                @foreach($causas as $causa)
                    <tr>
                        <td class="text-center">{{ $causa->num_exp }}</td>
                        <td>{{ $causa->nombre }}</td>
                        <td>{{ $causa->etapa->fase->descripcion }} 
                            <i class="fa fa-arrow-right"></i> 
                            {{ $causa->etapa->descripcion }}
                        </td>
                        <td class="text-center">
                            <form id="editar" action="{{ action('CausaController@edit', ['causa' => $causa]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <form id="eliminar" action="{{ action('CausaController@destroy', ['causa' => $causa]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <button class="btn btn-success btn-icon btn-sm " type="submit" form="editar"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-icon btn-sm " type="submit" form="eliminar"><i class="fa fa-trash"></i></button>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="links">
            {{ $causas->links() }}
        </div>
    </div>
@endsection