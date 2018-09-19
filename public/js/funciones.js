$(document).ready(function() {
    $('.sentencia').click(function() {
        if($('#sentencia1').is(':checked') || $('#sentencia2').is(':checked') || $('#sentencia3').is(':checked')) {
            $('#fecha_sentencia').prop('disabled', false);
        } else {
            $('#fecha_sentencia').prop('disabled', true);
            $('#fecha_sentencia').val('');
        }
    });

    $('#proced1').click(function() {
    	$('#ordinario').prop('hidden', false);
    	$('#breve').prop('hidden', true);
    	$('#instructor').val("0");
    	$('#asesor').val("0");
    });

    $('#proced2').click(function() {
	    $('#ordinario').prop('hidden', true);
	    $('#breve').prop('hidden', false);
	    $('#conjuez1').val("0");
    	$('#conjuez2').val("0");
    });
});