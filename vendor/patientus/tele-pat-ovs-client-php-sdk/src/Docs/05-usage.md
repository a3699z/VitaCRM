## Usage

There are a handful of setup steps to go through. Generally, the steps are:

- [Install](#installation) the client library in the project.
- Configure the library.
- Get an access token and register it.
- Get an OVS session.

### Configure the library

```php
// Get default configuration
$config = Patientus\OVS\SDK\Configuration::getDefaultConfiguration();

// Set the API host
$config->setHost('API host URL');
```

- API host URL: The URL of the [Patientus Telemedicine API](https://security.patientus.de/api/open-api-service/doc/).

### Get an access token and register it

```php
// Create an authorization handler object
$authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
    $config
);

// Get an authentication token
$authToken = $authorization->getAuthToken('client_identifier', 'client_secret');

// Register the authentication token
$config->setAccessToken($authToken);
```

- client_identifier: Given client ID.
- client_secret: Given client secret.

### Get an OVS session

```php
// Create an OVS session handler object 
$ovsSessionHandler = new \Patientus\OVS\SDK\Handler\OvsSessionHandler(
    $config
);
```

Fot a doctor (moderator role):
```php
$ovsSession = $ovsSessionHandler->getOvsSession(
    'room_name',
    \Patientus\OVS\SDK\Consts\ParticipantType::MODERATOR
);
```

Fot a patient (publisher role):
```php
$ovsSession = $ovsSessionHandler->getOvsSession(
    'room_name',
    \Patientus\OVS\SDK\Consts\ParticipantType::PUBLISHER
);
```

- room_name : An arbitrary name for the room, event, appointment or conference.
