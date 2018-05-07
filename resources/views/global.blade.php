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
	<div class="wrapper">
		<div class="sidebar">
			<div class="nombre">
                <div class="simple-text">
					<!-- Aqui va una variable que retorne el nombre del usuario actual-->
                    Valentina Gobbo 
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
				<a href="@yield('controller')">
					<img src="{{ asset('img/ad.png') }}">
				</a>
                <a href="#">
					<img src="{{ asset('img/File.png') }}">
				</a>
                <div class="input-group">
                    <i id="search-icon" class="fa fa-search"></i>
                    <input type="text" name="busqueda"></div>
            </div>
			<div class="content container-fluid row">
				@yield('contenido_sublayout')
			</div>
		</div>		
	</div>
</body>