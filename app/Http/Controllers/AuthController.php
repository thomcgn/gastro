<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
public function redirectToSpotify()
    {
        return Socialite::driver('spotify')
            ->scopes([
                'user-read-private',
                'user-read-email',
                'user-read-currently-playing',
                'user-read-playback-state',
                'user-modify-playback-state',
                'playlist-read-private',
                'playlist-modify-public',
                'playlist-modify-private'
                ]) // Add necessary scopes
            ->redirect();
    }

    public function handleSpotifyCallback()
    {
        $spotifyUser = Socialite::driver('spotify')->stateless()->user();

        $user = User::where('spotify_id',$spotifyUser->id)->first();

        if (!$user) {
            // Create a new user in the database
            $user = new User();
            $user->spotify_id = $spotifyUser->id;
            $user->name = $spotifyUser->name;
            $user->email = $spotifyUser->email;
            $user->spotify_access_token = $spotifyUser->token;
            $user->save();
        }

        // Store the access token in the session
        Session::put('spotify_access_token', $spotifyUser->token);

        // You can also log in the user using Laravel's authentication system
        auth()->login($user);


        return redirect()->route('currentList')->with('status', 'Hat geklappt'); // Redirect to home page after successful login
    }

}

