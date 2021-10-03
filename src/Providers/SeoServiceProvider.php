<?php

namespace romanzipp\Seo\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use romanzipp\Seo\Collections\SchemaCollection;
use romanzipp\Seo\Collections\StructCollection;
use romanzipp\Seo\Services\SeoService;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/../config/seo.php' => config_path('seo.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/../config/seo.php',
            'seo'
        );

        $this->app->singleton(StructCollection::class, function (Application $app) {
            return new StructCollection();
        });

        $this->app->singleton(SchemaCollection::class, function (Application $app) {
            return new SchemaCollection();
        });

        $this->app->bind(SeoService::class, function (Application $app) {
            return new SeoService(
                $app->make(StructCollection::class),
                $app->make(SchemaCollection::class)
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [SeoService::class];
    }
}
