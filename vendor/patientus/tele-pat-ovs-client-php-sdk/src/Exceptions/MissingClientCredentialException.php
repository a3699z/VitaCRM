<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Missing client credential exception.
 */
class MissingClientCredentialException extends ApiException
{
    /**
     * @param Exception|null $previous
     */
    public function __construct($previous = null)
    {
        parent::__construct('Missing client identifier or client secret', 401, $previous);
    }
}
