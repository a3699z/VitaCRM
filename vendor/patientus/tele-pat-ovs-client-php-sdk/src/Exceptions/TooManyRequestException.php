<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Too many request to the API host exception.
 */
class TooManyRequestException extends ApiException
{
    /**
     * @param Exception|null $previous
     */
    public function __construct($previous = null)
    {
        parent::__construct('Too many request to the host. You may need to cache the result.', 429, $previous);
    }
}
