<?php

namespace Danielmadu\LaraKvStore;

use Danielmadu\LaraKvStore\Console\Start;
use Illuminate\Cache\ArrayStore;
use Illuminate\Support\ServiceProvider;

class KVStoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/kvstore.php', 'kvstore'
        );

        $this->app->singleton('kv:memory', function ($app) {
            return new ArrayStore();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Start::class,
            ]);


            $this->publishes([
                __DIR__.'/../config/kvstore.php' => config_path('kvstore.php'),
            ], ['kv', 'kv-config']);
        }
    }
}
