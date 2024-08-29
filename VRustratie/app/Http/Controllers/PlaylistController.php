<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('videos')->get();
        return response()->json($playlists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'videos' => 'array',
            'videos.*' => 'exists:vr_videos,id',
        ]);

        $playlist = Playlist::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'created_by' => auth()->id(),
        ]);

        $playlist->videos()->sync($validated['videos']);

        return response()->json($playlist);
    }
}