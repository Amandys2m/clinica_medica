@extends('main')

@section('titulo', 'Login')

@section('conteudo')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white fw-bold text-center py-3">
                Login
            </div>
            <div class="card-body p-4">
                
                @if(session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.authenticate') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success fw-bold">Entrar</button>
                        <a href="{{ url('/') }}" class="btn btn-outline-warning">Voltar para o Início</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection