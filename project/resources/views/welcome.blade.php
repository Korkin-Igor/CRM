<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM — Выбор действия</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f6f9fc, #eef2f7);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold">Добро пожаловать</h1>
            </div>

            <div class="d-grid gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill me-2"></i>
                    Войти в админку (менеджер)
                </a>

                <a href="{{ route('widget') }}" class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center">
                    <i class="bi bi-chat-square-text-fill me-2"></i>
                    Оставить заявку (клиент)
                </a>
            </div>

            <div class="text-center mt-4 text-muted">
                <small>© {{ date('Y') }} CRM. Все права защищены.</small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>
