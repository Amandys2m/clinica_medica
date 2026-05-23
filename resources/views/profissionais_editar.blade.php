@extends('main')

@section('titulo', "Profissional #{$p->id}")

@section('conteudo')
<h1>Profissional #{{ $p->id }}</h1>
<form method="POST" action="{{ route('profissional.salvar', ['id' => $p->id]) }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" 
    id="nome" placeholder="Nome" name="nome" value="{{ $p->nome }}">
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="cpf" 
    placeholder="CPF" name="cpf" value="{{ $p->cpf }}">
    <label for="cpf">CPF</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="rg" value="{{ $p->rg }}" 
    placeholder="rg" name="rg">
    <label for="rg">RG</label>
    </div>
    <div class="form-floating mb-3">
    <input type="date" class="form-control" id="data_nasc" value="{{ $p->data_nasc }}"
    placeholder="Data Nascimento" name="data_nasc">
    <label for="data_nasc">Data de Nascimento</label>
    </div>
    
    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
