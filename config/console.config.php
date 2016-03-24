<?php

namespace T4web\Mail;

return [
    'router' => [
        'routes' => [
            'migration-init' => [
                'type' => 'simple',
                'options' => [
                    'route' => 'mail init',
                    'defaults' => [
                        'controller' => Controller\InitController::class,
                    ]
                ]
            ],
        ],
    ]
];
