<?php

namespace App\Http\Controllers;

use App\Queue;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|max:255',
        ]);

        $track = Track::find($request->id);

        $this->addToQueue($track);

        return 'OK';
    }

    public function index(Request $request)
    {
        // if the queue is empty, add a random song for playback
        $count = Auth::user()->queue()->count();
        if ($count == 0) {
            $random_track = Auth::user()->tracks()->inRandomOrder()->first();
            $this->addToQueue($random_track);
        }
        return Auth::user()->queue()->with('track')->get();
    }

    public function remove(Queue $queue)
    {
        $queue->delete();

        return 'OK';
    }

    private function addToQueue(Track $track)
    {
        $max =  Auth::user()->queue()->max('order');

        $queue = new Queue;
        $queue->track_id = $track->id;
        $queue->user_id = Auth::user()->id;
        $queue->order = $max + 1;
        return $queue->save();
    }
}
