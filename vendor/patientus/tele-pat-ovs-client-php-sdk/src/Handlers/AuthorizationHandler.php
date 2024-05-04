<?php

namespace Patientus\OVS\SDK\Handlers;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Patientus\OVS\SDK\Configuration;
use Patientus\OVS\SDK\Exceptions\ApiException;
use Patientus\OVS\SDK\Exceptions\InvalidAuthTokenException;
use Patientus\OVS\SDK\Exceptions\MissingClientCredentialException;
use Patientus\OVS\SDK\Models\AuthToken;

/**
 * Handle authentication and authorization functionalities.
 */
class AuthorizationHandler extends BaseHandler
{
    /**
     * API endpoint.
     */
    const ENDPOINT_PATH = 'api/open-api-service/OAuth/client/accessToken';

    /**
     * @param Configuration $config SDK configuration.
     * @param ClientInterface|null $httpClient HTTP client.
     */
    public function __construct($config, ClientInterface $httpClient = null)
    {
        parent::__construct($config, $httpClient);
    }

    /**
     * Get authentication token.
     *
     * @param string $clientIdentifier Client identifier.
     * @param string $clientSecret Client secret.
     * @return AuthToken Authentication token.
     * @throws ApiException
     */
    public function getAuthToken($clientIdentifier, $clientSecret)
    {
        if (!trim($clientIdentifier) || !trim($clientSecret)) {
            throw $this->logException(new MissingClientCredentialException());
        }

        try {
            $data = [
                'client_id' => $clientIdentifier,
                'client_secret' => $clientSecret
            ];

            $httpClientOptions = $this->getDebugHttpClientHeader();
            $httpClientOptions[RequestOptions::JSON] = $data;

            $response = $this->httpClient->post($this->config->getHost() . self::ENDPOINT_PATH, $httpClientOptions);

            $result = $response->getBody()->getContents();
            $result = json_decode($result, true);

            if ($result === NULL) {
                throw new InvalidAuthTokenException();
            }

            return new AuthToken(
                isset($result['token_type']) ? $result['token_type'] : null,
                isset($result['expires_in']) ? $result['expires_in'] : null,
                isset($result['access_token']) ? $result['access_token'] : null);
        }
        catch (GuzzleException $exception) {
            throw $this->logException($this->handleException($exception));
        }
        catch (Exception $exception) {
            throw $this->logException($this->handleException($exception));
        }
    }
}
