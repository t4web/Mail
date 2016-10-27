<?php

namespace T4web\Mail\Listener;

use Zend\EventManager\EventInterface;
use Zend\Mail\Message;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4web\Mail\Domain\MailLogEntry\MailLogEntry;
use T4web\Mail\Template;

class LogSending
{
    /**
     * @var RepositoryInterface
     */
    private $logRepository;

    /**
     * UserCreate constructor.
     * @param RepositoryInterface $logRepository
     */
    public function __construct(
        RepositoryInterface $logRepository
    )
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @param EventInterface $event
     */
    public function __invoke(EventInterface $event)
    {
        /** @var Message $message */
        $message = $event->getParam('message');

        /** @var Template $template */
        $template = $event->getParam('template');
        
        /** @var \Zend\Mail\AddressList $toAddress */
        $toAddress = $message->getTo();
        $toAddress->rewind();

        $fromAddress = $message->getFrom();
        $fromAddress->rewind();

        /** @var \Zend\Mime\Message $body */
        $body = $message->getBody();

        $entry = new MailLogEntry([
            'mailFrom' => $fromAddress->current()->getEmail(),
            'mailTo' => $toAddress->current()->getEmail(),
            'subject' => $message->getSubject(),
            'layoutId' => $template->getLayoutId(),
            'templateId' => $template->getId(),
            'body' => $body->getPartContent(0),
            'calculatedVars' => json_encode($event->getParam('data')),
        ]);


        $this->logRepository->add($entry);
    }
}