<?php namespace Cartrabbit\EloquentSluggable;

use Cartrabbit\EloquentSluggable\Services\SlugService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package Cartrabbit\EloquentSluggable
 */
class ServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/../resources/config/sluggable.php' => config_path('sluggable.php'),
//        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('config')->sluggable(require __DIR__ . '/../resources/config/sluggable.php');

        $this->app->singleton(SluggableObserver::class, function ($app) {
            return new SluggableObserver(new SlugService(), $app['events']);
        });
    }
}
