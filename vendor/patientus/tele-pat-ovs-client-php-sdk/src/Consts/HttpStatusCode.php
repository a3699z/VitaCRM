<?php

namespace Patientus\OVS\SDK\Consts;

/**
 * HTTP status codes.
 */
abstract class HttpStatusCode
{
    const UNKNOWN               = 0;
    const BAD_REQUEST           = 400;
    const UNAUTHORIZED          = 401;
    const FORBIDDEN             = 403;
    const TOO_MANY_REQUESTS     = 429;
    const INTERNAL_SERVER_ERROR = 500;
}
