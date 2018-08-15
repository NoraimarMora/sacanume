function agregarCausal() {
	$('#select').append('<select name="causales[]" id="causales">'
	                    	+ '<option value="0">---</option>'
	                    	+ '@foreach($causales as $causal)'
	                        + '<option value="{{ $causal->id }}">{{ $causal->descripcion }}</option>'
		                    + '@endforeach'
		                	+ '</select>'
		                	+ '<label class="sentencia"><input type="checkbox" name="sentencia" class="sentencia"><i class="fa fa-gavel"></i></label>');
}