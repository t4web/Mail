# Mail

ZF2 Module. Send mails, managing mail templates and mail log.

Installation
------------
### Main Setup

#### By cloning project

Clone this project into your `./vendor/` directory.

#### With composer

Add this project in your composer.json:

```json
"require": {
    "t4web/mail": "~1.0.0"
}
```

Now tell composer to download `T4web\Mail` by running the command:

```bash
$ php composer.phar update

#### Post installation

Enabling it in your `application.config.php`file.

```php
<?php
return array(
    'modules' => array(
        // ...
        'T4web\Mail',
    ),
    // ...
);
```

Configuring
------------
For define mail templates, describe it in config:

```php
't4web-mail' => [
    // Global for all mails
    'from-email' => 'support@your-domain.com',

    // Global for all mails
    'from-name' => 'Your project name',

    'templates' => [

        // Template name
        'feedback-answer' => [
            'subject' => 'Feedback answer',
            'template' => 't4web-mail/template/feedback-answer',
            'layout' => 'default',
        ],
    ],

    'layout' => [

        // Layout name => layout template
        'default' => 't4web-mail/layout/default',
    ],
],
```

Using
------------
```php
$sender = $this->getServiceLocator()->get(\T4web\Mail\Sender::class);
$to = 'receiver@email.com';
$data = [
    'userName' => 'Max',
    'message' => 'My message',
    'answer' => 'My answer',
];
$this->sender->send($to, 'feedback-answer', $data);
```