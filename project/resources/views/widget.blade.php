@extends('layouts.widget')

@section('title')Оставить заявку@endsection
@section('card-title')Оставьте заявку@endsection

    @section('content')
        <form id="ticketForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <div class="text-danger mt-1" id="email-error"></div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон (в формате +79991234567)</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="+79991234567">
                <div class="text-danger mt-1" id="phone-error"></div>
            </div>

            <div class="mb-3">
                <label for="theme" class="form-label">Тема</label>
                <input type="text" class="form-control" name="theme" id="theme" maxlength="255">
                <div class="text-danger mt-1" id="theme-error"></div>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Текст заявки</label>
                <textarea class="form-control" name="text" id="text" rows="4" required></textarea>
                <div class="text-danger mt-1" id="text-error"></div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Файлы (до 150 МБ каждый)</label>
                <input type="file" class="form-control" name="file[]" id="file" multiple accept=".jpg,.jpeg,.png,.gif,.zip,.rar,.7z,.glb,.gltf">
                <div class="form-text">Поддерживаются: изображения, архивы, 3D-модели.</div>
                <div class="text-danger mt-1" id="file-error"></div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Отправить заявку</button>
            </div>
        </form>

        <div id="response-message" class="mt-3"></div>
    @endsection
    @section('script')
        <script>
            document.getElementById('ticketForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;

                submitButton.disabled = true;
                submitButton.textContent = 'Отправка...';

                try {
                    const response = await fetch('/api/tickets', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        document.getElementById('response-message').innerHTML =
                            '<div class="alert alert-success">✅Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.</div>';
                        this.reset();

                        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');
                    } else {
                        const errors = result.errors || {};

                        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                        Object.keys(errors).forEach(field => {
                            const errorDiv = document.getElementById(`${field}-error`);
                            if (errorDiv) {
                                errorDiv.textContent = errors[field][0];
                            }
                        });
                    }
                } catch (error) {
                    console.error('Ошибка:', error);
                    document.getElementById('response-message').innerHTML =
                        '<div class="alert alert-danger">Произошла ошибка при отправке. Попробуйте позже.</div>';
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            });
        </script>
    @endsection
