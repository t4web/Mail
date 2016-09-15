<?php

namespace T4web\Mail;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Model\ViewModel;

class Template
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $layout;

    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(
        array $templateConfig,
        RendererInterface $renderer,
        ViewModel $layout
    ) {
        if (!isset($templateConfig['subject'])) {
            throw new Exception\TemplateException("Template subject not configured.");
        }

        $this->subject = $templateConfig['subject'];

        if (!isset($templateConfig['template'])) {
            throw new Exception\TemplateException("Template template not configured.");
        }

        $this->template = $templateConfig['template'];
        $this->layout = $layout;
        $this->renderer = $renderer;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param array $data
     * @return string
     */
    public function getBody(array $data = [])
    {
        $viewContent = new ViewModel($data);
        $viewContent->setTemplate($this->template);
        $content = $this->renderer->render($viewContent);

        $this->layout->setVariable('content', $content);

        return $this->renderer->render($this->layout);
    }
}