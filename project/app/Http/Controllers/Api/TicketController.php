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

    public function statistics(string $period): JsonResponse
    {
        $stats = $this->ticketService->getStatistics($period);
        return response()->json($stats);
    }
}
