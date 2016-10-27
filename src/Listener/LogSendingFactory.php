<?php

namespace T4web\Mail\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogSendingFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LogSending(
            $serviceLocator->get('MailLogEntry\Infrastructure\Repository')
        );
    }
}