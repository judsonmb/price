@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tarefas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Novo</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    Crie um nova tarefa
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                         <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Projeto') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('project_id') is-invalid @enderror" name="project_id">
                                    @if($projects instanceof \Illuminate\Database\Eloquent\Collection)
                                        <option value="">selecione...</option>
                                        @foreach($projects as $p)
                                            <option value="{{ $p->id }}" {{ (old('project_id')==$p->id || $projects->count()==1 ) ? 'selected' : '' }}>{{ $p->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $projects->id }}">{{ $projects->name }}</option>
                                    @endif
                                </select>    
                                @error('project_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('type') is-invalid @enderror" name="type">
                                    <option value="">selecione...</option>
                                    <option value="BUG" {{ old('type') == 'BUG' ? 'selected' : '' }}>BUG</option>
                                    <option value="AJUSTE" {{ old('type') == 'AJUSTE' ? 'selected' : '' }}>AJUSTE</option>
                                    <option value="FEATURE" {{ old('type') == 'FEATURE' ? 'selected' : '' }}>FEATURE</option>
                                    <option value="OPERACIONAL" {{ old('type') == 'OPERACIONAL' ? 'selected' : '' }}>OPERACIONAL</option>
                                </select>    

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <textarea id="custom-toolbar-menu-button" class="form-control @error('description') is-invalid @enderror" rows='10' name="description">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Criar') }}
                                </button>
                                 <a href="{{ route('tasks.index') }}">
                                    <button type="button" class="btn btn-secondary">
                                        {{ __('Voltar') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script src="{{ asset('js/load-tinymce.js') }}"></script>
@endsection
