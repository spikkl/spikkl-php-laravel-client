<?php

namespace Spikkl\Laravel;

use Spikkl\Api\Exceptions\AccessRestrictedException;
use Spikkl\Api\Exceptions\InvalidApiKeyException;
use Spikkl\Api\Exceptions\InvalidRequestException;
use Spikkl\Api\Exceptions\OutOfRangeException;
use Spikkl\Api\Exceptions\QuotaReachedException;
use Spikkl\Api\Exceptions\RevokedApiKeyException;
use Spikkl\Api\Exceptions\ZeroResultsException;
use stdClass;
use Illuminate\Config\Repository;
use Spikkl\Api\ApiClient;
use Spikkl\Api\Exceptions\ApiException;

class ApiClientAdapter
{
    protected Repository $config;

    protected ApiClient $client;

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
    public function setApiEndpoint(string $url): void
    {
        $this->client->setApiEndpoint($url);
    }

    /**
     * Get the API endpoint.
     *
     * @return string
     */
    public function getApiEndpoint(): string
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
    public function setApiKey(string $apiKey): void
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
    public function addVersionString(string $versionString): self
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
     * @throws AccessRestrictedException
     * @throws InvalidApiKeyException
     * @throws RevokedApiKeyException
     * @throws InvalidRequestException
     * @throws QuotaReachedException
     * @throws ZeroResultsException
     * @throws ApiException
     */
    public function lookup(string $countryIso3Code, string $postalCode, ?int $streetNumber = null, ?string $streetNumberSuffix = null)
    {
        return $this->client->lookup($countryIso3Code, $postalCode, $streetNumber, $streetNumberSuffix);
    }

    /**
     * Wrapper for client reverse method.
     *
     * @param string $countryIso3Code
     * @param string|float $longitude
     * @param string|float $latitude
     *
     * @return stdClass
     *
     * @throws AccessRestrictedException
     * @throws InvalidApiKeyException
     * @throws RevokedApiKeyException
     * @throws InvalidRequestException
     * @throws OutOfRangeException
     * @throws QuotaReachedException
     * @throws ZeroResultsException
     * @throws ApiException
     */
    public function reverse($countryIso3Code, $longitude, $latitude)
    {
        return $this->client->reverse($countryIso3Code, $longitude, $latitude);
    }
}