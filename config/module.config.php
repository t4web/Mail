<?php

namespace T4web\Mail;

return [
    'entity_map' => include 'entity_map.config.php',
    'events' => include 'events.config.php',
    'sebaks-view' => include 'sebaks-view.config.php',
    't4web-crud' => include 't4web-crud.config.php',
    
    't4web-mail' => [
        'from-email' => 'support@first-season.com',
        'from-name' => '1season',

        'templates' => [
            Template::FEEDBACK_ANSWER => [
                'subject' => 'Ответ на ваше сообщение в форму обратной связи',
                'template' => 't4web-mail/template/feedback-answer',
                'layout' => Template::LAYOUT_DEFAULT,
            ],
        ],
        'layout' => [
            Template::LAYOUT_DEFAULT => 't4web-mail/layout/default',
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
