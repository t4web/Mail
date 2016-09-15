<?php
namespace T4web\MailTest;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Model\ViewModel;
use T4web\Mail\Template;
use Prophecy\Argument;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSubject()
    {
        $renderer = $this->prophesize(RendererInterface::class);
        $layout = $this->prophesize(ViewModel::class);

        $templateConfig = [
            'subject' => 'Subject',
            'template' => 'template/feedback-answer',
            'layout' => 'default',
        ];

        $template = new Template(
            $templateConfig,
            $renderer->reveal(),
            $layout->reveal()
        );

        $this->assertEquals($templateConfig['subject'], $template->getSubject());
    }

    public function testRender()
    {
        $renderer = $this->prophesize(RendererInterface::class);
        $layout = $this->prophesize(ViewModel::class);

        $templateConfig = [
            'subject' => 'Subject',
            'template' => 'template/feedback-answer',
            'layout' => 'default',
        ];

        $template = new Template(
            $templateConfig,
            $renderer->reveal(),
            $layout->reveal()
        );

        $templateFile = "test template";

        $renderer->render(Argument::type(ViewModel::class))->willReturn($templateFile);

        $output = $template->getBody([]);

        $this->assertEquals($templateFile, $output);
    }
}
