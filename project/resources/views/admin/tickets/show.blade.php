@extends('layouts.admin')

@section('title', 'Заявка #' . $ticket->id)
@section('page-title', 'Заявка #' . $ticket->id)

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h5>Клиент</h5>
            <p><strong>Имя:</strong> {{ $ticket->customer->name }}</p>
            <p><strong>Email:</strong> {{ $ticket->customer->email ?? '—' }}</p>
            <p><strong>Телефон:</strong> {{ $ticket->customer->phone ?? '—' }}</p>
        </div>
        <div class="col-md-6">
            <h5>Заявка</h5>
            <p><strong>Тема:</strong> {{ $ticket->theme }}</p>
            <p><strong>Статус:</strong>
                <span class="badge bg-{{ $ticket->status->name === 'новый' ? 'success' : ($ticket->status->name === 'в работе' ? 'warning' : 'secondary') }}">
                    {{ $ticket->status->name }}
                </span>
            </p>
            <p><strong>Дата создания:</strong> {{ $ticket->created_at }}</p>
        </div>
    </div>

    <h5 class="mt-4">Текст заявки</h5>
    <div class="card">
        <div class="card-body">{{ $ticket->text }}</div>
    </div>

    @if($ticket->files->count())
        <h5 class="mt-4">Файлы</h5>
        <ul class="list-group">
            @foreach($ticket->files as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ $file->getUrl() }}" target="_blank">
                        <i class="bi bi-file-earmark"></i> {{ $file->file_name }}
                    </a>
                    <span class="text-muted">{{ $file->getHumanReadableSize() }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="mt-3">Файлы не загружены.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Назад к списку</a>
        <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-warning">Изменить статус</a>
    </div>
@endsection
