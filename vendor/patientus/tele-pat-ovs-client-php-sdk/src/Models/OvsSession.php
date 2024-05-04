<?php

namespace Patientus\OVS\SDK\Models;

use Patientus\OVS\SDK\Exceptions\InvalidOvsSessionException;

/**
 * OVS main session and pre-join session together.
 */
class OvsSession extends OvsBasicSession
{
    /**
     * Pre-join session ID.
     *
     * @var OvsBasicSession
     */
    private $preJoin;

    /**
     * @param string $apiKey API key.
     * @param string $sessionId Main session ID.
     * @param string $token Main token.
     * @param string $preJoinSessionId Pre-join session ID.
     * @param string $preJoinToken Pre-join token.
     * @throws InvalidOvsSessionException
     */
    public function __construct($apiKey, $sessionId, $token, $preJoinSessionId, $preJoinToken)
    {
        parent::__construct($apiKey, $sessionId, $token);
        $this->preJoin = new OvsBasicSession($apiKey, $preJoinSessionId, $preJoinToken);
    }

    /**
     * Set pre-join OVS session.
     *
     * @param OvsBasicSession $preJoin Pre-join OVS session.
     */
    public function setPreJoin($preJoin)
    {
        $this->preJoin = $preJoin;
    }

    /**
     * Get pre-join OVS session.
     *
     * @return OvsBasicSession Pre-join OVS session.
     */
    public function getPreJoin()
    {
        return $this->preJoin;
    }
}
