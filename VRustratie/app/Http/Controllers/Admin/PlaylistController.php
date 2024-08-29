<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\VRVideo;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    // Display a listing of playlists
    public function index()
    {
        $playlists = Playlist::with('videos')->paginate(10);
        return view('admin.playlists.index', compact('playlists'));
    }

    // Show the form for creating a new playlist
    public function create()
    {
        $videos = VRVideo::all(); // Fetch all videos to allow attaching them to the playlist
        return view('admin.playlists.create', compact('videos'));
    }

    // Store a newly created playlist in storage
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'videos' => 'array',
            'videos.*' => 'exists:vr_videos,id',
        ]);

        // Create the playlist
        $playlist = Playlist::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'created_by' => auth()->id(),
        ]);

        // Attach videos to the playlist
        $playlist->videos()->sync($validated['videos']);

        // Redirect back with a success message
        return redirect()->route('admin.playlists.index')->with('success', 'Playlist created successfully.');
    }

    // Show the form for editing the specified playlist
    public function edit(Playlist $playlist)
    {
        $videos = VRVideo::all(); // Fetch all videos for selection
        return view('admin.playlists.edit', compact('playlist', 'videos'));
    }

    // Update the specified playlist in storage
    public function update(Request $request, Playlist $playlist)
    {
        // Validate the input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'videos' => 'array',
            'videos.*' => 'exists:vr_videos,id',
        ]);

        // Update the playlist
        $playlist->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Sync videos with the playlist
        $playlist->videos()->sync($validated['videos']);

        // Redirect back with a success message
        return redirect()->route('admin.playlists.index')->with('success', 'Playlist updated successfully.');
    }

    // Remove the specified playlist from storage
    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('admin.playlists.index')->with('success', 'Playlist deleted successfully.');
    }
}