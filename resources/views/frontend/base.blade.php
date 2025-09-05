<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    @yield('css')
    <title>@yield('title') | AgenceImmo</title>
</head>
<body>
@php
    $routeName = request()->route()->getName();
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Agence Immo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_starts_with($routeName,'home')]) aria-current="page" href="{{route('home')}}">Home</a>
                </li>

                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_starts_with($routeName,'properties.')]) href="{{route('properties.index')}}">Propriétés</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @if(session('message'))
        <div class="alert alert-{{session('type')}}">
            {!! session('message')  !!}
        </div>
    @endif
    @yield(('content'))
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('js')
</body>
</html>
