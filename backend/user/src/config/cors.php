<?php

return [
    'paths' => ['api/*'], // Atur path yang sesuai dengan endpoint Anda
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'], // Atur metode HTTP yang diizinkan
    'allowed_origins' => ['http://localhost:3000'], // Atur origin yang diizinkan
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Content-Type', 'X-Requested-With'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

