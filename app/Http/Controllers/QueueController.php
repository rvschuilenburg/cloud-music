<?php

namespace App\Http\Controllers;

use App\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|max:255',
        ]);

        $max = $request->user()->queue()->max('order');

        $queue = new Queue;
        $queue->track_id = $request->id;
        $queue->user_id = $request->user()->id;
        $queue->order = $max + 1;
        $queue->save();
        return 'OK';
    }

    public function index(Request $request)
    {
        return $request->user()->queue()->with('track')->get();
    }

    public function remove(Queue $queue)
    {
        $queue->delete();
        return 'OK';
    }
}
