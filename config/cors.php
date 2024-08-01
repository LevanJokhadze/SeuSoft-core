<?php

return [
    'paths' => ['api/*', 'v1/*', '*'],  // Add 'v1/*' and '*' to cover all routes
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];