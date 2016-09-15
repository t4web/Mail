<?php

namespace T4web\Mail;

return [
    'router' => [
        'routes' => [
            'mail-init' => [
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
