<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AccessCode;
use App\Models\Playlist;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    // Display a listing of access codes
    public function index()
    {
        $codes = AccessCode::with('playlist')->paginate(10);
        return view('admin.codes.index', compact('codes'));
    }

    // Show the form for creating a new access code
    public function create()
    {
        $playlists = Playlist::all(); // Fetch all playlists for assigning to a code
        return view('admin.codes.create', compact('playlists'));
    }

    // Store a newly created access code in storage
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        // Generate a unique 4-digit code
        $code = rand(1000, 9999);

        // Ensure the code is unique (loop until a unique code is found)
        while (AccessCode::where('code', $code)->exists()) {
            $code = rand(1000, 9999);
        }

        // Create the access code
        AccessCode::create([
            'code' => $code,
            'playlist_id' => $validated['playlist_id'],
            'generated_by' => auth()->id(),
            'is_active' => true,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.codes.index')->with('success', 'Access code generated successfully.');
    }

    // Remove the specified access code from storage
    public function destroy(AccessCode $code)
    {
        $code->delete();
        return redirect()->route('admin.codes.index')->with('success', 'Access code deleted successfully.');
    }
}