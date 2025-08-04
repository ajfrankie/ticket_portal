<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;

class TicketRepository
{
    protected $model;

    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }

    public function get(Request $request)
    {
        $query = Ticket::with('user');

        if (!empty($request->subject)) {
            $query->where('subject', 'LIKE', "%{$request->subject}%");
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        return $query;
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
        $ticket = $this->find($id);
        if ($ticket) {
            $ticket->update($input);
        }
        return $ticket;
    }

    public function delete($id)
    {
        $ticket = $this->find($id);
        if ($ticket) {
            $ticket->delete();
        }
    }
}
