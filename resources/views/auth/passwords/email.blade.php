@extends('layouts.guest-pages')

@section('content')
@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif
<div class="wrapper fadeInDown">
	<div id="formContent">
		<!-- Tabs Titles -->

		<!-- Icon -->
		<div class="fadeIn first">
		  <h2>Resete sua senha</h2>
		</div>

		<!-- Login Form -->
		<form method="POST" action="{{ route('password.email') }}">
			@csrf
			
			<input type="text" id="login" class="fadeIn second @error('email') is-invalid @enderror" name="email" placeholder="email">
				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			
			<input type="submit" class="fadeIn fourth" value="Enviar link">
		</form>

		<!-- Remind Passowrd -->
		<div id="formFooter">
		  <a class="underlineHover" href="{{ route('login') }}">Voltar para login</a>
		</div>
	 </div>
</div>
@endsection