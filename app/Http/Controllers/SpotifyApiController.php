<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class SpotifyApiController extends Controller
{
    public function getCurrentlyPlaying()
    {
        $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return redirect()->route('login');
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->get('https://api.spotify.com/v1/me/player/currently-playing');

    $currentlyPlaying = $response->json()['item'] ?? null;

    return view('currently_playing', compact('currentlyPlaying'));
    }


    public function getQueue()
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->get('https://api.spotify.com/v1/me/player/queue');

    if ($response->successful()) {
        $queue = $response->json();
        return view('playlist', compact('queue'));
        //return response()->json(['queue' => $queue]);
    } else {
        $errorMessage = $response->json()['error']['message'] ?? 'An error occurred';
        return response()->json(['error' => $errorMessage], $response->status());
    }
}

public function createPlaylist()
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->post('https://api.spotify.com/v1/users/' . $user->spotify_id . '/playlists', [
        'name' => 'Your Playlist Name',
        'description' => 'Your Playlist Description',
        'public' => false, // Change this to true if you want the playlist to be public
    ]);

    if ($response->successful()) {
        $playlistData = $response->json();

        // Store playlist ID in the database
        $user->update(['spotify_playlist_id' => $playlistData['id']]);

        return response()->json(['message' => 'Playlist created successfully', 'playlistData' => $playlistData]);
    } else {
        $errorMessage = $response->json()['error']['message'] ?? 'An error occurred';
        return response()->json(['error' => $errorMessage], $response->status());
    }
}




}