<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $tickets = Ticket::where('user_id', $request->user()->id)
            ->status($request->status)
            ->priority($request->priority)
            ->paginate(10);

        return $this->successResponse(['tickets' => TicketResource::collection($tickets)], '', 200);
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'user_id' => $request->user()->id
        ]);

        return $this->successResponse(['ticket' => new TicketResource($ticket)], 'Ticket criado com sucesso', 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        $this->authorize('view', $ticket);

        return $this->successResponse(['ticket' => new TicketResource($ticket)], 200);
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {   
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return $this->successResponse(['ticket' => new TicketResource($ticket)], 'Ticket atualizado com sucesso', 200);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();
        
        return $this->successResponse([], 'Ticket deletado com sucesso', 200);
    }
}
