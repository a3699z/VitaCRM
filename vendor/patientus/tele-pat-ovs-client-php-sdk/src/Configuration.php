<?php

namespace Patientus\OVS\SDK;

use Patientus\OVS\SDK\Exceptions\InvalidLogFilePathException;
use Patientus\OVS\SDK\Models\AuthToken;

/**
 * SDK configuration options.
 */
class Configuration
{
    /**
     * SDK configuration object.
     * @var Configuration|null
     */
    private static $defaultConfiguration = null;

    /**
     * Authentication token.
     * @var AuthToken|null
     */
    private $accessToken = null;

    /**
     * API host URI.
     * @var string|null
     */
    private $host = null;

    /**
     * In debugging mode.
     * @var bool
     */
    private $debug = false;

    /**
     * Path to the log file.
     * @var string|null
     */
    private $logFile = null;

    /**
     * Get SDK configuration object.
     *
     * @return Configuration SDK configuration object.
     */
    public static function getDefaultConfiguration()
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }

        return self::$defaultConfiguration;
    }

    /**
     * Get authentication access token.
     *
     * @return AuthToken|null Authentication access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set authentication access token.
     *
     * @param AuthToken $accessToken Authentication access token.
     * @return Configuration SDK configuration object.
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Get API host.
     *
     * @return string|null API host.
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set API host.
     *
     * @param string $host API host.
     * @return Configuration SDK configuration object.
     */
    public function setHost($host)
    {
        $host = trim($host);
        if (substr($host, strlen($host) - 1) !== '/') {
            $host .= '/';
        }
        $this->host = $host;
        return $this;
    }

    /**
     * Get debug mode status.
     *
     * @return bool Debug mode status.
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Set debug mode status.
     *
     * @param bool $debug Debug mode status.
     * @return Configuration SDK configuration object.
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * @param string $logFile
     * @return Configuration SDK configuration object.
     * @throws InvalidLogFilePathException
     */
    public function setLogFile($logFile)
    {
        $logFile = trim($logFile);
        if (!is_file($logFile)) {
            @file_put_contents($logFile, '');
        }
        if (!is_file($logFile)) {
            throw new InvalidLogFilePathException($logFile);
        }
        $this->logFile = $logFile;
        return $this;
    }
}
