@extends('layouts.admin')

@section('title', 'Заявки')
@section('page-title', 'Список заявок')

@section('content')
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-2">
            <label class="form-label">Дата</label>
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label">Статус</label>
            <select name="status" class="form-select">
                <option value="">Все</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ request('email') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label">Телефон</label>
            <input type="text" name="phone" class="form-control" value="{{ request('phone') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Фильтр</button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary w-100">Сбросить</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Клиент</th>
                <th>Email / Телефон</th>
                <th>Тема</th>
                <th>Статус</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>
                        {{ $ticket->customer->email ?? '—' }}<br>
                        {{ $ticket->customer->phone ?? '—' }}
                    </td>
                    <td>{{ Str::limit($ticket->text, 50) }}</td>
                    <td>
                            <span class="badge bg-{{ $ticket->status->name === 'новый' ? 'success' : ($ticket->status->name === 'в работе' ? 'warning' : 'secondary') }}">
                                {{ $ticket->status->name }}
                            </span>
                    </td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-sm btn-warning">Статус</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Заявок не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $tickets->appends(request()->query())->links() }}
@endsection
