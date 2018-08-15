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
	<form action="{{ action('Auth\LoginController@login') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  	<div class="logo">
	    	<img src="{{ asset('img/logo-asovenca-circle.png') }}" alt="Avatar">
	  	</div>

		<div class="container">
		    <div class="form-group{{ $errors->has('username') ? ' has error' : '' }}">
		    	<input type="text" placeholder="Usuario" name="username" id="username" value="{{ old('username') }}" required>

		    	@if($errors->has('username'))
		    		<span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
		    	@endif
		    </div>
		    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		    	<input type="password" placeholder="Contraseña" name="password" id="password" required>

		    	@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
		    </div>
		    <div class="form-group">
		    	<button type="submit">Entrar</button>
		    </div>
		</div>
	</form>
	@if(session('error'))
        <div id="error" class="alert alert-danger">
       		{{ session('error') }}
        </div>
    @endif
</body>