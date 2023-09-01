<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\SpotifyPlaylist;

class SpotifyApiController extends Controller
{
    public function getQueue()
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return redirect()->route('spotify.login');
    }

    //
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->get('https://api.spotify.com/v1/me/player');

    if ($response->successful()) {
        $playbackState = $response->json();
    //
        }
    if($playbackState != null)
    {
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
    } else {    return view('playlist')->with('status', 'Derzeit spielt keine Musik'); }
}

public function createPlaylist(Request $request)
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $playlistName = $request->input('playlist_name');
    $date = date("d.m.Y");
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->post('https://api.spotify.com/v1/users/' . $user->spotify_id . '/playlists', [
        'name' => 'E.D.P Themenabend "'.$playlistName.'" '. $date,
        'description' => 'Your Playlist Description',
        'public' => false, // Change this to true if you want the playlist to be public
    ]);

    if ($response->successful()) {
        $playlistData = $response->json();

        // Store playlist ID in the database
        $playlist = SpotifyPlaylist::where('spotify_playlist_id',$playlistData['id'])->first();
        if(!$playlist){
            $playlist = new SpotifyPlaylist();
            $playlist->spotify_playlist_id = $playlistData['id'];
            $playlist->name = $playlistName;
            $playlist->description = $playlistData['description'];
            $playlist->public = $playlistData['public'];
            $playlist->save();
        }

        $playlist->update(['spotify_playlist_id' => $playlistData['id']]);

        //return response()->json(['message' => 'Playlist created successfully', 'playlistData' => $playlistData['id']]);
        return redirect()->route('popu')->with(['playlist'=> $playlistData['id']]);
    } else {
        $errorMessage = $response->json()['error']['message'] ?? 'An error occurred';
        return response()->json(['error' => $errorMessage], $response->status());
    }
}

public function handleExpiredToken()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    $user->delete();
    return redirect()->route('spotify.login');
    }



    public function getAllSpotifyPlaylists()
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->get('https://api.spotify.com/v1/me/playlists');

    if ($response->successful()) {
        $playlists = $response->json()['items'];

        return view('spotify_playlists', compact('playlists'));
    } else {
        $errorMessage = $response->json()['error']['message'] ?? 'An error occurred';
        return response()->json(['error' => $errorMessage], $response->status());
    }
}

public function searchSong(Request $request)
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return redirect()->route('login');
    }

    $query = $request->input('q');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
    ])->get('https://api.spotify.com/v1/search', [
        'q' => $query,
        'type' => 'track',
    ]);

    if ($response->successful()) {
        $searchResults = $response->json()['tracks']['items'];

        return view('songrequest', compact('searchResults', 'query'));
    } else {
        $errorMessage = $response->json()['error']['message'] ?? 'An error occurred';
        return back()->withErrors([$errorMessage]);
    }
}

public function populatePlaylist(Request $request)
{
    $user = Auth::user();

    if (!$user || !$user->spotify_access_token) {
        return redirect()->route('login');
    }

    $playlistId = $request->input('playlist_id');
    $songNames = $request->input('song_names');

    $songsArray = explode(',',$songNames);

    $trackUris = [];

    foreach ($songsArray as $songName) {
        // Search for the song on Spotify
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->spotify_access_token,
        ])->get('https://api.spotify.com/v1/search', [
            'q' => $songName,
            'type' => 'track',
        ]);

        if ($response->successful()) {
            $searchResults = $response->json()['tracks']['items'];
            if (!empty($searchResults)) {
                $trackUris[] = $searchResults[0]['uri'];
            }
        }
    }

    // Add tracks to the playlist
    Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->spotify_access_token,
        'Content-Type' => 'application/json',
    ])->post('https://api.spotify.com/v1/playlists/' . $playlistId . '/tracks', [
        'uris' => $trackUris,
    ]);

    return response()->json(['message' => 'Playlist created successfully']);
}



}




