<?php

namespace App\Services;

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

    public function createTicket($request): Ticket
    {
        $customer = Customer::where('email', $request->email ?? null)
            ->orWhere('phone', $request->phone ?? null)
            ->first();

        if (!$customer) throw new NotFoundResourceException('Клиент не найден!');

        $ticketData = [
            'customer_id' => $customer->id,
            'theme' => $request->theme,
            'text' => $request->text,
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

    public function updateStatus(int $id, $request): bool
    {
        return $this->ticketRepository->update($id, [
            'status' => $request->status,
            'manager_response_date' => now(),
        ]);
    }

    public function getStatistics($request): array
    {
        return $this->ticketRepository->getStatisticsByPeriod($request->period);
    }
}
