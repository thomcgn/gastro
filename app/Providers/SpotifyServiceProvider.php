<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SpotifyWebAPI;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('SpotifyWebAPI\SpotifyWebAPI', function () {
            $session = new SpotifyWebAPI\Session(
                config('services.spotify.client_id'),
                config('services.spotify.client_secret')
            );

            $options = [
                'scope' => [],
            ];

            $api = new SpotifyWebAPI\SpotifyWebAPI();
            $api->setAccessToken($session->getAccessToken());

            return $api;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
