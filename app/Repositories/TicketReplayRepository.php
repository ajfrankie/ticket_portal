<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TicketReply;

class TicketReplayRepository
{
    protected $model;

    public function __construct(TicketReply $ticketReply)
    {
        $this->model = $ticketReply;
    }

    public function get(Request $request)
    {
        $query = Ticket::with(['replies.user']); 

        if (!empty($request->subject)) {
            $query->where('subject', 'LIKE', "%{$request->subject}%");
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        if (!empty($request->ticket_id)) {
            $query->where('id', $request->ticket_id);
        }

        $tickets = $query->get();

        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }


    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $input)
    {
        $ticketReply = $this->find($id);
        if ($ticketReply) {
            $ticketReply->update($input);
        }
        return $ticketReply;
    }

    public function delete($id)
    {
        $ticketReply = $this->find($id);
        if ($ticketReply) {
            $ticketReply->delete();
        }
    }
}
