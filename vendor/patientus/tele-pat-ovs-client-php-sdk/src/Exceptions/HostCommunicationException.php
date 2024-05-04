<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Exception while communicating with API host.
 */
class HostCommunicationException extends ApiException
{
    /**
     * @param Exception|null $previous
     */
    public function __construct($previous = null)
    {
        parent::__construct('There was a problem during the communication with the API host.', 400, $previous);
    }
}
