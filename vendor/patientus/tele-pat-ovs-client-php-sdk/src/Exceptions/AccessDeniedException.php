<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Access denied exception.
 */
class AccessDeniedException extends ApiException
{
    /**
     * @param Exception|null $previous
     */
    public function __construct($previous = null)
    {
        parent::__construct('Access denied. Check your client identifier and client certificate.', 403, $previous);
    }
}
