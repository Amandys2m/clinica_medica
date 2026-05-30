@extends('main')

@section('titulo', 'Agendar Atendimento')

@section('conteudo')
<div class="card mt-5 border-0">
    <div class="card-header bg-success text-white text-center fw-bold">
        Novo Agendamento
    </div>
    <div class="card-body p-4 bg-light">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="GET" action="{{ route('agendamento.novo') }}" class="mb-4">
            <label for="especialidade_id" class="form-label fw-semibold">1. Selecione a Especialidade</label>
            <div class="input-group">
                <select name="especialidade_id" id="especialidade_id" class="form-select" onchange="this.form.submit()" required>
                    <option value="" disabled {{ !$especialidadeSelecionada ? 'selected' : '' }}>Escolha uma opção...</option>
                    @foreach($especialidades as $especialidade)
                        <option value="{{ $especialidade->id }}" {{ $especialidadeSelecionada == $especialidade->id ? 'selected' : '' }}>
                            {{ $especialidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($especialidadeSelecionada)
        <form method="POST" action="{{ route('agendamento.salvar') }}">
            @csrf
            
            <div class="mb-3 mt-3">
                <label for="profissional_id" class="form-label fw-semibold">2. Escolha o Profissional</label>
                <select name="profissional_id" id="profissional_id" class="form-select" required>
                    <option value="" disabled selected>Selecione o profissional...</option>
                    @foreach($profissionais as $profissional)
                        <option value="{{ $profissional->id }}">{{ $profissional->nome }}</option>
                    @endforeach
                </select>
                @if($profissionais->isEmpty())
                    <small class="text-danger">Nenhum profissional atende esta especialidade no momento.</small>
                @endif
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="data" class="form-label fw-semibold">3. Data</label>
                    <input type="date" name="data" id="data" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="horario" class="form-label fw-semibold">4. Horário</label>
                    <input type="time" name="horario" id="horario" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-danger me-2 fw-bold">Cancelar</a>
                <button type="submit" class="btn btn-success fw-bold" {{ $profissionais->isEmpty() ? 'disabled' : '' }}>Confirmar Agendamento</button>
            </div>
        </form>
        @else
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-danger fw-bold">Cancelar</a>
            </div>
        @endif

    </div>
</div>
@endsection