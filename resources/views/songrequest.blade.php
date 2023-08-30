@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-navbar/>
  <div class="song">
   <div class="max-w-md mx-auto p-6">
        <span class="font-bold text-xl">Themenabend</span>
        <div class="bg-white shadow-md rounded-md p-4 w-90">
            <h2 class="text-lg font-semibold mb-2">Regeln</h2>
            <ul class="list-disc pl-6">
              <li class="mb-1">Regel 1: Das Thema muss im <span class="font-bold underline underline-offset-2">Songtitel</span> sein.<br/><hr> Beispiel: Thema ist "Farben"<br/>Gültig wäre: Placebo - <span class="text-green-500 font-bold">Black</span> Eyed<br/>
                Ungültig wäre: <span class="text-red-500 font-bold">Black</span> Eyed Peas - Pump It<hr>
            </li>
              <li class="mb-1">Regel 2: Jeder Titel kommt nur einmal vor. </li>
              <li class="mb-1">Regel 3: Wir behalten uns vor einige Interpreten und/oder Songs nicht zu spielen.</li>
              <li class="mb-1">Regel 4: Wir spielen keine Songs die in irgendeiner Form absichtlich auf eine Diskriminierung ausgelegt sind. Siehe Regel 3</li>
            </ul>
          </div>
        <form class="space-y-4" method="get" action="{{route('request-song')}}">
          <div>
            <label for="artist" class="block text-gray-700 font-semibold">Interpret</label>
            <input type="text" id="artist" name="artist" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200" placeholder="z.B. The Clash" required>
          </div>
          <div>
            <label for="songtitle" class="block text-gray-700 font-semibold">Song Titel</label>
            <input type="text" id="q" name="q" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200" placeholder="z.b London Calling" required>
          </div>
          <div>
            @day('Monday' || 'Tuesday' || 'Wednesday' || 'Friday' || 'Saturday' || 'Sunday')

             <div class="p-10">
                <div class="group relative w-max">
                    <button class="bg-gray-300 px-4 py-2 rounded-md cursor-not-allowed opacity-50" disabled>
                        Zur Playlist
                     </button>
                 <span class="pointer-events-none absolute -top-7 left-0 w-max rounded bg-gray-900 px-2 py-1 text-sm font-medium text-gray-50 opacity-0 shadow transition-opacity group-hover:opacity-100">Songs können nur Donnerstags ab 21 Uhr eingetragen werden.</span>
                </div>
              </div>

            @endday


            @day('Thursday')
            <button class="bg-green-500 hover:bg-green-700 active:bg-green-800 px-4 py-2 rounded-md text-white">
                Zur Playlist
              </button>
            @endday

            @if (isset($searchResults))
                <h2>Search Results for "{{ $query }}"</h2>
                    <ul>
                        @foreach ($searchResults as $result)
                            <li>{{ $result['name'] }} by {{ $result['artists'][0]['name'] }}</li>
                         @endforeach
                    </ul>
             @endif

          </div>
        </form>
      </div>

  </div>
