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
            
            <div class="mb-3">
                <label for="especialidade_id" class="form-label fw-semibold">1. Selecione a Especialidade</label>
                <select name="especialidade_id" id="especialidade_id" class="form-select" onchange="this.form.submit()" required>
                    <option value="" disabled {{ !$especialidadeSelecionada ? 'selected' : '' }}>Escolha uma opção...</option>
                    @foreach($especialidades as $especialidade)
                        <option value="{{ $especialidade->id }}" {{ $especialidadeSelecionada == $especialidade->id ? 'selected' : '' }}>
                            {{ $especialidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($especialidadeSelecionada)
                <div class="mb-3">
                    <label for="profissional_id" class="form-label fw-semibold">2. Escolha o Profissional</label>
                    <select name="profissional_id" id="profissional_id" class="form-select" onchange="this.form.submit()" required>
                        <option value="" disabled {{ !$profissionalSelecionado ? 'selected' : '' }}>Selecione o profissional...</option>
                        @foreach($profissionais as $profissional)
                            <option value="{{ $profissional->id }}" {{ $profissionalSelecionado == $profissional->id ? 'selected' : '' }}>
                                {{ $profissional->nome }}
                            </option>
                        @endforeach
                    </select>
                    @if($profissionais->isEmpty())
                        <small class="text-danger">Nenhum profissional atende esta especialidade no momento.</small>
                    @endif
                </div>
            @endif

            @if($profissionalSelecionado)
                <div class="mb-3">
                    <label for="data" class="form-label fw-semibold">3. Data da Consulta</label>
                    <input type="date" name="data" id="data" class="form-control w-50" min="{{ date('Y-m-d') }}" value="{{ $dataSelecionada }}" onchange="this.form.submit()" required>
                </div>
            @endif

        </form>

        @if($especialidadeSelecionada && $profissionalSelecionado && $dataSelecionada)
            <form method="POST" action="{{ route('agendamento.salvar') }}">
                @csrf
                
                <input type="hidden" name="profissional_id" value="{{ $profissionalSelecionado }}">
                <input type="hidden" name="data" value="{{ $dataSelecionada }}">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="horario" class="form-label fw-semibold">4. Horários Disponíveis</label>
                        <select name="horario" id="horario" class="form-select" required>
                            @if(empty($horariosLivres))
                                <option value="" disabled selected>Nenhum horário livre nesta data</option>
                            @else
                                <option value="" disabled selected>Escolha o horário...</option>
                                @foreach($horariosLivres as $h)
                                    <option value="{{ $h }}">{{ $h }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="convenio_id" class="form-label fw-semibold">5. Convênio</label>
                        <select name="convenio_id" id="convenio_id" class="form-select">
                            <option value="">Particular</option>
                            @foreach($convenios as $cv)
                                <option value="{{ $cv->id }}">{{ $cv->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('/') }}" class="btn btn-outline-danger me-2 fw-bold">Cancelar</a>
                    <button type="submit" class="btn btn-success fw-bold" {{ empty($horariosLivres) ? 'disabled' : '' }}>Confirmar Agendamento</button>
                </div>
            </form>
        @else
            <div class="d-flex justify-content-end mt-4 border-top pt-3">
                <a href="{{ url('/') }}" class="btn btn-outline-danger fw-bold">Cancelar</a>
            </div>
        @endif

    </div>
</div>
@endsection