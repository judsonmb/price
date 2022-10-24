@extends('layouts.app')

@section('content')
<style>
	.dbox {
		position: relative;
		background: rgb(255, 86, 65);
		background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
		background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
		background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
		filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0);
		border-radius: 4px;
		text-align: center;
		margin: 60px 0 50px;
	}
	.dbox__icon {
		position: absolute;
		transform: translateY(-50%) translateX(-50%);
		left: 50%;
	}
	.dbox__icon:before {
		width: 75px;
		height: 75px;
		position: absolute;
		background: #fda299;
		background: rgba(253, 162, 153, 0.34);
		content: '';
		border-radius: 50%;
		left: -17px;
		top: -17px;
		z-index: -2;
	}
	.dbox__icon:after {
		width: 60px;
		height: 60px;
		position: absolute;
		background: #f79489;
		background: rgba(247, 148, 137, 0.91);
		content: '';
		border-radius: 50%;
		left: -10px;
		top: -10px;
		z-index: -1;
	}
	.dbox__icon > i {
		background: #ff5444;
		border-radius: 50%;
		line-height: 40px;
		color: #FFF;
		width: 40px;
		height: 40px;
		font-size:22px;
	}
	.dbox__body {
		padding: 50px 20px;
	}
	.dbox__count {
		display: block;
		font-size: 30px;
		color: #FFF;
		font-weight: 300;
	}
	.dbox__title {
		font-size: 13px;
		color: #FFF;
		color: rgba(255, 255, 255, 0.81);
	}
	.dbox__action {
		transform: translateY(-50%) translateX(-50%);
		position: absolute;
		left: 50%;
	}
	.dbox__action__btn {
		border: none;
		background: #FFF;
		border-radius: 19px;
		padding: 7px 16px;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 11px;
		letter-spacing: .5px;
		color: #003e85;
		box-shadow: 0 3px 5px #d4d4d4;
	}


	.dbox--color-2 {
		background: rgb(252, 190, 27);
		background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
		background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
		background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
		filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0);
	}
	.dbox--color-2 .dbox__icon:after {
		background: #fee036;
		background: rgba(254, 224, 54, 0.81);
	}
	.dbox--color-2 .dbox__icon:before {
		background: #fee036;
		background: rgba(254, 224, 54, 0.64);
	}
	.dbox--color-2 .dbox__icon > i {
		background: #fb9f28;
	}

	.dbox--color-3 {
		background: rgb(183,71,247);
		background: -moz-linear-gradient(top, rgba(183,71,247,1) 0%, rgba(108,83,220,1) 100%);
		background: -webkit-linear-gradient(top, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
		background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b747f7', endColorstr='#6c53dc',GradientType=0 );
	}
	.dbox--color-3 .dbox__icon:after {
		background: #b446f5;
		background: rgba(180, 70, 245, 0.76);
	}
	.dbox--color-3 .dbox__icon:before {
		background: #e284ff;
		background: rgba(226, 132, 255, 0.66);
	}
	.dbox--color-3 .dbox__icon > i {
		background: #8150e4;
	}
	
	.dbox--color-4 {
		background: #008000;
		background: -moz-linear-gradient(top, #469536 0%, #008000 100%);
		background: -webkit-linear-gradient(top, #469536 0%,#008000 100%);
		background: linear-gradient(to bottom, #469536 0%,#008000 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#469536', endColorstr='#008000',GradientType=0 );
	}
	.dbox--color-4 .dbox__icon:after {
		background: #469536;
	}
	.dbox--color-4 .dbox__icon:before {
		background: #6eaa5e;
	}
	.dbox--color-4 .dbox__icon > i {
		background: #008000;
	}
	
	.dbox--color-5 {
		background: #2980b9;
		background: -moz-linear-gradient(top, #3498db 0%, #2980b9 100%);
		background: -webkit-linear-gradient(top, #3498db 0%,#2980b9 100%);
		background: linear-gradient(to bottom, #3498db 0%,#2980b9 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3498db', endColorstr='#2980b9',GradientType=0 );
	}
	.dbox--color-5 .dbox__icon:after {
		background: #3498db;
	}
	.dbox--color-5 .dbox__icon:before {
		background: #74b9ff;
	}
	.dbox--color-5 .dbox__icon > i {
		background: #2980b9;
	}
	
	.dbox--color-6 {
		background: #2980b9;
		background: -moz-linear-gradient(top, #e67e22 0%, #d35400 100%);
		background: -webkit-linear-gradient(top, #e67e22 0%,#d35400 100%);
		background: linear-gradient(to bottom, #e67e22 0%,#d35400 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3498db', endColorstr='#d35400',GradientType=0 );
	}
	.dbox--color-6 .dbox__icon:after {
		background: #e67e22;
	}
	.dbox--color-6 .dbox__icon:before {
		background: #f39c12;
	}
	.dbox--color-6 .dbox__icon > i {
		background: #d35400;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="dbox dbox--color-1">
				<div class="dbox__icon">
					<i class="fa fa-sticky-note"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $projects->count() ?? 0 }}</span>
					<span class="dbox__title">Projetos criados</span>
				</div>
				
				<div class="dbox__action">
					<a href="{{ route('projects.index') }}"><button class="dbox__action__btn"><i class="fa fa-plus"></i></button></a>
				</div>				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-2">
				<div class="dbox__icon">
					<i class="fa fa-paste"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $requirements->count() ?? 0 }}</span>
					<span class="dbox__title">Requisitos detalhados</span>
				</div>
				
				<div class="dbox__action">
					<a href="{{ route('requirements.index') }}"><button class="dbox__action__btn"><i class="fa fa-plus"></i></button></a>
				</div>				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-3">
				<div class="dbox__icon">
					<i class="fa fa-dollar"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $requirements->sum('fp_total_amount') ?? 0 }}</span>
					<span class="dbox__title">Pontos de Função analisados</span>
				</div>
				
				<div class="dbox__action">
					<button class="dbox__action__btn">More Info</button>
				</div>				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="dbox dbox--color-4">
				<div class="dbox__icon">
					<i class="fa fa-dollar"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">R$ {{ $projects->sum('price') ?? 0,00 }} </span>
					<span class="dbox__title">Reais calculados</span>
				</div>
				
				<div class="dbox__action">
					<button class="dbox__action__btn">More Info</button>
				</div>				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-5">
				<div class="dbox__icon">
					<i class="fa fa-hourglass-half"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $projects->sum('hours') ?? 0 }}</span>
					<span class="dbox__title">Horas trabalhadas</span>
				</div>
				
				<div class="dbox__action">
					<button class="dbox__action__btn">More Info</button>
				</div>				
			</div>
		</div>
		<div class="col-md-4">
			<div class="dbox dbox--color-6">
				<div class="dbox__icon">
					<i class="fa fa-calendar"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $projects->sum('hours')/8 ?? 0 }}</span>
					<span class="dbox__title">Dias trabalhados</span>
				</div>
				
				<div class="dbox__action">
					<button class="dbox__action__btn">More Info</button>
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection
