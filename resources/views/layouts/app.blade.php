<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PRice</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<style>
		body{
			background-color: #084d6e;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
		<a class="navbar-brand" href="#">PRice</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item {{ request()->routeIs('home')? 'active' : '' }} ">
					<a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(página atual)</span></a>
				</li>
				<li class="nav-item {{ request()->routeIs('projects.*')? 'active' : '' }}">
					<a class="nav-link" href="{{ route('projects.index') }}">Projetos</a>
				</li> 
				<li class="nav-item {{ request()->routeIs('requirements.*')? 'active' : '' }}">
					<a class="nav-link" href="{{ route('requirements.index') }}">Requisitos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Precificar</a>
				</li>
				
			</ul>
			<ul class="navbar-nav float-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ Auth::user()->name }}
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Editar perfil</a>
						
						<div class="dropdown-divider"></div>
						
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							Sair
						</a>
						
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			<ul>
		</div>
	</nav>
	@if(Session::has('status'))
		<div class="alert alert-success alert-dismissible fade show">
			<div class="text-center">{{ Session::get('status') }}</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<br>
	@yield('content')    
</body>
</html>
