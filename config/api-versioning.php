<?php

return [

    'default_version' => 'v1',

    'resolver' => [
        'header' => 'X-API-Version',
        'query'  => 'api_version',
    ],

    'client' => [
        'resolver' => 'header', // header | user
        'header'   => 'X-API-KEY',
        'fallback' => 'anonymous',
    ],

    'usage' => [
        'enabled' => true,
        'ttl' => 60 * 60 * 24 * 30,
    ],

    'deprecation' => [
        'send_headers' => true,
        'log_usage' => true,
    ],

    'alerts' => [
        'enabled' => true,
        'threshold' => 100,
        'window_minutes' => 5,
    ],
];
