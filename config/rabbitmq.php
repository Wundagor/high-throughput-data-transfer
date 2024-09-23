<?php

return [
    'queue' => [
        'arguments' => [
            'x-queue-mode' => ['S', 'lazy'],
            'x-queue-type' => ['S', 'classic'],
        ],
    ],
];
