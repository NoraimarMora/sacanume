@extends('pdf/reporte')

@section('tipo_reporte')
Reporte Individual
@endsection

@section('contenido')
	<div>
		<p class="contenido-reporte">
			<strong>Nombre:</strong> 
				{{ $causa->nombre }}
			<br><br>
			<strong>Número de Expediente:</strong> 
				{{ $causa->num_exp }}
			<br><br>
			<strong>Estado:</strong> 
				@if($causa->fecha_sentencia)
                    Sentenciada el dia {{ $causa->fecha_sentencia }}
                @else
                    @if($causa->etapa)
                        {{ $causa->etapa->fase->descripcion }} 
                         -  
                        {{ $causa->etapa->descripcion }}
                    @endif
                @endif
			<br><br>
			<strong>Causales:</strong>
			@if(count($causa->causales) > 0)
				<br><br>
                @foreach($causa->causales as $causal)
                    + {{ $causal->cannon }}
                    @if($causal->numero)
                        , {{ $causal->numero }}
                    @endif    
                     -  
                    {{ $causal->descripcion }}
            	@endforeach
            @else
                Aun no se han definido
            @endif
			<br><br>
			<strong>Procedimiento:</strong> 
				@if($causa->procedimiento == 1)
					Ordinario
				@else
					Breve
				@endif
			<br><br>
			<strong>Operadores:</strong>
			@if(count($causa->operadores) > 0)
                @foreach($causa->operadores as $operador)
                    @switch($operador->pivot->cargo)
                        @case(1)
                            + Juez: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
                        @case(2)
                            + Conjuez: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
                        @case(3)
                	        + Conjuez: {{ $operador->nombre }} {{ $operador->apellido }} 
                            @break
                        @case(4)
                            + Defensor del Vinculo: {{ $operador->nombre }} {{ $operador->apellido }} 
                            @break
                        @case(5)
                            + Abogado: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
                        @case(6)
                            + Vicario Judicial: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
                        @case(7)
                            + Notario: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
						@case(8)
                            + Instructor: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
						@case(9)
                            + Asesor: {{ $operador->nombre }} {{ $operador->apellido }}
                            @break
                    @endswitch
                @endforeach           
            @else
                Aun no se han definido
            @endif
		</p>
	</div>
@endsection