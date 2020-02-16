<?php

namespace Tests;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Spikkl\Api\ApiClient;
use Spikkl\Laravel\ApiClientAdapter;
use Spikkl\Laravel\Manager;

class ServiceProviderTest extends TestCase
{
    use ServiceProviderTrait;

    /**
     * @test
     */
    public function spikkl_manager_is_injectable(): void
    {
        $this->assertIsInjectable(Manager::class);
    }

    /**
     * @test
     */
    public function api_client_adapter_is_injectable(): void
    {
        $this->assertIsInjectable(ApiClientAdapter::class);
    }

    /**
     * @test
     */
    public function api_client_is_injectable(): void
    {
        $this->assertIsInjectable(ApiClient::class);
    }
}