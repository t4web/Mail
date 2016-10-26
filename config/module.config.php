<?php

namespace T4web\Mail;

return [
    'sebaks-view' => include 'sebaks-view.config.php',
    
    't4web-mail' => [
        'from-email' => 'support@first-season.com',
        'from-name' => '1season',

        'templates' => [
            'feedback-answer' => [
                'subject' => 'Ответ на ваше сообщение в форму обратной связи',
                'template' => 't4web-mail/template/feedback-answer',
                'layout' => 'default',
            ],
        ],
        'layout' => [
            'default' => 't4web-mail/layout/default',
        ],
    ],

    'console' => require_once 'console.config.php',
    'controllers' => require_once 'controllers.config.php',

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
