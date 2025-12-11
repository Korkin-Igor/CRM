<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Status;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService
    ){}

    public function index(Request $request): View
    {
        $filters = [
            'date' => $request->filled('date') ? $request->date : null,
            'status' => $request->filled('status') ? $request->status : null,
            'email' => $request->filled('email') ? $request->email : null,
            'phone' => $request->filled('phone') ? $request->phone : null,
        ];
        return view('admin.tickets.index', $this->ticketService->getTicketsForAdmin($filters));
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->createTicket($request->validated());
        return response()->json(new TicketResource($ticket));
    }

    public function show(int $id): View
    {
        $ticket = $this->ticketService->getTicketForShow($id);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(int $id): View
    {
        $ticket = $this->ticketService->getTicketForEdit($id);
        $statuses = $this->ticketService->getAllStatuses();
        return view('admin.tickets.edit', compact('ticket', 'statuses'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $this->ticketService->updateTicketStatus($id, $request->status_id);

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Статус заявки обновлён.');
    }

    public function statistics(string $period): JsonResponse
    {
        $stats = $this->ticketService->getStatistics($period);
        return response()->json($stats);
    }
}
