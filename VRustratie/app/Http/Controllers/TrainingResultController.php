<?php

namespace App\Http\Controllers;

use App\Models\TrainingResult;
use Illuminate\Http\Request;

class TrainingResultController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'playlist_id' => 'required|exists:playlists,id',
            'score' => 'nullable|numeric',
            'answers' => 'nullable|json',
        ]);

        $trainingResult = TrainingResult::create($validated);

        return response()->json($trainingResult);
    }

    public function getUserResults($userId)
    {
        $results = TrainingResult::where('user_id', $userId)->with('playlist')->get();
        return response()->json($results);
    }
}