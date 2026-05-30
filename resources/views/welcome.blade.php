<!doctype html>
<html lang="pt-BR" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro Clínico Caçador</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
            background-color: #f8f9fa;
        }

        .cover-container {
            max-width: 50em;
        }

        .nav-masthead .nav-link {
            color:#212529(255, 255, 255, .5);
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: #212529(255, 255, 255, .25);
        }

        .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #212529;
            border-bottom-color: #212529;
        }
        
    </style>
</head>
<body class="d-flex h-100 text-center text-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column overflow-auto">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0 fw-bold text-secondary">Centro Clínico</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="#">Início</a>
                        @auth
                            <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="{{ route('dashboard') }}">Painel de Controle</a>
                        @else
                            <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="{{ route('login') }}">Login</a>
                        @endauth
                </nav>
            </div>
        </header>

        <main class="px-3 mt-5">
            <h1 class="display-4 fw-bold text-secondary">Centro Clínico Caçador</h1>
            <p class="lead mt-3">Encontre diversas especialidades médicas em um só lugar e agende seu atendimento com facilidade.</p>
            <p class="lead mt-4">
                <a href="{{ route('cliente.novo') }}" class="btn btn-lg btn-success fw-bold text-white px-4 py-2">
                    Cadastre-se Agora
                </a>
            </p>
        </main>

        <div class="especialidades mt-5">
            <h4 class="mb-4 text-success border-bottom border-secondary pb-3">Nossas Especialidades</h4>
            <div class="row g-3">
                @if(isset($especialidades) && $especialidades->isNotEmpty())
                    @foreach($especialidades as $especialidade)
                        <div class="col-md-6">
                            <div class="card bg-success text-white border-secondary h-100">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-white">{{ $especialidade->nome }}</h5>
                                    <p class="card-text small">{{ $especialidade->desc_esp }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted w-100">Nenhuma especialidade cadastrada no momento.</p>
                @endif
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>