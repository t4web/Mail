<?php

namespace T4web\Mail;

return [
    Sender::class => [
        'mail-send:post' => [
            Listener\LogSending::class
        ],
    ],
];
