<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        // Fetch all users, optionally paginated
        $users = User::paginate(10); // Adjust pagination as needed
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,participant',
        ]);

        // Create the user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
        // Display the edit form with playlists
        public function edit(User $user)
        {
            $playlists = Playlist::all(); // Fetch all available playlists
            return view('admin.users.edit', compact('user', 'playlists'));
        }
    
        // Update the user's assigned playlists
        public function update(Request $request, User $user)
        {
            $request->validate([
                'playlists' => 'array',
                'playlists.*' => 'exists:playlists,id',
            ]);
    
            // Sync the selected playlists with the user
            $user->playlists()->sync($request->playlists);
    
            return redirect()->route('admin.users.index')->with('success', 'Playlists updated successfully for ' . $user->name);
        }
    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}