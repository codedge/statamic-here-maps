<?php

declare(strict_types=1);

namespace Codedge\HereMaps;

use Statamic\Providers\AddonServiceProvider;

final class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        \Codedge\HereMaps\Tags\HereMap::class,
    ];

    protected $viewNamespace = 'hmaps';

    public function boot()
    {
        parent::boot();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('statamic-here-maps.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/statamic-here-maps/views'),
            ], 'views');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'statamic-here-maps');
    }
}
