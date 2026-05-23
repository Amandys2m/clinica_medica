@extends('main')

@section('titulo', 'Lista de Convênios')

@section('conteudo')
<h1>Convênios</h1>
@if(session()->has('mensagem'))
<div class="alert alert-info">{{ session('mensagem')}}</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data criação</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($convenios as $cv)
        <tr> 
            <td>{{ $cv->id }}</td>
            <td>{{ $cv->nome }}</td>
            <td>{{ $cv->telefone }}</td>
            <td>{{ $cv->created_at }}</td>
            <td>
                <a href="{{ route('convenio.editar', ['id' => $cv->id]) }}" 
                    class="btn btn-warning">
                    Alterar</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $cv->id }}">
                Excluir
                </button>
            </td>
        </tr>
        <div class="modal fade" id="modalDelete{{ $cv->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirme exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir o convênio <b>{{$cv->nome}}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="{{ route('convenio.delete', ['id' => $cv->id]) }}" class="btn btn-outline-danger">Confirmar exclusão</a>
                </div>
                </div>
            </div>
            </div>
        @endforeach
    </tbody>
</table>

<div>
    <a class="btn btn-success" 
        href="{{ route('convenio.novo') }}">
        Novo Convênio</a>
</div>
@endsection