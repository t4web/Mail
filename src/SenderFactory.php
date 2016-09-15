<?php

namespace T4web\Mail;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class SenderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $eventManager = $serviceLocator->get('EventManager');
        $eventManager->setIdentifiers(Sender::class);

        return new Sender(
            new SendmailTransport(),
            $serviceLocator->get(TemplateBuilder::class),
            $serviceLocator->get(Assembler::class),
            $eventManager
        );
    }
}
