<?php

namespace T4web\Mail;

return [
    'MailLogEntry' => [
        'entityClass' => Domain\MailLogEntry\MailLogEntry::class,
        'table' => 'mail_log',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'mail_from' => 'mailFrom',
            'mail_to' => 'mailTo',
            'subject' => 'subject',
            'layout_id' => 'layoutId',
            'template_id' => 'templateId',
            'body' => 'body',
            'calculated_vars' => 'calculatedVars',
            'created_dt' => 'createdDt',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo'
        ]
    ],
];
