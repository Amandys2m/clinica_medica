@extends('main')

@section('titulo', "Especialidade #{$e->id}")

@section('conteudo')
<h1>Especialidade #{{ $e->id }}</h1>
<form method="POST" action="{{ route('especialidade.salvar', ['id' => $e->id]) }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" 
    id="nome" placeholder="Nome" name="nome" value="{{ $e->nome }}">
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" 
    id="desc_esp" placeholder="Descrição" name="desc_esp" value="{{ $e->desc_esp }}">
    <label for="desc_esp">Descrição</label>
    </div>
    
    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
