## Description

This client library is the backend part of the [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/), which is a wrapper for the [Patientus Telemedicine API](https://security.patientus.de/api/open-api-service/doc/). It provides OVS session creation functionality for the [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/). It is developed and maintained by the [Docplanner](https://www.docplanner.com/) Telemedicine team.

### How it works

Each client gets their client ID and secret from the [Docplanner](https://www.docplanner.com/) Telemedicine team. The client application must implement this client library. By providing the client ID and the secret, the backend part of the client can get an OVS session ID based on a unique identifier (room/appointment/event/conference/...) using this client library. The [Patientus Video Frontend Library](https://packages.patientus.de/repository/de.patientus.npm/) will use the OVS session ID to establish an online video consultation.
