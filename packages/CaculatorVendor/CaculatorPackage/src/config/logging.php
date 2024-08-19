<?php

return [
    'channels' => [
        'crud' => [
            'driver' => 'daily',
            'path' => storage_path('logs/crud/crud.log'),
            'level' => 'info',
        ],
    ],
];
