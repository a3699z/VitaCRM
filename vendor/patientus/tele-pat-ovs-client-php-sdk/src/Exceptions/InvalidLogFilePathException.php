<?php

namespace Patientus\OVS\SDK\Exceptions;

class InvalidLogFilePathException extends ApiException
{
    /**
     * @param string $logFile Log file path.
     */
    public function __construct($logFile)
    {
        parent::__construct("Can not access to the log file '$logFile'.");
    }
}
