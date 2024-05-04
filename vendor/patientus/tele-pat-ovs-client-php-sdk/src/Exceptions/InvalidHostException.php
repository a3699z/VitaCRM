<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Invalid API host exception.
 */
class InvalidHostException extends ApiException
{
    /**
     * @param Exception|null $previous
     */
    public function __construct($previous = null)
    {
        parent::__construct('Invalid API host', 500, $previous);
    }
}
