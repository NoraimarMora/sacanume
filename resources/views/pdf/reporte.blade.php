<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<title>Reporte</title>

	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

	<style type="text/css">
		p {
			line-height: 0.8;
		}

        .contenido-reporte {
            margin-top: 300px;
            margin-left: 65px;
        }
	</style>
</head>
<body>
	<div>
		<!-- Membrete -->
		<div class="row">
			<div class="col-md-3">
				<img src="{{ asset('img/logo-diocesis.png') }}" width="125" height="125" style="float: left; margin-top: 20px; margin-left: 5px;">
			</div>
			<div class="col-md-6" style="margin: auto;">
				<p class="text-center" style="margin-top: 30px;">Diócesis de Ciudad Guayana</p>
				<p class="text-center"><strong>Monseñor Helizandro Terán O.S.A.</strong></p>
				<p class="text-center"><strong><em>Por la gracia de Dios y de la Santa Sede Apostólica</em></strong></p>
				<p class="text-center">Obispo de Ciudad Guayana</p>
			</div>
			<div class="col-md-3">
				<img src="{{ asset('img/logo-verde.png') }}" width="125" height="125" style="float: right; margin-top: 20px; margin-right: 5px;">
			</div>
		</div>

		<!-- Titulo -->
		<div class="row" style="margin: auto;">
			<div>
				<p class="text-center" style="margin-top: 210px;">
					<strong>Sistema de Administración de Casos de Nulidad Matrimonial Eclesiástica</strong>
					<br><br><br>
					<strong>@yield('tipo_reporte')</strong>
				</p>
			</div>
		</div>

		<!-- Contenido -->
		<div class="row">
			@yield('contenido')
		</div>
	</div>
</body>
</html>