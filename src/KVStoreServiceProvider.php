<?php

namespace Danielmadu\LaraKvStore;

use Danielmadu\LaraKvStore\Console\Start;
use Illuminate\Cache\ArrayStore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;
use Livewire\LivewireManager;

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

        $this->registerResources();
        $this->registerComponents();
        $this->registerRoutes();
    }

    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'kvstore');
    }

    protected function registerComponents(): void
    {
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $blade) {
            $blade->anonymousComponentPath(__DIR__.'/../resources/views/components', 'kvstore');
        });

        $this->callAfterResolving('livewire', function (LivewireManager $livewire, Application $app) {
            $livewire->addPersistentMiddleware(['web']);
            $livewire->component('larakvstore.list', Livewire\ListKV::class);
            $livewire->component('larakvstore.modal', Livewire\Modal::class);
        });
    }

    protected function registerRoutes(): void
    {
        $this->callAfterResolving('router', function (Router $router, Application $app) {
            $router->group([
                'prefix' => config('kvstore.prefix'),
                'middleware' => ['web'],
            ], function (Router $router) {
                $router->get('/', function (ViewFactory $view) {
                    return $view->make('kvstore::dashboard');
                })->name('kvstore');
            });
        });
    }
}
