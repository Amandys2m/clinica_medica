@extends('main')

@section('titulo', 'Lista de Clientes')

@section('conteudo')
<h1>Clientes</h1>
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
            <th>Telefone</th>
            <th>Data criação</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $c)
        <tr> 
            <td>{{ $c->id }}</td>
            <td>{{ $c->nome }}</td>
            <td>{{ $c->cpf }}</td>
            <td>{{ $c->rg }}</td>
            <td>{{ $c->data_nasc }}</td>
            <td>{{ $c->telefone }}</td>
            <td>{{ $c->created_at }}</td>
            <td>
                <a href="{{ route('cliente.edit', ['id' => $c->id]) }}" 
                    class="btn btn-warning">
                    Alterar</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $c->id }}">
                Excluir
                </button>
            </td>
        </tr>
        <div class="modal fade" id="modalDelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirme exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir o cliente <b>{{$c->nome}}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="{{ route('cliente.delete', ['id' => $c->id]) }}" class="btn btn-outline-danger">Confirmar exclusão</a>
                </div>
                </div>
            </div>
            </div>
        @endforeach
    </tbody>
</table>

<div>
    <a class="btn btn-success" 
        href="{{ route('cliente.novo') }}">
        Novo Cliente</a>
</div>
@endsection