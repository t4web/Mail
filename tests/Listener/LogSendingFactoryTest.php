<?php
namespace T4web\MailTest\Listener;

use Zend\ServiceManager\ServiceLocatorInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4web\Mail\Listener\LogSendingFactory;
use T4web\Mail\Listener\LogSending;

class LogSendingFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new LogSendingFactory();

        $repository = $this->prophesize(RepositoryInterface::class);
        $serviceLocator->get('MailLogEntry\Infrastructure\Repository')->willReturn($repository->reveal());

        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(LogSending::class, $service);
    }
}
