@extends('global')

@section('estilos_sublayout')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/inicio.css') }}">
@endsection

@section('scripts_sublayout')
    <script src="{{ asset('js/chart.min.js') }}"></script>
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
    <div class="last-cases col-md-3">
        <ul class="lista">
            <li class="active">
                <a href="#" id="general">
                    <p>General</p>
                </a>
            </li>
            @foreach($causas as $causa)
                <li class="">
                    <a href="{{ action('CausaController@show', ['id' => $causa->id]) }}" id="{{ $causa->id }}">
                        <p>{{ $causa->nombre }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="content-section col-md-9">
        <div class="est-content">
            <h4><strong>Estadísticas del Sistema</strong></h4>
            <ul class="estadisticas">
                <li>
                    <p><strong>Causas registradas:</strong> {{ $estadisticas['c_registradas'] }}</p>
                </li>
                <li>
                    <p><strong>Causas en Fase Previa:</strong> {{ $estadisticas['c_fase_previa'] }}</p>
                </li>
                <li>
                    <p><strong>Causas en Proceso:</strong> {{ $estadisticas['c_proceso'] }}</p>
                </li>
                <li>
                    <p><strong>Causas en Fase de Prueba:</strong> {{ $estadisticas['c_fase_prueba'] }}</p>
                </li>
                <li>
                    <p><strong>Causas Finalizadas:</strong> {{ $estadisticas['c_finalizada'] }}</p>
                </li>
                <li>
                    <p><strong>Causas Sentenciadas:</strong> {{ $estadisticas['c_sentenciada'] }}</p>
                </li>
            </ul>
        </div>
        <div class="chart">
            <canvas id="pie" class="pie-chart">
        </div>
        <script>
            var cxt = document.getElementById("pie");
            Chart.defaults.global.legend.display = false;
            new Chart(cxt, {
                type: 'doughnut',
                data: {
                    labels: ['Fase Previa', 'Proceso', 'Fase de Prueba', 'Finalizada', 'Sentenciada'],
                    datasets: [{
                        label: 'My first dataset',
                        data: [<?php echo $estadisticas['c_fase_previa']?>, 
                               <?php echo $estadisticas['c_proceso']?>, 
                               <?php echo $estadisticas['c_fase_prueba']?>, 
                               <?php echo $estadisticas['c_finalizada']?>,
                               <?php echo $estadisticas['c_sentenciada']?>],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCD56', '#4BC0C0', '#4D394B']
                    }]
                }
            })
        </script>
    </div>
@endsection