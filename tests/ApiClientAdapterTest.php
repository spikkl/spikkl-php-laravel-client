<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use Spikkl\Api\ApiClient;
use Spikkl\Api\Exceptions\ApiException;
use Spikkl\Laravel\ApiClientAdapter;

class ApiClientAdapterTest extends TestCase
{
    /**
     * @var MockObject|ApiClient
     */
    protected $api;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->api = $this->getMockBuilder(ApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function api_client_can_be_initialized(): void
    {
        $adapter = new ApiClientAdapter($this->app['config'], $this->app[ApiClient::class]);
        $this->assertInstanceOf(ApiClientAdapter::class, $adapter);
    }

    /**
     * @test
     */
    public function endpoint_can_be_set(): void
    {
        $this->api
            ->expects($this->once())
            ->method('setApiEndpoint');

        $this->api
            ->expects($this->once())
            ->method('getApiEndpoint')
            ->willReturn('/test');

        $adapter = new ApiClientAdapter($this->app['config'], $this->api);

        $adapter->setApiEndpoint('/test');
        $this->assertSame('/test', $adapter->getApiEndpoint());
    }

    /**
     * @test
     */
    public function invalid_api_key_throws_exception(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Invalid api key: "some_api_key". Your API key should contain alpha-numeric characters only and must be 32 characters long.');

        $adapter = new ApiClientAdapter($this->app['config'], $this->app[ApiClient::class]);
        $adapter->setApiKey('some_api_key');
    }

    /**
     * @test
     */
    public function can_set_api_key(): void
    {
        $this->api
            ->expects($this->atLeastOnce())
            ->method('setApiKey')
            ->with('7da3eda72a52d350f2c6aabe4a414502');

        $adapter = new ApiClientAdapter($this->app['config'], $this->api);

        $adapter->setApiKey('7da3eda72a52d350f2c6aabe4a414502');
    }
}