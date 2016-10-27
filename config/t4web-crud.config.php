<?php

namespace T4web\Mail;

return [
    'route-generation' => [
        [
            'entity' => 'MailLogEntry',
            'backend' => [
                'actions' => [
                    'list',
                ],
                'options' => [
                    'list' => [
                        'criteriaValidator' => Action\Backend\ListAction\CriteriaValidator::class,
                    ],
                ],
            ],
        ],
    ],
];

