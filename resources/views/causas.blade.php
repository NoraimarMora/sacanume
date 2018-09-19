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

@section('controller')
{{ action('CausaController@create') }}
@endsection

@section('buscador')
{{ action('CausaController@index') }}
@endsection

@section('buscar')
causa...
@endsection

@section('contenido_sublayout')
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    <div class="lista">
        <table class="table-hover">
            <thead>
                <tr>
                    <th class="text-center"># Exp.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th class="text-center" id="accion">Acción</th>                              
                </tr>
            </thead>
            <tbody>
                @if(count($causas) == 0)
                    <tr>
                        <td class="text-center" colspan="4">No se encontraron registros</td>
                    </tr>
                @endif

                @foreach($causas as $causa)
                    <tr>
                        <td class="text-center">{{ $causa->num_exp }}</td>
                        <td>{{ $causa->nombre }}</td>
                        <td>
                            @if($causa->fecha_sentencia)
                                Sentenciada el dia {{ $causa->fecha_sentencia }}
                            @else
                                @if($causa->etapa)
                                    {{ $causa->etapa->fase->descripcion }} 
                                    <i class="fa fa-arrow-right"></i>  
                                    {{ $causa->etapa->descripcion }}
                                @else
                                     -
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            <form id="reporte{{ $causa->id }}" action="{{ action('CausaController@individualPdf', ['id' => $causa->id]) }}"></form>
                            <form id="editar{{ $causa->id }}" action="{{ action('CausaController@edit', ['id' => $causa->id]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <form id="eliminar{{ $causa->id }}" action="{{ action('CausaController@destroy', ['id' => $causa->id]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <button class="btn btn-info btn-icon btn-sm" type="button" data-toggle="modal" data-target="#modal_causa{{ $causa->id }}"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-primary btn-icon btn-sm" type="submit" form="reporte{{ $causa->id }}"><i class="fa fa-file"></i></button>
                            <button class="btn btn-success btn-icon btn-sm accion" type="submit" form="editar{{ $causa->id }}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-icon btn-sm accion" type="submit" form="eliminar{{ $causa->id }}" onclick="return confirm('¿Está seguro que desea eliminar el registro?');"><i class="fa fa-trash"></i></button>
                        </td>                        
                    </tr>
                    <div id="modal_causa{{ $causa->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" style="color: #FF5349;">{{ $causa->nombre }}</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Número de expediente: {{ $causa->num_exp }}</strong></p>
                                    <p>
                                        <strong>Estado: </strong>
                                        @if($causa->fecha_sentencia)
                                            Sentenciada el dia {{ $causa->fecha_sentencia }}
                                        @else
                                            @if($causa->etapa)
                                                {{ $causa->etapa->fase->descripcion }} 
                                                <i class="fa fa-arrow-right"></i>  
                                                {{ $causa->etapa->descripcion }}
                                            @endif
                                        @endif
                                    </p>
                                    @if(count($causa->causales) > 0)
                                        <p><strong>Causales:</strong></p>
                                        <ul>
                                            @foreach($causa->causales as $causal)
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
                                        <p><strong>Causales:</strong> Aun no se han definido</p>
                                    @endif
                                    <p><strong>Procedimiento:</strong> 
                                        @if($causa->procedimiento == 1)
                                            Ordinario
                                        @else
                                            Breve
                                        @endif
                                    </p>
                                    @if(count($causa->operadores) > 0)
                                        <p><strong>Operadores:</strong></p>
                                        <ul>
                                            @foreach($causa->operadores as $operador)
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
                                                    @case(6)
                                                        <li>
                                                            <p>Vicario Judicial: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                                        </li>
                                                        @break
                                                    @case(7)
                                                        <li>
                                                            <p>Notario: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                                        </li>
                                                        @break
                                                    @case(8)
                                                        <li>
                                                            <p>Instructor: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                                        </li>
                                                        @break
                                                    @case(9)
                                                        <li>
                                                            <p>Asesor: {{ $operador->nombre }} {{ $operador->apellido }}</p>
                                                        </li>
                                                        @break
                                                @endswitch
                                            @endforeach           
                                        </ul>
                                    @else
                                        <p><strong>Operadores:</strong> Aun no se han definido</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="links">
            {{ $causas->links() }}
        </div>
    </div>
@endsection