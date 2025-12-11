@extends('layouts.admin')

@section('title', 'Изменить статус заявки #' . $ticket->id)
@section('page-title', 'Изменить статус заявки #' . $ticket->id)

@section('content')
    <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Текущий статус</label>
            <input type="text" class="form-control" value="{{ $ticket->status->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Новый статус</label>
            <select name="status_id" class="form-select" required>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $ticket->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить статус</button>
        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
