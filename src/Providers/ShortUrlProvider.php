<?php

namespace JohnPaulMedina\ShortUrl\Providers;

use JohnPaulMedina\ShortUrl\Classes\Builder;
use JohnPaulMedina\ShortUrl\Classes\Validation;
use JohnPaulMedina\ShortUrl\Exceptions\ValidationException;
use Illuminate\Support\ServiceProvider;

class ShortUrlProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/short-url.php', 'short-url');

        $this->app->bind('short-url.builder', function () {
            return new Builder();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     *
     * @throws ValidationException
     */
    public function boot(): void
    {
        // Config
        $this->publishes([
            __DIR__.'/../../config/short-url.php' => config_path('short-url.php'),
        ], 'short-url-config');

        // Migrations
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'short-url-migrations');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        if (config('short-url') && config('short-url.validate_config')) {
            (new Validation())->validateConfig();
        }

        if ($this->app->runningInConsole()) {
           $this->commands( $this->getConsoleCommands() );
        }
    }

    public function getConsoleCommands() {
        return [
            \JohnPaulMedina\Console\Commands\BuildShortUrl::class
        ];
    }
}
