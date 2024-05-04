<?php

namespace Patientus\OVS\SDK\Exceptions;

/**
 * Invalid OVS session exception.
 */
class InvalidOvsSessionException extends ApiException
{
    /**
     * @param string $missingProperty Missing property of the OVS session.
     */
    public function __construct($missingProperty = null)
    {
        parent::__construct('Invalid OVS session.' . ($missingProperty !== null ? " Missing property '$missingProperty'." : ''), 500);
    }
}
