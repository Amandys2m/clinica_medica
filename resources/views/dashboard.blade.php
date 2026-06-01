@extends('main')

@section('titulo', 'Painel de Controle')

@section('conteudo')
<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bem-vindo(a), <span class="text-success">{{ $user->name }}</span></h2>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger fw-bold">Sair</button>
        </form>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    @if($user->is_admin)
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-secondary text-center text-white fw-bold">
                        Profissionais
                    </div>
                    <div class="card-body bg-light d-flex flex-column text-center p-4">
                        <h5 class="card-title text-success mb-3">Gerenciar Equipe</h5>
                        <p class="card-text text-muted mb-4">Cadastre, edite ou remova profissionais do sistema.</p>
                        <a href="{{ url('/profissionais') }}" class="btn btn-success mt-auto fw-bold mx-auto w-75">Acessar Controle</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-secondary text-center text-white fw-bold">
                        Especialidades
                    </div>
                    <div class="card-body bg-light d-flex flex-column text-center p-4">
                        <h5 class="card-title text-success mb-3">Áreas de Atuação</h5>
                        <p class="card-text text-muted mb-4">Gerencie as especialidades médicas oferecidas.</p>
                        <a href="{{ url('/especialidades') }}" class="btn btn-success mt-auto fw-bold mx-auto w-75">Acessar Controle</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-secondary text-center text-white fw-bold">
                        Convênios
                    </div>
                    <div class="card-body bg-light d-flex flex-column text-center p-4">
                        <h5 class="card-title text-success mb-3">Planos de Saúde</h5>
                        <p class="card-text text-muted mb-4">Cadastre e atualize os convênios aceitos na clínica.</p>
                        <a href="{{ url('/convenios') }}" class="btn btn-success mt-auto fw-bold mx-auto w-75">Acessar Controle</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-secondary text-center text-white fw-bold">
                        Clientes
                    </div>
                    <div class="card-body bg-light d-flex flex-column text-center p-4">
                        <h5 class="card-title text-success mb-3">Pacientes</h5>
                        <p class="card-text text-muted mb-4">Visualize e gerencie os cadastros dos pacientes.</p>
                        <a href="{{ url('/clientes') }}" class="btn btn-success mt-auto fw-bold mx-auto w-75">Acessar Controle</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-secondary text-center text-white fw-bold">
                        Agendamentos
                    </div>
                    <div class="card-body bg-light d-flex flex-column text-center p-4">
                        <h5 class="card-title text-success mb-3">Visão Geral</h5>
                        <p class="card-text text-muted mb-4">Acompanhe todas as consultas marcadas na clínica.</p>
                        <a href="{{ url('/agendamentos') }}" class="btn btn-success mt-auto fw-bold mx-auto w-75">Acessar Controle</a>
                    </div>
                </div>
            </div>

        </div>

    @else
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

        <div class="card border-0 mb-5">
            <div class="card-header bg-secondary text-center text-white fw-bold">
                Meus Agendamentos
            </div>
            <div class="card-body p-0">
                @if($agendamentos->isEmpty())
                    <div class="p-4 text-center text-muted">
                        Você ainda não possui consultas agendadas.
                    </div>
                @else
                    <div class="table-responsive bg-light">
                        <table class="table table-striped mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Data</th>
                                    <th class="px-4 py-3">Horário</th>
                                    <th class="px-4 py-3">Profissional</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agendamentos as $agendamento)
                                    <tr>
                                        <td class="px-4 py-3 fw-semibold">{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($agendamento->horario)->format('H:i') }}</td>
                                        <td class="px-4 py-3">{{ $agendamento->profissional->nome }}</td>
                                        <td class="px-4 py-3">
                                            @if(\Carbon\Carbon::parse($agendamento->data)->isPast())
                                                <span class="badge bg-primary">Realizado</span>
                                            @else
                                                <span class="badge bg-success">Confirmado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection