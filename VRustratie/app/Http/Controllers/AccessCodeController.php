<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        $code = rand(1000, 9999); // Generate a 4-digit code

        $accessCode = AccessCode::create([
            'code' => $code,
            'playlist_id' => $validated['playlist_id'],
            'generated_by' => auth()->id(),
            'is_active' => true,
        ]);

        return response()->json($accessCode);
    }

    public function validateCode($code)
    {
        $accessCode = AccessCode::where('code', $code)->where('is_active', true)->first();

        if (!$accessCode) {
            return response()->json(['error' => 'Invalid or inactive code.'], 404);
        }

        return response()->json(['playlist_id' => $accessCode->playlist_id]);
    }
}