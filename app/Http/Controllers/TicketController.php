<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tickets = Ticket::where('user_id', $request->user()->id)
            ->status($request->status)
            ->priority($request->priority)
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => TicketResource::collection($tickets)
        ], 200);
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

        return response()->json([
            'success' => true,
            'data' => new TicketResource($ticket)
        ], 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new TicketResource($ticket)
        ], 200);
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {   
        $ticket->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => new TicketResource($ticket)
        ], 200);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Ticket deletado com sucesso'
        ], 200);
    }
}
