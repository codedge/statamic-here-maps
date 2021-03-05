<?php

declare(strict_types=1);

return [
    'api_key' => env('HERE_MAPS_API_KEY'),

    'here-js-scripts' => [
        'https://js.api.here.com/v3/3.1/mapsjs-core.js',
        'https://js.api.here.com/v3/3.1/mapsjs-service.js',
        'https://js.api.here.com/v3/3.1/mapsjs-ui.js',
        'https://js.api.here.com/v3/3.1/mapsjs-mapevents.js',
    ]
];
