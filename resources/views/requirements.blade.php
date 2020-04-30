@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Requisitos</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <a href="/requirements/create/">
                        <button type="button" class="btn btn-success">Novo</button>
                    </a>
                </div> 
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Projeto</th>
                                <th scope="col">Pontos de função</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requirements as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td title="{{ $r->name }}">{{ substr($r->name , 0, 30)}}...</td>
                                    <td>{{ $r->project->name }}</td>
                                    <td class="text-center">{{ $r->fp_total_amount ?? 'não calculado' }}</td>              
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('requirements.editfp', $r->id) }}">
                                                    <button type="button" class="btn btn-warning" title="Fazer análise">
                                                        <i class="fa fa-sticky-note"></i>
                                                    </button>
                                            </a>
                                            <a href="{{ route('requirements.edit', $r->id) }}">
                                                    <button type="button" class="btn btn-primary" title="Editar">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                            </a>
                                            <form action="{{ route('requirements.destroy', $r->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir este requisito?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                      </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $requirements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
