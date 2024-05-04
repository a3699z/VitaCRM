<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Unknown exception.
 */
class UnknownException extends ApiException
{
    /**
     * @param int $code Exception code.
     * @param Exception|null $previous
     */
    public function __construct($code = 0, $previous = null)
    {
        parent::__construct('Unknown exception.', $code, $previous);
    }
}
