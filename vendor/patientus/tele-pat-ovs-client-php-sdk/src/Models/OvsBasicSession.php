<?php

namespace Patientus\OVS\SDK\Models;

use Patientus\OVS\SDK\Exceptions\InvalidOvsSessionException;

/**
 * OVS session structure.
 */
class OvsBasicSession
{
    /**
     * API key.
     * @var string
     */
    private $apiKey;

    /**
     * Session ID.
     * @var string
     */
    private $sessionId;

    /**
     * Token.
     * @var string
     */
    private $token;

    /**
     * @param string $apiKey API key.
     * @param string $sessionId Session ID.
     * @param string $token Token.
     * @throws InvalidOvsSessionException
     */
    public function __construct($apiKey, $sessionId, $token)
    {
        $this->setApiKey($apiKey);
        $this->setSessionId($sessionId);
        $this->setToken($token);
    }

    /**
     * Set API key.
     *
     * @param string $apiKey API key.
     * @throws InvalidOvsSessionException
     */
    public function setApiKey($apiKey)
    {
        if (trim($apiKey) === '') {
            throw new InvalidOvsSessionException('apiKey');
        }
        $this->apiKey = trim($apiKey);
    }

    /**
     * Get API key.
     *
     * @return string API key.
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set session ID.
     *
     * @param string $sessionId Session ID.
     * @throws InvalidOvsSessionException
     */
    public function setSessionId($sessionId)
    {
        if (trim($sessionId) === '') {
            throw new InvalidOvsSessionException('sessionId');
        }
        $this->sessionId = trim($sessionId);
    }

    /**
     * Get session ID.
     *
     * @return string Session ID.
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set token.
     *
     * @param string $token Token.
     * @throws InvalidOvsSessionException
     */
    public function setToken($token)
    {
        if (trim($token) === '') {
            throw new InvalidOvsSessionException('token');
        }
        $this->token = trim($token);
    }

    /**
     * Get token.
     *
     * @return string Token.
     */
    public function getToken()
    {
        return $this->token;
    }
}
