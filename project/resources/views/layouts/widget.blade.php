<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Обратная связь')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-light">
<div class="container py-4">
    <nav class="mb-4 text-center">
        <a href="{{ route('welcome') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-house-door"></i> На главную
        </a>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">@yield('card-title', 'Обратная связь')</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @yield('content')
                    @yield('script')
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
