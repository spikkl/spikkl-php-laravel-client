<?php

namespace Spikkl\Laravel;

use Illuminate\Contracts\Container\Container;

class Manager
{
    protected Container $app;

    /**
     * SpikklManager constructor.
     *
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Get the Spikkl API adapter instance.
     *
     * @return ApiClientAdapter
     */
    public function api(): ApiClientAdapter
    {
        return $this->app['spikkl.api'];
    }
}
