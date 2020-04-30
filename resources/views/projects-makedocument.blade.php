@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/projects">Projetos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Montar documento</li>
                </ol>
            </nav> 
            <div class="card">
                <form action="{{ route('export') }}" method='POST'>
                @csrf
                <div class="card-header"> 
                    <a href="{{ route('projects.index') }}">
                        <button type="button" class="btn btn-secondary">Voltar</button>
                    </a>
                    <button class='btn btn-warning' type='button' id='all' name='all'>Marcar tudo
                    </button>
                    <button class='btn btn-warning' type='button' id='deall' name='deall'>Desmarcar tudo
                    </button>
                    <button type='submit' class='btn btn-primary'>Exportar</button> 
                </div> 
                <div class="card-body">
                    
                   
                    <ul class="list-group"> 
                        @foreach($projects as $p)
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $p->id }}" name="p{{ $p->id }}" id="pid{{ $p->id }}">
                                    <label class="form-check-label" for="p{{ $p->id }}">
                                        {{ $p->name }}
                                    </label>
                                </div>                           
                            </li>
                        @endforeach
                        </form>
                    </ul>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    document.querySelector("button[name=all]").onclick = function() {
        var lista = document.querySelectorAll("input");
        for ( var i = 0 ; i < lista.length ; i++ ){
                lista[i].checked = true;
        }
    }

    document.querySelector("button[name=deall]").onclick = function() {
        var lista = document.querySelectorAll("input");
        for ( var i = 0 ; i < lista.length ; i++ ){
                lista[i].checked = false;
        }
    }
</script>
@endsection
