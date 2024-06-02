<?php
return [
    'paths' => ['*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['127.0.0.1:8000'], // Replace with your actual domain
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => false,
    'max_age' => 100,
    'supports_credentials' => false,
];
