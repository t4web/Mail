<?php
namespace T4web\MailTest;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use T4web\Mail\TemplateBuilderFactory;
use T4web\Mail\TemplateBuilder;

class TemplateBuilderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new TemplateBuilderFactory();

        $serviceLocator->get('config')->willReturn([ 't4web-mail' => [] ]);

        $renderer = $this->prophesize(RendererInterface::class);
        $serviceLocator->get('ViewRenderer')->willReturn($renderer->reveal());

        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(TemplateBuilder::class, $service);
    }

    public function testCreateServiceWithBadConfig()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
        $factory = new TemplateBuilderFactory();

        $serviceLocator->get('config')->willReturn([]);

        $renderer = $this->prophesize(RendererInterface::class);
        $serviceLocator->get('ViewRenderer')->willReturn($renderer->reveal());

        $this->setExpectedException(ServiceNotCreatedException::class);
        $service = $factory->createService($serviceLocator->reveal());

        $this->assertInstanceOf(TemplateBuilder::class, $service);
    }
}
