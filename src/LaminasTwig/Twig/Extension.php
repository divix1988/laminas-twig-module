<?php

namespace LaminasTwig\Twig;

use Twig_Extension;
use LaminasTwig\View\TwigRenderer;

class Extension extends Twig_Extension
{
    /**
     * @var TwigRenderer
     */
    protected $renderer;

    /**
     * @param \LaminasTwig\View\TwigRenderer $renderer
     */
    public function __construct(TwigRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return \Zend\View\HelperPluginManager
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'laminas-twig';
    }
}