<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'youtube_id' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
        ]);

        $track = new Track;
        $track->youtube_id = $request->youtube_id;
        $track->artist = $request->artist;
        $track->title = $request->title;
        $track->user_id = $request->user()->id;
        $track->save();
        
        return 'OK';
    }

    public function index(Request $request)
    {
        return $request->user()->tracks;
    }
}
