<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::where('user_id', $request->user()->id);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => ['tickets' => $tickets]
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
            'data' => ['ticket' => $ticket]
        ], 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => ['ticket' => $ticket]
        ], 200);
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {   
        $ticket->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => ['ticket' => $ticket]
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
