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
        try {
            $ticket = $this->ticketService->createTicket($request->validated());
            return response()->json(new TicketResource($ticket));
        } catch (\Exception $e) {
            \Log::error('Ошибка при создании заявки', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Не удалось создать заявку',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function statistics(string $period): JsonResponse
    {
        $stats = $this->ticketService->getStatistics($period);
        return response()->json($stats);
    }
}
