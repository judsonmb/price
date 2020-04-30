@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/projects">Projetos</li>
                    <li class="breadcrumb-item active" aria-current="page">Projetos</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('projects.create') }}">
                        <button type="button" class="btn btn-success">Novo</button>
                    </a>
                    <a href="/projects/exportpage/">
                        <button type="button" class="btn btn-primary">Exportar</button>
                    </a>
                </div> 
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col" class="text-center">Requisitos</th>
                                <th scope="col" class="text-center">Total de P.F.</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->type }}</td>
                                    <td class="text-center">{{ $p->requirement->count() }}</td>
                                    <td class="text-center">{{ $p->requirement->sum('fp_total_amount') }}</td>
                                    <td>R$ {{ $p->price }},00</td>
                                    <td>
                                        <div class="row">
                                            <a href="#">
                                                <button type="button" class="btn btn-primary" title="Precificar">
                                                    <i class="fa fa-dollar"></i>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button" class="btn btn-secondary" title="Ver requisitos" data-toggle="modal" data-target="#requisitosProject{{ $p->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('requirements.create', $p->id) }}">
                                                <button type="button" class="btn btn-success" title="Novo requisito">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('projects.edit', $p->id) }}">
                                                <button type="button" class="btn btn-warning" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('projects.destroy', $p->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir este projeto?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="requisitosProject{{ $p->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <strong>
                                                    <h5 class="modal-title" id="exampleModalLabel">Requisitos do projeto<br>{{ $p->name }}</h5>
                                                </strong>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    @foreach($p->requirement as $r)

                                                        @if(isset($r->fp_total_amount))
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-justify" style="background-color:#2ecc71;">
                                                        @else
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                                                        @endif   
                                                           {{ $r->name }} 

                                                           ({{ $r->fp_total_amount ?? 'não calculado' }}) 
                                                            <a href="{{ route('requirements.editfp', $r->id) }}">
                                                                <button type="button" class="btn btn-warning" title="Fazer análise">
                                                                    <i class="fa fa-sticky-note"></i>
                                                                </button>
                                                            </a>
                                                            
                                                        </li>
                                                    @endforeach    
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                      </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
