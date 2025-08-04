<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $tickets = app(TicketRepository::class)->get($request)->get();

        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }


    public function create()
    {
        return view('backend.tickets.create');
    }


    public function store(StoreTicketRequest $request)
    {
        try {
            $data = $request->validated();

            // Instead of relying on auth(), trust the request input (⚠️ only for dev)
            $data['user_id'] = $request->input('user_id');

            $ticket = app(TicketRepository::class)->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully.',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create ticket.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $ticket = app(TicketRepository::class)->update($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Ticket updated successfully.',
                'data' => $ticket
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Ticket.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = app(TicketRepository::class)->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Ticket deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ticket.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function show($id)
    {
        $ticket = app(TicketRepository::class)->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ticket
        ]);
    }
}
