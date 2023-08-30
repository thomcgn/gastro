<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('day', function ($expression) {
            return "<?php if (\Carbon\Carbon::now()->format('l') === {$expression}): ?>";
        });

        Blade::directive('endday', function () {
            return '<?php endif; ?>';
        });
    }
}
