<!DOCTYPE html>
<html>
    <head>
        <title>Warteschlange</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>
<x-navbar/>

@if (isset($queue))
<div class="flex justify-center w-screen mt-10">
    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
            Aktueller Song: <br/> {{$queue['currently_playing']['artists'][0]['name']}} - {{ $queue['currently_playing']['name']}}
        </h5>
    </div>
    <div class="flex items-center justify-between mb-4">
        <h6 class="text-l font-semibold leading-none text-gray-900 dark:text-white">In Warteschlange: </h6>
    </div>
    <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

        @foreach ( $queue['queue'] as $tracks )
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="{{$tracks['album']['images'][2]['url']}}" alt="{{$tracks['artists'][0]['name']}} image">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        {{$tracks['name']}}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{$tracks['artists'][0]['name']}}
                        </p>
                    </div>

                </div>
            </li>
        @endforeach

        </ul>
    </div>

</div>
    </div>
    @else
    <p>Derzeit spielt keine Musik</p>
@endif
</body>
</html>
