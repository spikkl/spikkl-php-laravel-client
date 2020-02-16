<?php

namespace Tests;

use Spikkl\Laravel\ApiClientAdapter;
use Spikkl\Laravel\Manager;

class ManagerTest extends TestCase
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = new Manager($this->app);
    }

    /**
     * @test
     */
    public function construct_valid_instance(): void
    {
        $this->assertInstanceOf(Manager::class, $this->manager);
    }

    /**
     * @test
     */
    public function manager_provides_api_method(): void
    {
        $this->assertInstanceOf(ApiClientAdapter::class, $this->manager->api());
        $this->assertSame($this->app['spikkl.api'], $this->manager->api());
    }
}