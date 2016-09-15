<?php
namespace T4web\MailTest;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManager;
use T4web\Mail\Sender;
use T4web\Mail\SenderFactory;
use T4web\Mail\TemplateBuilder;
use T4web\Mail\Assembler;

class SenderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new SenderFactory();

        $templateBuilder = $this->prophesize(TemplateBuilder::class);
        $serviceLocator->get(TemplateBuilder::class)->willReturn($templateBuilder->reveal());

        $assembler = $this->prophesize(Assembler::class);
        $serviceLocator->get(Assembler::class)->willReturn($assembler->reveal());

        $eventManager = $this->prophesize(EventManager::class);
        $serviceLocator->get('EventManager')->willReturn($eventManager->reveal());

        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(Sender::class, $service);
    }
}
