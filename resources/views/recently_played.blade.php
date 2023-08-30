
    <h1>Recently Played Tracks</h1>

    @if (count($recentlyPlayedTracks) > 0)
        <ul>
            @foreach ($recentlyPlayedTracks as $track)
                <li>{{ $track['track']['name'] }} - {{ $track['track']['artists'][0]['name'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No recently played tracks found.</p>
    @endif

