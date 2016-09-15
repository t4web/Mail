<?php

namespace T4web\Mail;

use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Assembler
{
    /**
     * @var array
     */
    private $config;

    public function __construct(
        array $config
    ) {
        $this->config = $config;
    }

    /**
     * @param string $to
     * @param Template $template
     * @param array $data
     * @return Message
     */
    public function assemble($to, Template $template, array $data)
    {
        $html = new MimePart($template->getBody($data));
        $html->type = "text/html";
        $body = new MimeMessage();
        $body->addPart($html);

        $message = new Message();

        $message
            ->addFrom($this->config['from-email'], $this->config['from-name'])
            ->addTo($to)
            ->setSubject($template->getSubject())
            ->setBody($body)
            ->setEncoding("UTF-8");

        return $message;
    }
}