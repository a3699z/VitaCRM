<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'firebase' => [
        'api_key' => 'API_KEY', // Only used for JS integration
        'auth_domain' => 'AUTH_DOMAIN', // Only used for JS integration
        'database_url' => 'https://jameda-84ea0-default-rtdb.firebaseio.com/',
        'secret' => "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCTryrSNx+K/PHI\nXco+WkDZMnm8aNR5w1xCkxCwnfUNj9fvG+ZQ80Y8J7zhSYhgfTJH0e6j7IAKCMTF\nvoraFEqWnB8UILgwRR1E+FOoQqyxPz/YKeApBsweQQ6ap7COPwjipI++5atsIyRp\nuuMmDWBp900/enyeaZV25vhme1mq2HMs/wkuiCMWleGFCOIuZu+jO9aY5Jaj8GTk\nbPNcBcCFxcG1FlBwul4XdtxQqLiNKowHmTXRHE09lyXk4ij84vNZC6Pherc4GnrE\n1nYXhIBTV/iQPIGu3HjqEWbUEeu3lz7OvIeUKTvSeQ7LSm17rJxd2gdCy4f0eX2w\nJ7+aZehZAgMBAAECggEAQNbv2IKeJTIf32YaRNzwSsvn+coWu20D5TDXa4u2SuGE\nHzVjHdhpVkDmIw1bRG3DNRgdC7hqkL0/00fwg4XUJ6Lc3EPvSjYV/zF93UqEsn9A\nAyKDic+zr3bFuC32jMVtG8C/YcNJS310X71PPGY0FeIfdsbKzuwxVJZcqfXvLNwX\nSBKg5Iz+QgkYYYUTKWBOly/Bzs6BoU476ifH3V7DaJP7V5s9zpL8+BQksjpWd6/1\ntRpIZOrA8X1bFYY0uDzGSsU7V0hjwLVN72Ai19o4kUfYHDAkjFpoxZaqy7AZBAyb\nbqOkUIgql2J9I4/bQF1zPu48LKgxWuKW5ejAo6KL3wKBgQDO5bw4Ra07KuKyiWhZ\nkmxafS0Ahc57RJpzOZBp59SlDZcomO2F6jHE/DvrMqie+QMo2snXAKdpfkrZRIow\nO39PHnSUIs7znWk6PBTXVAI1VnYuq8a298yyO1BAPbNKUjQtCPhbD0kNybKCLB6t\ntlTB8Ry5KDzVbqnRvqPmpvJaBwKBgQC2u+AyXLNTFfHObAPs+kZXbN3fCIk8Uwut\nnDg3d0qTwByFGqjQ/IdGxtTisRUD5FJUf66TZg9CdFeLaN0EMpPvQMhAoA3XNmm2\nwKNiznFhWuTK2Tv1cX3HR1y0KvcREiGqzM7EKwvqr/pEjhRkOPIObL58ysdM6beL\ncmWPtziSnwKBgGSf8zTjHmeCahMvJSM7RZuU+cghS9VD/mJAAu6fJBrKS1QhXJQe\n3OnTS0kOsFfxAApkrnn1BXcXR0v4O8VNipNuWoCZlVGCo2UBR5macCCE1qHIRbND\nPbkJg/RajdJ9vIaSsEeJXZxpFnqc/qa54OsaWz/qQ/wCAHHUaF6Ln58NAoGAAqSt\nFY1puqXynX3KgL8ODW2xt+wzr/+zh4te9M5w8boxr2s3Te6ZNljh83WETE4dMsO2\nDsPHLLrqGUYnDEx+/1L8kpK+IILU/KPEuUUrNrFN5fFGgMJng15w5NpKQKD2g7X6\nt7O3tGlfQWacvOZl+fdwufVk9KPc19OLzIxl8RkCgYAqAeunNPDcfzWNOsvjvIzE\nyCmqkMuuYiiJmTQKCC9n/XRoZAUJvvH7pck6HRImZCqgvKBZItIMxLjlzTNGa0PU\n64rkt9BgMljOOg5zXR4r9xBCD4FAglB55A+eupBPhJ4gQFO1XUPrDjT6B+SaqH5H\n1hID+/CGfdfDpjNXR5M/yw==\n-----END PRIVATE KEY-----\n",
        'storage_bucket' => 'STORAGE_BUCKET', // Only used for JS integratio
    ]

];
