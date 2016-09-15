<?php
namespace T4web\MailTest;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use T4web\Mail\AssemblerFactory;
use T4web\Mail\Assembler;

class AssemblerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new AssemblerFactory();

        $serviceLocator->get('config')->willReturn([ 't4web-mail' => [] ]);

        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(Assembler::class, $service);
    }

    public function testCreateServiceWithBadConfig()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new AssemblerFactory();

        $serviceLocator->get('config')->willReturn([]);

        $this->setExpectedException(ServiceNotCreatedException::class);
        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(Assembler::class, $service);
    }
}
