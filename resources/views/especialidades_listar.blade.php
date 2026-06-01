@extends('main')

@section('titulo', 'Lista de Especialidades')

@section('conteudo')
<h1>Especialidades</h1>
@if(session()->has('mensagem'))
<div class="alert alert-info">{{ session('mensagem')}}</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data criação</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($especialidades as $e)
        <tr> 
            <td>{{ $e->id }}</td>
            <td>{{ $e->nome }}</td>
            <td>{{ $e->desc_esp }}</td>
            <td>{{ $e->created_at }}</td>
            <td>
                <a href="{{ route('especialidade.editar', ['id' => $e->id]) }}" 
                    class="btn btn-outline-warning">
                    Alterar</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $e->id }}">
                Excluir
                </button>
            </td>
        </tr>
        <div class="modal fade" id="modalDelete{{ $e->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirme exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir a especialidade <b>{{$e->nome}}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="{{ route('especialidade.delete', ['id' => $e->id]) }}" class="btn btn-outline-danger">Confirmar exclusão</a>
                </div>
                </div>
            </div>
            </div>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    {{ $especialidades->links('pagination::bootstrap-4') }}
</div>
<div>
    <a class="btn btn-success" 
        href="{{ route('especialidade.nova') }}">
        Nova Especialidade</a>
</div>
@endsection