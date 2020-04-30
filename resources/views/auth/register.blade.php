@extends('layouts.guest-pages')

@section('content')

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <h2>Registre-se!</h2>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('register') }}">
		@csrf
		<input type="text" id="login" class="fadeIn second @error('name') is-invalid @enderror" name="name" placeholder="nome">
			@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		
		<input type="text" id="login" class="fadeIn second @error('email') is-invalid @enderror" name="email" placeholder="email">
			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		
		<input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" placeholder="senha">
			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		
		<input type="password" id="password" class="fadeIn third" name="password_confirmation" placeholder="confirme a senha">
		
		<input type="submit" class="fadeIn fourth" value="registrar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="{{ route('login') }}">Voltar para login</a>
    </div>

  </div>
</div>

@endsection