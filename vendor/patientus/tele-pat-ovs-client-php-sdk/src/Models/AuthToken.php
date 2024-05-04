<?php

namespace Patientus\OVS\SDK\Models;

use Patientus\OVS\SDK\Consts\AuthTokenType;
use Patientus\OVS\SDK\Exceptions\ApiException;
use Patientus\OVS\SDK\Exceptions\InvalidAuthTokenException;

/**
 * Authentication token.
 */
class AuthToken
{
    /**
     * Token type.
     * @var string
     */
    private $tokenType;

    /**
     * Token expiration
     * @var int
     */
    private $ExpireAt;

    /**
     * Access token.
     * @var string
     */
    private $accessToken;

    /**
     * @param string $tokenType Token type.
     * @param int $ExpireAt Token expiration.
     * @param string $accessToken Access token.
     * @throws ApiException
     */
    public function __construct($tokenType, $ExpireAt, $accessToken)
    {
        $this->setTokenType($tokenType);
        $this->setExpireAt((int)$ExpireAt);
        $this->setAccessToken($accessToken);
    }

    /**
     * Set token type.
     *
     * @param string $tokenType Token type.
     * @throws ApiException
     */
    public function setTokenType($tokenType)
    {
        if (strtolower(trim($tokenType)) !== AuthTokenType::BEARER) {
            throw new InvalidAuthTokenException('tokenType');
        }
        $this->tokenType = trim($tokenType);
    }

    /**
     * Get token type.
     *
     * @return string Token type.
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Set token expiration.
     *
     * @param int $ExpireAt Token expiration.
     * @throws ApiException
     */
    public function setExpireAt($ExpireAt)
    {
        if (!is_numeric($ExpireAt) || $ExpireAt <= 0) {
            throw new InvalidAuthTokenException('expireIn');
        }
        $this->ExpireAt = (int)$ExpireAt;
    }

    /**
     * Get token expiration.
     *
     * @return int Token expiration.
     */
    public function getExpireAt()
    {
        return $this->ExpireAt;
    }

    /**
     * Set access token.
     *
     * @param string $accessToken Access token.
     * @throws ApiException
     */
    public function setAccessToken($accessToken)
    {
        if (trim($accessToken) === '') {
            throw new InvalidAuthTokenException('accessToken');
        }
        $this->accessToken = trim($accessToken);
    }

    /**
     * Get access token.
     *
     * @return string Access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
