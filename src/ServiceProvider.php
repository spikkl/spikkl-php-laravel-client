<?php

namespace Spikkl\Laravel;

use Spikkl\Api\ApiClient;
use Illuminate\Contracts\Container\Container;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    const PACKAGE_VERSION = '1.0.0';

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerApiClient();
        $this->registerApiAdapter();
        $this->registerManager();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/spikkl.php');

        // Check if the application is a Laravel or Lumen
        // instance to properly merge the configuration file.
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([ $source => config_path('spikkl.php') ]);
        } else if ($this->app instanceof LumenApplication) {
            $this->app->configure('spikkl');
        }

        $this->mergeConfigFrom($source, 'spikkl');
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('spikkl', function (Container $app) {
            return new Manager($app);
        });

        $this->app->alias('spikkl', Manager::class);
    }

    /**
     * Register the Spikkl API adapter class.
     *
     * @return void
     */
    protected function registerApiAdapter()
    {
        $this->app->singleton('spikkl.api', function (Container $app) {
            $config = $app['config'];

            return new ApiClientAdapter($config, $app['spikkl.api.client']);
        });
    }

    /**
     * Register the Spikkl API Client.
     *
     * @return void
     */
    protected function registerApiClient()
    {
        $this->app->singleton('spikkl.api.client', function () {
            return (new ApiClient())->addVersionString('Laravel/' . self::PACKAGE_VERSION);
        });

        $this->app->alias('spikkl.api.client', ApiClient::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'spikkl',
            'spikkl.api',
            'spikkl.api.client'
        ];
    }
}