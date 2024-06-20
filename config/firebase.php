<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */

    'projects' => [
        'app' => [

            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */

            // 'credentials' => env('FIREBASE_CREDENTIALS', env('GOOGLE_APPLICATION_CREDENTIALS')),
            'credentials' =>

            // [
            //     "type" => "service_account",
            //     "project_id" => "jameda-84ea0",
            //     "private_key_id" => "d834b44e7fdaf012d6d11295e23b95fe83810194",
            //     "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCTryrSNx+K/PHI\nXco+WkDZMnm8aNR5w1xCkxCwnfUNj9fvG+ZQ80Y8J7zhSYhgfTJH0e6j7IAKCMTF\nvoraFEqWnB8UILgwRR1E+FOoQqyxPz/YKeApBsweQQ6ap7COPwjipI++5atsIyRp\nuuMmDWBp900/enyeaZV25vhme1mq2HMs/wkuiCMWleGFCOIuZu+jO9aY5Jaj8GTk\nbPNcBcCFxcG1FlBwul4XdtxQqLiNKowHmTXRHE09lyXk4ij84vNZC6Pherc4GnrE\n1nYXhIBTV/iQPIGu3HjqEWbUEeu3lz7OvIeUKTvSeQ7LSm17rJxd2gdCy4f0eX2w\nJ7+aZehZAgMBAAECggEAQNbv2IKeJTIf32YaRNzwSsvn+coWu20D5TDXa4u2SuGE\nHzVjHdhpVkDmIw1bRG3DNRgdC7hqkL0/00fwg4XUJ6Lc3EPvSjYV/zF93UqEsn9A\nAyKDic+zr3bFuC32jMVtG8C/YcNJS310X71PPGY0FeIfdsbKzuwxVJZcqfXvLNwX\nSBKg5Iz+QgkYYYUTKWBOly/Bzs6BoU476ifH3V7DaJP7V5s9zpL8+BQksjpWd6/1\ntRpIZOrA8X1bFYY0uDzGSsU7V0hjwLVN72Ai19o4kUfYHDAkjFpoxZaqy7AZBAyb\nbqOkUIgql2J9I4/bQF1zPu48LKgxWuKW5ejAo6KL3wKBgQDO5bw4Ra07KuKyiWhZ\nkmxafS0Ahc57RJpzOZBp59SlDZcomO2F6jHE/DvrMqie+QMo2snXAKdpfkrZRIow\nO39PHnSUIs7znWk6PBTXVAI1VnYuq8a298yyO1BAPbNKUjQtCPhbD0kNybKCLB6t\ntlTB8Ry5KDzVbqnRvqPmpvJaBwKBgQC2u+AyXLNTFfHObAPs+kZXbN3fCIk8Uwut\nnDg3d0qTwByFGqjQ/IdGxtTisRUD5FJUf66TZg9CdFeLaN0EMpPvQMhAoA3XNmm2\nwKNiznFhWuTK2Tv1cX3HR1y0KvcREiGqzM7EKwvqr/pEjhRkOPIObL58ysdM6beL\ncmWPtziSnwKBgGSf8zTjHmeCahMvJSM7RZuU+cghS9VD/mJAAu6fJBrKS1QhXJQe\n3OnTS0kOsFfxAApkrnn1BXcXR0v4O8VNipNuWoCZlVGCo2UBR5macCCE1qHIRbND\nPbkJg/RajdJ9vIaSsEeJXZxpFnqc/qa54OsaWz/qQ/wCAHHUaF6Ln58NAoGAAqSt\nFY1puqXynX3KgL8ODW2xt+wzr/+zh4te9M5w8boxr2s3Te6ZNljh83WETE4dMsO2\nDsPHLLrqGUYnDEx+/1L8kpK+IILU/KPEuUUrNrFN5fFGgMJng15w5NpKQKD2g7X6\nt7O3tGlfQWacvOZl+fdwufVk9KPc19OLzIxl8RkCgYAqAeunNPDcfzWNOsvjvIzE\nyCmqkMuuYiiJmTQKCC9n/XRoZAUJvvH7pck6HRImZCqgvKBZItIMxLjlzTNGa0PU\n64rkt9BgMljOOg5zXR4r9xBCD4FAglB55A+eupBPhJ4gQFO1XUPrDjT6B+SaqH5H\n1hID+/CGfdfDpjNXR5M/yw==\n-----END PRIVATE KEY-----\n",
            //     "client_email" => "firebase-adminsdk-mxok0@jameda-84ea0.iam.gserviceaccount.com",
            //     "client_id" => "117705224351329339304",
            //     "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            //     "token_uri" => "https://oauth2.googleapis.com/token",
            //     "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            //     "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-mxok0%40jameda-84ea0.iam.gserviceaccount.com",
            //     "universe_domain" => "googleapis.com"
            // ],

            [
                "type" => "service_account",
                "project_id" => "vita--crm",
                "private_key_id" => "2d78d25c16e79111bd60f6535b37a636306c96e3",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCgcdFD6ouMg4qj\nwrlAud/jQqJQDO8OEb50sTndSugbwzOdbUm2Jz9FVmaP2/P+fjYj3mGwMa+kRfc3\n+WpiWRbOOLIZAKQWD0WGK8TuXHT/YJ25YcHVgphlmhlpxujhg5wTV9iq8B9Yk/Z8\nHJcSgOrav4Lmg+ZfF2ozchMHIb0wqpb/Cd3BGkbEp8rP9HUDTvdZM5eaVyYP6UR6\n//i/SMOokUll9jgUYe73+wIWJqGclaRWT5vDgQ0lJHitE1TfvNph3i4mLpYK8l7V\n7TkuXwk+9Z+YTeZ8oHosXNu29Putq5uoGTpBBJJ0/jbJw5rq+juoRS+0VaXucECv\nfyuddJTFAgMBAAECggEAA564dgEovOGK6JRQJwxf53oYEhj4m9H9VhdZkuCfHraS\nHOSGW+cZdQW0srI9GGozQS6XTakRVBzarcH24IPaETUTmkolaZ9Wljxj6ReKRujL\nJjpKa/gnsBiAp55RSs/0CYuwhnV8f5HMZz3N5XZQgOGpS8IrbyHRckUJ9jM7WDRi\nmUVcfQDSVIQ3JOpYzTyDxqlTcBUfJr8023yM7W+8NDhmPcCB0m6sJiaw5fTJXJbN\n0d9lbIFGMPcXTV3AH9T53i9ebjCKHPhUXnxrZQZuVjFbhEBiyUDh9iD6oQHN5u7T\nSOXymfeUqtQ6znVQ6+5FlrXEL61jqK/vboLY6q2IAQKBgQDhbyJRgDsGL4zMSYLJ\nACsempu7MGiSXTfoDJiSQPx5XWseZgSwfjwgucnHWyMemV0eYiXjzrwNSKo3JDxZ\n32Oz4HES5dNce5vinl/86+DYjjpJ8+HkI1OIAGutrcV2h/UqG5TyGCJH2Vdjnw1t\ngIUDmdpuyIwMW6JXv1wLme/7gQKBgQC2MuIqMwacOXvGPFFJv0bCQ9O/FZQ4ih5i\nqMsNC6/1lV/pwvzqG3ydn86YVsTXff+M/hv9dKYP3PK1GwJZ1TjFAY7u5DMBqp2V\nHy1XtdO2Ac8fHdwh67Wm28sw7HyUBjFT0Y4QT7+r1eYFt4B/1xd3Xe/oYBaVhUFP\nAb+AeJdLRQKBgBGcnRHA8tuI23caRx1s5fF+Iqx9G65TmgqG8WR7rz3MDpJRZgxj\n0E6+NQVeGWBKmvvErzEc9ZQUGTg1nIFo8mEbJ7pSOjD/dy49MUKRKv/AHM2qP/uS\nxvPZFJB9AvA/ruebQAep2wPB9xHRWzsyzzF405fUExzkC8rPKGG/pQABAoGBAJXK\nj5YSDUUzHUeFH296Cjp8eQGIRCuXohOKoiU/jpJhFFGjNTtjDbipQbiM3ZgsxoSs\nBWcDF+PCyueKJQyl994/wbs1cZnVI2kOEMEjg8MHCbmTWv+oQdfEq/C0/FbWIIfA\nqQNQDUzAtjPNAaAYvfotCKgLF4Yl3+OMlFySyA/hAoGAfcJZYcPYkmUswiNfMJF7\nBVEcQLk2csmrAel8mF1MWEiaKd7w5JyEtTiVtdP3hfAnmvkntk9OAknN/1MkNMXc\n9Xl8m07ltkpWh8B8YSeSVa/b1i+b9Gt3Gbdpx2AADFOGDr0PsxEY6ZtjuSeOqoK2\n6CwUfPk/qIniS6BIBhGZ4JU=\n-----END PRIVATE KEY-----\n",
                "client_email" => "firebase-adminsdk-nxart@vita--crm.iam.gserviceaccount.com",
                "client_id" => "105017074181638999476",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-nxart%40vita--crm.iam.gserviceaccount.com",
                "universe_domain" => "googleapis.com"
            ],



            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firestore Component
             * ------------------------------------------------------------------------
             */

            'firestore' => [

                /*
                 * If you want to access a Firestore database other than the default database,
                 * enter its name here.
                 *
                 * By default, the Firestore client will connect to the `(default)` database.
                 *
                 * https://firebase.google.com/docs/firestore/manage-databases
                 */

                // 'database' => env('FIREBASE_FIRESTORE_DATABASE'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [

                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */

                'url' => env('FIREBASE_DATABASE_URL'),

                /*
                 * As a best practice, a service should have access to only the resources it needs.
                 * To get more fine-grained control over the resources a Firebase app instance can access,
                 * use a unique identifier in your Security Rules to represent your service.
                 *
                 * https://firebase.google.com/docs/database/admin/start#authenticate-with-limited-privileges
                 */

                // 'auth_variable_override' => [
                //     'uid' => 'my-service-worker'
                // ],

            ],

            'dynamic_links' => [

                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */

                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [

                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),

            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */

            'http_client_options' => [

                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */

                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 *
                 * The default time out can be reviewed at
                 * https://github.com/kreait/firebase-php/blob/6.x/src/Firebase/Http/HttpClientOptions.php
                 */

                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),

                'guzzle_middlewares' => [],
            ],
        ],
    ],
];
