@extends('main')

@section('titulo', 'Novo cliente')

@section('conteudo')
<h1>Novo Cliente</h1>
<form method="POST" action="{{ route('cliente.salvar') }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{ old ('nome') }}" required>
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf" value="{{ old ('cpf') }}" required>
    <label for="cpf">CPF</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="rg" placeholder="RG" name="rg" value="{{ old ('rg') }}" required>
    <label for="rg">RG</label>
    </div>
    <div class="form-floating mb-3">
    <input type="date" class="form-control" id="data_nasc" placeholder="Data Nascimento" name="data_nasc" value="{{ old ('data_nasc') }}" required>
    <label for="data_nasc">Data de Nascimento</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone" value="{{ old ('telefone') }}" required>
    <label for="telefone">Telefone</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="nome@exemplo.com" name="email" value="{{ old ('email') }}" required> @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <label for="email">E-mail</label>
    </div>
    <div class="form-floating mb-3">
    <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" name="senha" minlenght="6" required>
    <label for="senha">Senha (Mínimo 6 caracteres)</label>
    </div>
    <div class="mt-4 mb-5">
    <a href="{{ url('/') }}" class="btn btn-outline-danger me-2">Cancelar</a>
    <input type="submit" value="Salvar" class="btn btn-success" />
    </div>
</form>
@endsection
