<?php

namespace Nacosvel\Rooster;

use Illuminate\Support\ServiceProvider;

class RoosterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (false === $this->app->configurationIsCached()) {
            $this->registerConfig();
        }
        $this->app->bind('rooster', function () {
            return config('rooster', []);
        });
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rooster.php', 'rooster');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/rooster.php' => config_path('rooster.php'),
            ], 'rooster-config');
        }
    }

}
