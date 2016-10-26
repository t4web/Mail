<?php

namespace T4web\Mail;

use Zend\Mail\Transport\TransportInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\Event;

class Sender
{
    /**
     * @var TransportInterface
     */
    private $mailTransport;

    /**
     * @var TemplateBuilder
     */
    private $templateBuilder;

    /**
     * @var Assembler
     */
    private $mailAssembler;

    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        TransportInterface $mailTransport,
        TemplateBuilder $templateBuilder,
        Assembler $mailAssembler,
        EventManager $eventManager
    ) {
        $this->mailTransport = $mailTransport;
        $this->templateBuilder = $templateBuilder;
        $this->mailAssembler = $mailAssembler;
        $this->eventManager = $eventManager;
    }

    public function send($to, $templateName, array $data = [])
    {
        $template = $this->templateBuilder->get($templateName);
        $message = $this->mailAssembler->assemble($to, $template, $data);
        $this->mailTransport->send($message);

        $event = new Event(
            'mail-sended',
            $this,
            [
                'to' => $to,
                'template' => $template,
                'message' => $message,
                'data' => $data,
            ]
        );
        $this->eventManager->trigger($event);
    }
}
