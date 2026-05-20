@extends('main')

@section('titulo', "Cliente #{$c->id}")

@section('conteudo')
<h1>Cliente #{{ $c->id }}</h1>
<form method="POST" action="{{ route('cliente.salvar', ['id' => $c->id]) }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" 
    id="nome" placeholder="Nome" name="nome" value="{{ $c->nome }}">
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="cpf" 
    placeholder="CPF" name="cpf" value="{{ $c->cpf }}">
    <label for="cpf">CPF</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="rg" value="{{ $c->rg }}" 
    placeholder="rg" name="rg">
    <label for="rg">RG</label>
    </div>
    <div class="form-floating mb-3">
    <input type="date" class="form-control" id="data_nasc" value="{{ $c->data_nasc }}"
    placeholder="Data Nascimento" name="data_nasc">
    <label for="data_nasc">Data de Nascimento</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="telefone" value="{{ $c->telefone }}"
    placeholder="Telefone" name="telefone">
    <label for="telefone">Telefone</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="email" value="{{ $c->email }}"
    placeholder="Email" name="email">
    <label for="email">E-mail</label>
    </div>
    <div class="form-floating mb-3">
    <input type="password" class="form-control" id="senha" value="{{ $c->senha }}"
    placeholder="Digite sua senha" name="senha">
    <label for="senha">Senha</label>
    </div>
    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
