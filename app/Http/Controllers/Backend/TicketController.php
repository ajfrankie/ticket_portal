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

            app(TicketRepository::class)->create($data);

            return redirect()->route('admin.ticket.index')->with('success', 'Ticket created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create ticket: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticket =  app(TicketRepository::class)->update($id, $request->all());
            return redirect()->route('admin.ticket.index')->with('success', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update Ticket: ' . $e->getMessage());
        }
    }



    public function edit($id, Request $request)
    {
        $ticket = app(TicketRepository::class)->find($id);

        return view(
            'backend.tickets.edit',
            [
                'ticket' => $ticket,
                'request' => $request
            ]
        );
    }



    public function destroy($id)
    {
        try {
           $ticket =  app(TicketRepository::class)->delete($id);
            return redirect()->route('admin.ticket.index')->with('success', 'Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete ticket: ' . $e->getMessage());
        }
    }
}
