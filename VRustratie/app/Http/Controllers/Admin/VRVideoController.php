<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VRVideo;
use Illuminate\Http\Request;

class VRVideoController extends Controller
{
    // Display a listing of videos
    public function index()
    {
        $videos = VRVideo::paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    // Show the form for creating a new video
    public function create()
    {
        return view('admin.videos.create');
    }

    // Store a newly created video in storage
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
        ]);

        // Create the video
        VRVideo::create($validated);

        // Redirect back with a success message
        return redirect()->route('admin.videos.index')->with('success', 'Video created successfully.');
    }

    // Show the form for editing the specified video
    public function edit(VRVideo $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    // Update the specified video in storage
    public function update(Request $request, VRVideo $video)
    {
        // Validate the input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
        ]);

        // Update the video
        $video->update($validated);

        // Redirect back with a success message
        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully.');
    }

    // Remove the specified video from storage
    public function destroy(VRVideo $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
    }
}