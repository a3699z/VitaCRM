<?php

namespace Patientus\OVS\SDK\Exceptions;

use Exception;

/**
 * Base class for the API exceptions.
 */
abstract class ApiException extends Exception
{
    /**
     * @param string $message Exception messsage.
     * @param int $code Exception code.
     * @param Exception|null $previous Previous exception
     */
    public function __construct($message, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
