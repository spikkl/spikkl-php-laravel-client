<?php

namespace Spikkl\Laravel;

use stdClass;
use Illuminate\Config\Repository;
use Spikkl\Api\ApiClient;
use Spikkl\Api\Exceptions\ApiException;

class ApiClientAdapter
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * ApiWrapper constructor.
     *
     * @param Repository $config
     * @param ApiClient $client
     *
     * @throws ApiException
     */
    public function __construct(Repository $config, ApiClient $client)
    {
        $this->config = $config;
        $this->client = $client;

        $this->setApiKey(
            $this->config->get('spikkl.api_key')
        );
    }

    /**
     * Ste the custom API endpoint.
     *
     * @param string $url
     */
    public function setApiEndpoint($url)
    {
        $this->client->setApiEndpoint($url);
    }

    /**
     * Get the API endpoint.
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->client->getApiEndpoint();
    }

    /**
     * Set the API key.
     *
     * @param $apiKey
     *
     * @return void
     *
     * @throws ApiException
     */
    public function setApiKey($apiKey)
    {
        $this->client->setApiKey($apiKey);
    }

    /**
     * Add version string.
     *
     * @param $versionString
     *
     * @return ApiClientAdapter
     */
    public function addVersionString($versionString)
    {
        $this->client->addVersionString($versionString);

        return $this;
    }

    /**
     * Wrapper for client lookup method.
     *
     * @param string $countryIso3Code
     * @param string $postalCode
     * @param string|int|null $streetNumber
     * @param string|null $streetNumberSuffix
     *
     * @return stdClass
     *
     * @throws ApiException
     */
    public function lookup($countryIso3Code, $postalCode, $streetNumber = null, $streetNumberSuffix = null)
    {
        return $this->client->lookup($countryIso3Code, $postalCode, $streetNumber, $streetNumberSuffix);
    }

    /**
     * Wrapper for client reverse method.
     *
     * @param string $countryIso3Code
     * @param string|float $latitude
     * @param string|float $longitude
     *
     * @return stdClass
     *
     * @throws ApiException
     */
    public function reverse($countryIso3Code, $latitude, $longitude)
    {
        return $this->client->reverse($countryIso3Code, $latitude, $longitude);
    }
}