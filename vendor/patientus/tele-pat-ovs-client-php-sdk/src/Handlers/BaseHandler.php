<?php

namespace Patientus\OVS\SDK\Handlers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Patientus\OVS\SDK\Configuration;
use Patientus\OVS\SDK\Consts\HttpStatusCode;
use Patientus\OVS\SDK\Exceptions\AccessDeniedException;
use Patientus\OVS\SDK\Exceptions\ApiException;
use Patientus\OVS\SDK\Exceptions\HostCommunicationException;
use Patientus\OVS\SDK\Exceptions\InvalidHostException;
use Patientus\OVS\SDK\Exceptions\InvalidLogFilePathException;
use Patientus\OVS\SDK\Exceptions\TooManyRequestException;
use Patientus\OVS\SDK\Exceptions\UnknownException;

/**
 * Basic API handler
 */
abstract class BaseHandler
{
    /**
     * SDK configuration.
     * @var Configuration
     */
    protected $config;

    /**
     * HTTP client.
     * @var Client
     */
    protected $httpClient;

    /**
     * @param Configuration $config SDK configuration.
     * @param Client|null $httpClient HTTP client.
     */
    public function __construct($config, $httpClient = null)
    {
        $this->config = $config;
        $this->httpClient = $httpClient ?: new Client();
    }

    /**
     * Throw an API-related exception based on the given exception.
     *
     * @param Exception $exception Occurred exception.
     * @return  ApiException API-related exception.
     */
    protected function handleException($exception)
    {
         switch (true) {
            case $exception instanceof ClientException:
                switch ($exception->getCode()) {
                    case HttpStatusCode::UNKNOWN:
                        return new InvalidHostException($exception);
                    case HttpStatusCode::FORBIDDEN:
                    case HttpStatusCode::UNAUTHORIZED:
                        return new AccessDeniedException($exception);
                    case HttpStatusCode::TOO_MANY_REQUESTS:
                        return new TooManyRequestException($exception);
                    case HttpStatusCode::BAD_REQUEST:
                        return new HostCommunicationException($exception);
                    case HttpStatusCode::INTERNAL_SERVER_ERROR:
                    default:
                        return new UnknownException($exception->getCode(), $exception);
                }
            case $exception instanceof GuzzleException:
                return new HostCommunicationException($exception);
            case $exception instanceof ApiException:
                return $exception;
            default:
                return new UnknownException($exception->getCode(), $exception);
        }
    }

    /**
     * Log the occurred exception.
     *
     * @param ApiException $exception Occurred exception.
     * @return Exception Occurred exception.
     * @throws InvalidLogFilePathException
     */
    protected function logException($exception) {
        if ($this->config->isDebug() && $this->config->getLogFile()) {
            $logContent = date('Y-m-d H:i:s') . ' ' . PHP_EOL;
            $logContent .= $exception->getMessage() . PHP_EOL;
            $logContent .= $exception->getTraceAsString() . PHP_EOL;
            if ($exception->getPrevious() !== null) {
                $logContent .= 'Inner exception:' . PHP_EOL;
                $logContent .= $exception->getPrevious()->getMessage() . PHP_EOL;
                $logContent .= $exception->getPrevious()->getTraceAsString() . PHP_EOL;
            }
            $logContent .= PHP_EOL;
            $result = @file_put_contents($this->config->getLogFile(), $logContent, FILE_APPEND | LOCK_EX);
            if ($result === false) {
                throw new InvalidLogFilePathException($this->config->getLogFile());
            }
        }
        return $exception;
    }

    /**
     * Get required HTTP client header for the debugging stuff.
     *
     * @return array HTTP client options.
     */
    protected function getDebugHttpClientHeader()
    {
        return [
            RequestOptions::DEBUG => $this->config->isDebug() && $this->config->getLogFile() ? fopen($this->config->getLogFile(), 'a') : false
        ];
    }
}
