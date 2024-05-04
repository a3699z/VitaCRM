<?php

namespace Patientus\OVS\SDK\Exceptions;

/**
 * Invalid room name exception.
 */
class InvalidRoomNameException extends ApiException
{
    /**
     * @param string $roomName Room name.
     */
    public function __construct($roomName)
    {
        if (trim($roomName) === '') {
            $roomName = '[empty]';
        }
        parent::__construct("Invalid room name '$roomName'.", 400);
    }
}
