@extends('main')

@section('titulo', 'Lista de Profissionais Parceiros')

@section('conteudo')
<h1>Profissionais</h1>
@if(session()->has('mensagem'))
<div class="alert alert-info">{{ session('mensagem')}}</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Especialidade</th>
            <th>Data criação</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profissionais as $p)
        <tr> 
            <td>{{ $p->id }}</td>
            <td>{{ $p->nome }}</td>
            <td>{{ $p->cpf }}</td>
            <td>{{ $p->rg }}</td>
            <td>{{ $p->data_nasc }}</td>
            <td>
                @if($p->especialidades->count() > 0)
                    <ul class="mb-0">
                        @foreach($p->especialidades as $e)
                            <li>
                                {{ $e->nome }}
                                -
                                R$ {{ $e->pivot->valor_consulta }}
                            </li>
                        @endforeach
                    </ul>

                @else

                    <span class="text-muted">
                        Sem especialidades
                    </span>

                @endif

            </td>
            <td>{{ $p->created_at }}</td>
            <td>
                <a href="{{ route('profissional.editar', ['id' => $p->id]) }}" 
                    class="btn btn-outline-warning">
                    Alterar</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $p->id }}">
                Excluir
                </button>
            </td>
        </tr>
        <div class="modal fade" id="modalDelete{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirme exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir o profissional <b>{{$p->nome}}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="{{ route('profissional.delete', ['id' => $p->id]) }}" class="btn btn-outline-danger">Confirmar exclusão</a>
                </div>
                </div>
            </div>
            </div>
        @endforeach
    </tbody>
</table>

<div>
    <a class="btn btn-success" 
        href="{{ route('profissional.novo') }}">
        Novo Profissional</a>
</div>
@endsection