<?php

namespace T4web\Mail;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface, ConsoleUsageProviderInterface
{
    public function getConfig()
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => dirname(__DIR__) . '/src',
                ],
            ],
        ];
    }

    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'Initialize migrations',
            'mail init' => 'Check config, create tables `mail_log` and `mail_templates`',
        ];
    }
}
