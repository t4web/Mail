<?php
namespace T4web\MailTest;

use Zend\View\Renderer\RendererInterface;
use T4web\Mail\TemplateBuilder;
use T4web\Mail\Template;
use T4web\Mail\Exception\TemplateNotExistsException;
use T4web\Mail\Exception\TemplateNotCreatedException;
use Prophecy\Argument;

class TemplateBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $renderer = $this->prophesize(RendererInterface::class);

        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
            'templates' => [
                'feedback-answer' => [
                    'subject' => '',
                    'template' => 'template/feedback-answer',
                    'layout' => 'default',
                ],
            ],
            'layout' => [
                'default' => 't4web-mail/layout/default',
            ],
        ];

        $factory = new TemplateBuilder(
            $config,
            $renderer->reveal()
        );

        $templateName = 'feedback-answer';
        $template = $factory->get($templateName);

        $this->assertInstanceOf(Template::class, $template);
    }

    public function testGetWithBadLayout()
    {
        $renderer = $this->prophesize(RendererInterface::class);

        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
            'templates' => [
                'feedback-answer' => [
                    'subject' => '',
                    'template' => 'template/feedback-answer',
                    'layout' => 'default-x',
                ],
            ],
            'layout' => [
                'default' => 't4web-mail/layout/default',
            ],
        ];

        $factory = new TemplateBuilder(
            $config,
            $renderer->reveal()
        );

        $this->setExpectedException(TemplateNotCreatedException::class);
        $templateName = 'feedback-answer';
        $factory->get($templateName);
    }

    public function testGetWithNotConfiduredLayout()
    {
        $renderer = $this->prophesize(RendererInterface::class);

        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
            'templates' => [
                'feedback-answer' => [
                    'subject' => '',
                    'template' => 'template/feedback-answer',
                    'layout' => 'default',
                ],
            ],
        ];

        $factory = new TemplateBuilder(
            $config,
            $renderer->reveal()
        );

        $this->setExpectedException(TemplateNotCreatedException::class);
        $templateName = 'feedback-answer';
        $factory->get($templateName);
    }

    public function testGetWithBadTemplate()
    {
        $renderer = $this->prophesize(RendererInterface::class);

        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
            'templates' => [
                'feedback-answer' => [
                    'subject' => '',
                    'template' => 'template/feedback-answer',
                    'layout' => 'default',
                ],
            ],
            'layout' => [
                'default' => 't4web-mail/layout/default',
            ],
        ];

        $factory = new TemplateBuilder(
            $config,
            $renderer->reveal()
        );

        $this->setExpectedException(TemplateNotExistsException::class);
        $templateName = 'xxx';
        $factory->get($templateName);
    }

    public function testGetWithBadConfig()
    {
        $renderer = $this->prophesize(RendererInterface::class);

        $config = [
            'from-email' => 'support@mail.com',
            'from-name' => 'Support Mail.com',
            'templates' => [],
            'layout' => [
                'default' => 't4web-mail/layout/default',
            ],
        ];

        $factory = new TemplateBuilder(
            $config,
            $renderer->reveal()
        );

        $this->setExpectedException(TemplateNotExistsException::class);
        $templateName = 'xxx';
        $factory->get($templateName);
    }
}
