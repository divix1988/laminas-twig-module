<?php

namespace LaminasTwig\View;

use Twig\Environment;
use Twig\Error\Loader;
use Laminas\View\Resolver\ResolverInterface;
use Laminas\View\Renderer\RendererInterface as Renderer;

class TwigResolver implements ResolverInterface
{
    /**
     * @var Twig\Environment
     */
    protected $environment;

    /**
     * Constructor.
     *
     * @param Twig\Environment $environment
     */
    public function __construct(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Resolve a template/pattern name to a resource the renderer can consume
     *
     * @param  string $name
     * @param  null|Renderer $renderer
     * @return bool
     */
    public function resolve($name, Renderer $renderer = null)
    {
        return $this->environment->loadTemplate($name);
    }
}