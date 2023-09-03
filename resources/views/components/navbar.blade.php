<nav class="bg-red-700 p-4">
    <div class="flex items-center justify-between">
      <div class="flex">
        <a href="{{ url('/') }}" class="text-white text-xl font-semibold">Logo</a>
      </div>
      <div class="flex space-x-4">
        <a href="{{ url('/playlist') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Aktuelle Playlist</a>
        <a href="{{ url('/songrequest') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Song Einreichen</a>
        <a href="{{ url('/create') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Playlist Erstellen</a>
        <a href="{{ route('handle-expired-token') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Handle Expired Token</a>

      </div>
    </div>
  </nav>
{{$slot}}
