<?php

return [
    'proxies' => env('TRUSTED_PROXIES'),
    'headers' => env(
        'TRUSTED_HEADERS',
        Illuminate\Http\Request::HEADER_X_FORWARDED_ALL
    ),
];
