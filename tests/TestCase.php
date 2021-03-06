<?php

namespace Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Illuminate\Foundation\Application;
use Spikkl\Laravel\ServiceProvider;

abstract class TestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return ServiceProvider::class;
    }

    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
       return [ ServiceProvider::class];
    }
}