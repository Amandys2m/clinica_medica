@extends('main')

@section('titulo', 'Lista de Agendamentos')

@section('conteudo')
<h1>Agendamentos</h1>

@if(session()->has('mensagem'))
<div class="alert alert-info">{{ session('mensagem')}}</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Profissional</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($agendamentos as $agendamento)
        <tr> 
            <td>{{ $agendamento->id }}</td>
            <td>{{ $agendamento->cliente->nome }}</td>
            <td>{{ $agendamento->profissional->nome }}</td>
            <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($agendamento->horario)->format('H:i') }}</td>
            <td>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $agendamento->id }}">
                Excluir
                </button>
            </td>
        </tr>
        
        <div class="modal fade" id="modalDelete{{ $agendamento->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirme exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir o agendamento de <b>{{ $agendamento->cliente->nome }}</b> marcado para <b>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</b> às <b>{{ \Carbon\Carbon::parse($agendamento->horario)->format('H:i') }}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="{{ route('agendamento.delete', ['id' => $agendamento->id]) }}" class="btn btn-outline-danger">Confirmar exclusão</a>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    <a class="btn btn-success" 
        href="{{ route('agendamento.novo') }}">
        Novo Agendamento</a>
</div>
@endsection