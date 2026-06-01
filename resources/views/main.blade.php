<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <title>Centro Clínico - @yield('titulo')</title>
        <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            }
        .nav-masthead .nav-link {
            color: #6c757d;
            border-bottom: .25rem solid transparent;
            padding-bottom: 0.25rem;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            color: #212529;
            border-bottom-color: #dee2e6;
        }
        .nav-masthead .active {
            color: #212529;
            border-bottom-color: #212529;
        }
        
    </style>
    </head>
    <body>
         <header class="py-3 mb-4 border-bottom bg-white">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="d-flex align-items-center text-dark text-decoration-none">
                        <h3 class="mb-0 fw-bold text-secondary">Centro Clínico</h3>
                    </a>
                <nav class="nav nav-masthead justify-content-center float-md-end gap-3">
                    <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="{{ url('/') }}">Início</a>
                        @auth
                            <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="{{ route('dashboard') }}">Painel de Controle</a>
                        @else
                            <a class="nav-link fw-bold py-1 px-0 active text-secondary" href="{{ route('login') }}">Login</a>
                        @endauth
                </nav>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @yield('conteudo')
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>      
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>