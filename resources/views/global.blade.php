<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SACANUME</title>

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">	 
	 
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/global.css') }}">
	
	@yield('estilos_sublayout')

	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	@yield('scripts_sublayout')
	
</head>
<body>
	@if(Auth::user()->tipo == 2 || Auth::user()->tipo == 3)
		<style type="text/css">
			.sidebar .nav li#menu_usuario {
				display: none;
			}
		</style>
	@endif

	@if(Auth::user()->tipo == 3)
		<style type="text/css">
			#add_button,
			.accion {
				display: none;
			}
		</style>
	@endif
	<div class="wrapper">
		<div class="sidebar">
			<div class="nombre">
                <div class="simple-text">
					{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
                </div>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					@yield('estado_menu')
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<header class="container-fluid">
                <div class="titulo col-md-12">
                    <h2><strong>SISTEMA DE ADMINISTRACIÓN DE CASOS DE NULIDAD MATRIMONIAL ESCLESIÁSTICA</strong></h2>                
                </div>
			</header>
			<div class="search">
				<a href="@yield('controller')" id="add_button">
					<img src="{{ asset('img/ad.png') }}">
				</a>
                <!--a href="#">
					<img src="{{ asset('img/File.png') }}">
				</a-->
				<form id="buscador" action="@yield('buscador')">
	                <div class="input-group">
	                    <i id="search-icon" class="fa fa-search"></i>
	                    <input type="text" name="busqueda" placeholder="Buscar @yield('buscar')">
	                </div>
                </form>
            </div>
			<div class="content container-fluid row">
				@yield('contenido_sublayout')
			</div>
		</div>		
	</div>
</body>