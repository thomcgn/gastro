<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class=""><!--Content Wrapper-->
            <div class="bg-slate-200"><!--Navigation Begins-->
                <x-navbar/>
            </div><!--Navigation Ends-->
            <main class="px-16">
                <div class="flex justify-center sm:justify-end">
                    <a href="#">Login</a>
                    <a class="pl-4" href="#">Signup</a>
                </div>

                <header>
                    <h2>Playlisten</h2>
                    <h3>von E.D.P. Jukebox</h3>
                </header>
            <div>
                <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Latest Playlists</h4>

                <div class="mt-6 grid lg:grid-cols-3 gap-5">

                    <!--Cards go Here-->
                @foreach ( $playlists as $playlist )
                   <!--if string contains themenabend muss später hier noch rein-->
                    <div class="bg-white rounded overflow-hidden shadow-md flex">
                        <img class="items-center w-32 h-32 md:h-48 md:w-48 object-cover" src="{{$playlist['images'][0]['url']}}" alt="jukebox">
                        <div class="m-4">
                            <span class="font-bold text-xs md:text-md">{{$playlist['name']}}</span>
                            <span class="block font-semibold text-xs md:text-md text-gray-500">by {{$playlist['owner']['display_name']}}</span>
                            <div class="flex justify-between text-white text-xs md:text-sm md:font-bold hover:text-black p-0 mt-2 cursor-pointer">
                                <a href="https://open.spotify.com/playlist/{{$playlist['id']}}" target="_blank" rel="noopener noreferrer">
                                <span class=" flex justify-center items-center bg-gray-700 hover:bg-red-700 rounded p-1">
                                    <svg  style="color: #1DB954;" xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-brand-spotify"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M8 11.973c2.5 -1.473 5.5 -.973 7.5 .527" />
                                    <path d="M9 15c1.5 -1 4 -1 5 .5" />
                                    <path d="M7 9c2 -1 6 -2 10 .5" />
                                </svg>
                                Anhören
                                </span>
                            </a>
                            </div>
                        </div>
                    </div>
                   <!-- endif -->
                    @endforeach

                </div>




                </div>

                <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Popular Playlists</h4>
                <div class="mt-6">
                    <!--Cards go Here-->
                </div>


            </div>
            </main>
        </div>
    </body>
</html>
