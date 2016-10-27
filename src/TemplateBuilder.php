<?php

namespace T4web\Mail;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Model\ViewModel;

class TemplateBuilder
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(
        array $config,
        RendererInterface $renderer
    ) {
        $this->config = $config;
        $this->renderer = $renderer;
    }

    public function get($templateId)
    {
        if (!isset($this->config['layout'])) {
            throw new Exception\TemplateNotCreatedException("Layouts not describes in config.");
        }
        if (!isset($this->config['templates'])) {
            throw new Exception\TemplateNotExistsException("Templates not describes in config.");
        }
        if (!isset($this->config['templates'][$templateId])) {
            throw new Exception\TemplateNotExistsException("Template $templateId does not exists.");
        }
        if (!isset($this->config['layout'][$this->config['templates'][$templateId]['layout']])) {
            throw new Exception\TemplateNotCreatedException("Layout {$this->config['templates'][$templateId]['layout']} not describes in config.");
        }

        $viewLayout = new ViewModel();
        $viewLayout->setTemplate($this->config['layout'][$this->config['templates'][$templateId]['layout']]);

        return new Template($templateId, $this->config['templates'][$templateId], $this->renderer, $viewLayout);
    }
}