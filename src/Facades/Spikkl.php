<?php

namespace Spikkl\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Spikkl extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'spikkl';
    }
}