@extends('layouts.guest-pages')

@section('content')
<div class="wrapper fadeInDown">
	<div id="formContent">
    <!-- Tabs Titles -->

		<!-- Icon -->
		<div class="fadeIn first">
		  <h2>Confirme a senha</h2>
		</div>

		<!-- Login Form -->
		<form method="POST" action="{{ route('password.confirm') }}">
			@csrf
			
			<input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" placeholder="senha">
			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		
			
			<input type="submit" class="fadeIn fourth" value="Confirmar senha">
		</form>
		
		@if (Route::has('password.request'))
			<a class="btn btn-link" href="{{ route('password.request') }}">
				{{ __('Esqueceu sua senha?') }}
			</a>
		@endif

		<!-- Remind Passowrd -->
		<div id="formFooter">
		  <a class="underlineHover" href="{{ route('login') }}">Voltar para login</a>
		</div>

	</div>
</div>
@endsection