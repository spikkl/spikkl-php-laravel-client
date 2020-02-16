<?php

namespace Spikkl\Laravel;

use Illuminate\Contracts\Container\Container;

class Manager
{
    /**
     * @var Container
     */
    protected $app;

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
     * @return mixed
     */
    public function api()
    {
        return $this->app['spikkl.api'];
    }
}
