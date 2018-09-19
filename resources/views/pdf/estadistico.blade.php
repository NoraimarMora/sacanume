@extends('pdf/reporte')

@section('tipo_reporte')
Reporte Estadistico
@endsection

@section('contenido')
	<div>
		<p class="contenido-reporte">
			<strong>Periodo:</strong> {{ $request->inicio }} hasta {{ $request->fin }} 
			<br><br>
			<strong>Fase Previa:</strong> {{ $result['c_fase_previa'] }}
			<br><br>
			<strong>En proceso:</strong> {{ $result['c_proceso'] }}
			<br><br>
			<strong>Fase de Prueba:</strong> {{ $result['c_fase_prueba'] }}
			<br><br>
			<strong>Finalizadas:</strong> {{ $result['c_finalizada'] }}
			<br><br>
			<strong>Total:</strong> {{ $result['total'] }}
		</p>
	</div>
@endsection