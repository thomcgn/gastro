
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<x-navbar/>
<div class="max-w-md mx-auto p-6">
    <span class="font-bold text-xl">Themenabend</span>
    <div class="bg-white shadow-md rounded-md p-4 w-90">
        <form class="space-y-4" action="{{ route('create-playlist') }}" method="POST">
            @csrf
            <label for="name" class="block text-gray-700 font-semibold">Thema des Abends:</label>
            <input type="text" id="playlist_name" name="playlist_name" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200" required>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-10">Erstelle Playlist</button>
        </form>
    <div>
    </div>
