@extends('main')

@section('titulo', 'Painel de Controle')

@section('conteudo')
<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bem-vindo(a), <span class="text-success">{{ $user->name }}</span>!</h2>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger fw-bold">Sair</button>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card border-0 h-100">
                <div class="card-header bg-secondary text-center text-white fw-bold">
                    Atendimentos
                </div>
                <div class="card-body bg-light d-flex flex-column text-center p-4">
                    <h5 class="card-title text-success mb-3">Nova Consulta</h5>
                    <p class="card-text text-muted mb-4">Agende um novo atendimento com nossa equipe de profissionais.</p>
                    <a href="{{ route('agendamento.novo') }}" class="btn btn-success mt-auto fw-bold mx-auto col-md-4">Agendar Agora</a>
                </div>
            </div>
        </div>
        
        </div>
</div>
@endsection