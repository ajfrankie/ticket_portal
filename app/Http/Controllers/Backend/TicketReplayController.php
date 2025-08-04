<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplayRequest;
use App\Repositories\TicketReplayRepository;

class TicketReplayController extends Controller
{
    public function show(Request $request)
    {
        $replay = app(TicketReplayRepository::class)->get($request)->get();

        if (!$replay) {
            return response()->json([
                'success' => false,
                'message' => 'No replies found for this ticket.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $replay,
        ]);
    }

    public function store(StoreReplayRequest $request)
    {
        try {
            $data = [
                'ticket_id' => $request->input('ticket_id'),
                'user_id'   => $request->input('user_id'),
                'message'   => $request->input('message'),
            ];

            $reply = app(TicketReplayRepository::class)->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully.',
                'data' => $reply->load('user'), 
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
