<form action="{{ route('create-playlist') }}" method="POST">
    @csrf
    <label for="name">Playlist Name:</label>
    <input type="text" name="name" required>
    <button type="submit">Create Playlist</button>
</form>
