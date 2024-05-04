## Description

This client library is the backend part of the [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/), which is a wrapper for the [Patientus Telemedicine API](https://security.patientus.de/api/open-api-service/doc/). It provides OVS session creation functionality for the [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/). It is developed and maintained by the [Docplanner](https://www.docplanner.com/) Telemedicine team.

### How it works

Each client gets their client ID and secret from the [Docplanner](https://www.docplanner.com/) Telemedicine team. The client application must implement this client library. By providing the client ID and the secret, the backend part of the client can get an OVS session ID based on a unique identifier (room/appointment/event/conference/...) using this client library. The [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/) will use the OVS session ID to establish an online video consultation.
## Features

- Get access token for a client.
- Get an OVS session ID for a doctor.
- Get an OVS session ID for a patient.
## Requirements

- PHP 5.6 or later.
- guzzlehttp/guzzle 6.2 or later.
## Installation

### Composer

To install the via [Composer](https://getcomposer.org/), run `composer require patientus/tele-pat-ovs-client-php-sdk`

### Manual Installation

Download the files and include `autoload.php`:

```php
require_once('/path/to/Patientus/Client/vendor/autoload.php');
```
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
## Known Issues

There are no known issues at the time of creating this document.
## Further Help

To get more help and for any kind of information please email [ovs-sdk-support@docplanner.com](mailto:ovs-sdk-support@docplanner.com).
