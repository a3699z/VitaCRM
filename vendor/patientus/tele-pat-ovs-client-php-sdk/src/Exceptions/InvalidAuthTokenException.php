<?php

namespace Patientus\OVS\SDK\Exceptions;

/**
 * Invalid authentication exception.
 */
class InvalidAuthTokenException extends ApiException
{
    /**
     * @param string $missingProperty Missing field of the authentication token.
     */
    public function __construct($missingProperty = null)
    {
        parent::__construct('Invalid authentication token.' . ($missingProperty !== null ? " Missing property '$missingProperty'." : ''), 401);
    }
}
