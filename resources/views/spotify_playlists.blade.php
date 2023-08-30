<!DOCTYPE html>
<html>
    <head>
        <title>Warteschlange</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>
<x-navbar/>
<form method="post" >
    @csrf
    <div class="form-group">
        <label for="playlist_id">Select a Spotify Playlist:</label>
        <select name="playlist_id" id="playlist_id" class="form-control" required>
            <option value="">Select a playlist</option>
            @foreach ($playlists as $playlist)
                <option value="{{ $playlist['id'] }}">{{ $playlist['name'] }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Playlist</button>
</form>
</body>
</html>
