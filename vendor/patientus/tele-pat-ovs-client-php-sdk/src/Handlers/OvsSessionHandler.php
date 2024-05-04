<?php

namespace Patientus\OVS\SDK\Handlers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Patientus\OVS\SDK\Configuration;
use Patientus\OVS\SDK\Consts\ParticipantType;
use Patientus\OVS\SDK\Exceptions\ApiException;
use Patientus\OVS\SDK\Exceptions\InvalidParticipantTypeException;
use Patientus\OVS\SDK\Exceptions\InvalidRoomNameException;
use Patientus\OVS\SDK\Models\OvsSession;

/**
 * Handle the OVS session functionalities.
 */
class OvsSessionHandler extends BaseHandler
{
    /**
     * API endpoint.
     */
    const ENDPOINT_PATH = 'api/open-api-service/ovs-room/%s/%s';

    /**
     * Naming conventions for a room.
     */
    const ROOM_NAME_VALIDATION_REGX = '/^[a-zA-Z\d\-_]+$/';

    /**
     * @param Configuration $config SDK configuration.
     * @param Client|null $httpClient HTTP client.
     */
    public function __construct($config, $httpClient = null)
    {
        parent::__construct($config, $httpClient);
    }

    /**
     * Get OVS session for given room name and participant type.
     *
     * @param string $roomName OVS session room name.
     * @param string $participantType OVS session participant type.
     * @return OvsSession OVS session.
     * @throws ApiException
     */
    public function getOvsSession($roomName, $participantType = ParticipantType::PUBLISHER)
    {
        $roomName = trim($roomName);
        if (preg_match(self::ROOM_NAME_VALIDATION_REGX, $roomName) === 0) {
            throw $this->logException(new InvalidRoomNameException($roomName));
        }

        if ($participantType !== ParticipantType::PUBLISHER && $participantType !== ParticipantType::MODERATOR) {
            throw $this->logException(new InvalidParticipantTypeException($participantType));
        }
        $role = $participantType === ParticipantType::PUBLISHER ? 'patient' : 'doctor';

        try {
            $httpClientOptions = $this->getDebugHttpClientHeader();
            $httpClientOptions['headers'] = [
                'Authorization' => $this->config->getAccessToken()->getTokenType() . ' ' . $this->config->getAccessToken()->getAccessToken()
            ];

            $response = $this->httpClient->get($this->config->getHost() . '/' . sprintf(self::ENDPOINT_PATH, $roomName, $role), $httpClientOptions);

            $result = $response->getBody()->getContents();
            $result = json_decode($result, true);

            return new OvsSession(
                isset($result['apiKey']) ? $result['apiKey'] : null,
                isset($result['sessionId']) ? $result['sessionId'] : null,
                isset($result['token']) ? $result['token'] : null,
                isset($result['preJoin']['sessionId']) ? $result['preJoin']['sessionId'] : null,
                isset($result['preJoin']['token']) ? $result['preJoin']['token'] : null
            );
        }
        catch (GuzzleException $exception) {
            throw $this->logException($this->handleException($exception));
        }
        catch (Exception $exception) {
            throw $this->logException($this->handleException($exception));
        }
    }
}
