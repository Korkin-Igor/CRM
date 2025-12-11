<?php

namespace App\Repositories;

use App\Models\Status;
use App\Models\Ticket;

class TicketRepository implements RepositoryInterface
{
    public function getFilteredTickets(?array $filters, ?int $perPage = 15)
    {
        $query = Ticket::with(['customer', 'status']);

        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        if (!empty($filters['status'])) {
            $query->where('status_id', $filters['status']);
        }

        if (!empty($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', "%{$filters['email']}%");
            });
        }

        if (!empty($filters['phone'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', "%{$filters['phone']}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function show(int $id): ?Ticket
    {
        return Ticket::with(['customer', 'status', 'files'])->findOrFail($id);
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function updateStatus(int $id, int $statusId): bool
    {
        return Ticket::where('id', $id)
            ->update([
                'status_id' => $statusId,
                'response_date' => now(),
            ]);
    }

    public function getStatisticsByPeriod(string $period): array
    {
        $tickets = Ticket::query();

        switch ($period) {
            case 'day':
                $tickets->whereDate('created_at', today());
                break;
            case 'week':
                $tickets->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $tickets->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                break;
            default:
                throw new \InvalidArgumentException('Невалидный период!');
        }

        return [
            'total' => $tickets->count(),
            'new' => Status::where('name', 'новый')->first()->tickets->count(),
            'in_work' => Status::where('name', 'в работе')->first()->tickets->count(),
            'processed' => Status::where('name', 'в процессе')->first()->tickets->count(),
        ];
    }

    public function getAllStatuses()
    {
        return Status::all();
    }
}
