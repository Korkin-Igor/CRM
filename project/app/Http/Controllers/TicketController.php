<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService
    ){}

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->createTicket($request->validated(), $request->file('file'));
        return response()->json(new TicketResource($ticket));
    }

    public function statistics(string $period): JsonResponse
    {
        $stats = $this->ticketService->getStatistics($period);
        return response()->json($stats);
    }
}
