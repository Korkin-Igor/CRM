<?php

namespace App\Services;

use App\Http\Resources\TicketResource;
use App\Models\Customer;
use App\Models\Status;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class TicketService
{
    public function __construct(
        protected TicketRepository $ticketRepository
    ){}

    public function getTicketsForAdmin(array $filters): array
    {
        $tickets = TicketResource::collection(
            $this->ticketRepository->getFilteredTickets($filters)
        );

        $statuses = Status::all();

        return compact('tickets', 'statuses');
    }

    public function createTicket($data): Ticket
    {
        $customer = Customer::firstOrCreate(
            [
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
            ],
            [
                'name' => $data['name'] ?? 'Гость',
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
            ]
        );

        if (!$customer) throw new NotFoundResourceException('Клиент не найден!');

        $ticketData = [
            'customer_id' => $customer->id,
            'theme' => $data['theme'],
            'text' => $data['text'],
            'status_id' => Status::where('name', 'новый')->value('id'),
        ];
        $ticket = $this->ticketRepository->create($ticketData);

        if (!empty($request->files)) {
            foreach ($request->files as $file) {
                $ticket->addMedia($file)->toMediaCollection('files');
            }
        }

        return $ticket;
    }

    public function getTicketForShow(int $id): Ticket
    {
        return $this->ticketRepository->show($id);
    }

    public function getTicketForEdit(int $id): Ticket
    {
        return $this->ticketRepository->show($id);
    }

    public function getAllStatuses()
    {
        return $this->ticketRepository->getAllStatuses();
    }

    public function updateTicketStatus(int $id, int $statusId): bool
    {
        return $this->ticketRepository->updateStatus($id, $statusId);
    }

    public function getStatistics($request): array
    {
        return $this->ticketRepository->getStatisticsByPeriod($request->period);
    }
}
