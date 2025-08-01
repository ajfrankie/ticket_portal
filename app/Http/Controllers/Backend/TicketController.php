<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $tickets = app(TicketRepository::class)->get($request)->paginate(10);

        // Return the index view with services data
        return view('backend.tickets.index', [
            'tickets' => $tickets,
            'request' => $request
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
            $data['user_id'] = auth()->id();

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
}
