# Mail

[![Build Status](https://travis-ci.org/t4web/Mail.svg?branch=master)](https://travis-ci.org/t4web/Mail)
[![codecov.io](http://codecov.io/github/t4web/Mail/coverage.svg?branch=master)](http://codecov.io/github/t4web/Mail?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/t4web/Mail/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/t4web/Mail/?branch=master)

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

        // Template id
        T4web\Mail\Template::FEEDBACK_ANSWER => [
            'subject' => 'Feedback answer',
            'template' => 't4web-mail/template/feedback-answer',
            'layout' => T4web\Mail\Template::LAYOUT_DEFAULT,
        ],
    ],

    'layout' => [

        // Layout id => layout template
        T4web\Mail\Template::LAYOUT_DEFAULT => 't4web-mail/layout/default',
    ],
],
```

Template may be like this [template/feedback-answer.phtml](https://github.com/t4web/Mail/blob/master/view/t4web-mail/template/feedback-answer.phtml)

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
$this->sender->send($to, \T4web\Mail\Template::FEEDBACK_ANSWER, $data);
```