@extends('layouts.login')

@section('content')

<section class="login-block">
    <div class="container">
	    <div class="row">
		    <div class="col-md-4 login-sec">
		        <h2 class="text-center">Bem vindo ao PRice!</h2>
		        <form class="login-form" method="POST" action="{{ route('login') }}">
					@csrf
                    <div class="form-group">
                        <label class="text-uppercase">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
						
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </div>
                    <div class="form-group">
                        <label class="text-uppercase">Senha</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
						
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <small>Lembrar-me</small>
                        </label>
                        <button type="submit" class="btn btn-login float-right">Entrar</button>
                    </div>
  
                </form>
				@if (Route::has('password.request'))
					<a class="btn btn-link" href="{{ route('password.request') }}">
						Esqueceu sua senha?
					</a>
				@endif
				<div>Não tem conta? cadastre-se <a href="{{ route('register') }}">aqui</a></div><br>
				
                <div class="copy-text">Criado com <i class="fa fa-heart"></i> por LinKn</div>
		    </div>
		    <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>Projete, Precifique, Padronize!</h2>
                                    <p>Price é uma solução de ponta para a medição e precificação de projetos de software. Está alinhado com as melhores práticas corporativas. Preocupe-se com o valor e deixe o preço com o PRice</p>
                                </div>	
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>Pontos de função</h2>
                                    <p>Esta é a técnica utilizada pelo PRice para medir o tamanho e precificar o software. Responda a simples perguntas e o PRice calcula o preço para você!</p>
                                </div>	
                             </div>
                        </div>
                    </div>	      
		        </div>
	        </div>
        </div>
	</div>
</section>

@endsection
