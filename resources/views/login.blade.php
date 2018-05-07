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
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">	
</head>
<body>
	<header>
		<h1><strong>SISTEMA DE ADMINISTRACIÓN</strong></h1>
        <h1><strong>DE CASOS DE NULIDAD MATRIMONIAL ESCLESIÁSTICA</strong></h1> 
	</header>
	<form>
	  <div class="logo">
	    <img src="{{ asset('img/logo-asovenca-circle.png') }}" alt="Avatar">
	  </div>

	  <div class="container">
	    <input type="text" placeholder="Usuario" name="username" required>
	    <input type="password" placeholder="Contraseña" name="password" required>
	    <button type="submit">Entrar</button>
	  </div>
	</form>
</body>