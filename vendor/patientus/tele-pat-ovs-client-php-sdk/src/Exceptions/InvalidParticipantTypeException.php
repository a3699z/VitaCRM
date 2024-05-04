<?php

namespace Patientus\OVS\SDK\Exceptions;

/**
 * Invalid OVS participant type.
 */
class InvalidParticipantTypeException extends ApiException
{
    /**
     * @param string $participantType Participant type.
     */
    public function __construct($participantType)
    {
        if (trim($participantType) === '') {
            $participantType = '[empty]';
        }
        parent::__construct("Invalid participant type '$participantType'.", 400);
    }
}
