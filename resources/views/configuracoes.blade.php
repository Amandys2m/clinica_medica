@extends('main')

@section('titulo', 'Configurações do Sistema')

@section('conteudo')
<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Configurações de Integração</h2>
        <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary fw-bold">Voltar</a>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white text-success fw-bold border-0 pt-3 pb-0">
            API Caçapay (Sistema de Pagamentos)
        </div>
        <div class="card-body">
            <form action="{{ route('configuracoes.salvar') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="cacapay_url" class="form-label fw-bold">URL da API</label>
                    <input type="url" class="form-control" id="cacapay_url" name="cacapay_url" value="{{ old('cacapay_url', $cacapay_url) }}" placeholder="https://exemplo.com/api">
                </div>

                <div class="mb-4">
                    <label for="cacapay_token" class="form-label fw-bold">Token de Acesso </label>
                    <input type="text" class="form-control" id="cacapay_token" name="cacapay_token" value="{{ old('cacapay_token', $cacapay_token) }}" placeholder="Insira o token de autenticação">
                </div>

                <button type="submit" class="btn btn-success fw-bold">Salvar Configurações</button>
            </form>
        </div>
    </div>
</div>
@endsection