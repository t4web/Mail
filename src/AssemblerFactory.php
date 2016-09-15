<?php

namespace T4web\Mail;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class AssemblerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        if (!isset($config['t4web-mail']) || !is_array($config['t4web-mail'])) {
            throw new ServiceNotCreatedException('Can not create Mail\TemplateBuilder: config[t4web-mail] option not exists.');
        }

        return new Assembler(
            $config['t4web-mail']
        );
    }
}
