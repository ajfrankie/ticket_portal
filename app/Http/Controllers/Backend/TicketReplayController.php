<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketReplayRepository;

class TicketReplayController extends Controller
{
    public function index(Request $request)
    {
        $replies = app(TicketReplayRepository::class)->get($request)->get();
        return view('admin.replay.index', [
            'tickets' => $replies,
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'message' => 'required|string',
        ]);

        try {
            $reply = app(TicketReplayRepository::class)->create([
                'ticket_id' => $request->ticket_id,
                'user_id' => auth()->id(),  // ✅ Comes from logged-in user
                'message' => $request->message,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully.',
                'data' => $reply->load('user'), // optional: load user info
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send reply.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
