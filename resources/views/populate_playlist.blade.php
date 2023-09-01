<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<x-navbar/>

    @if(session('playlist'))

    <form method="post" action="{{ route('populate-playlist') }}">
        @csrf
        <div class="form-group">
            <label for="playlist_id">Select Playlist:</label>
            <select name="playlist_id" id="playlist_id" class="form-control" required>


                    <option value="{{session('playlist')}}">{{session('playlist')}}</option>

            </select>
        </div>
        <div class="form-group">
            <label for="song_names">Enter Song Names (comma-separated):</label>
            <input type="text" name="song_names" id="song_names" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Populate Playlist</button>
    </form>
@endif
