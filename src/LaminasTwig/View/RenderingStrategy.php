<?php

namespace LaminasTwig\View;

use Twig\Environment;
use Twig\Error\Loader;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\Http\Response;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;

/**
 * @category   Laminas
 * @package    Laminas\Mvc
 * @subpackage View
 */
class RenderingStrategy implements ListenerAggregateInterface
{
    /**
     * @var \Laminas\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * @var Twig_Environment
     */
    protected $environment;

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'render'), -999);
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param Twig_Environment $environment
     * @return RenderingStrategy
     */
    public function setEnvironment(Twig\Environment $environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return Twig\Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Render the view
     *
     * @param  MvcEvent $e
     * @return null|Response
     */
    public function render(MvcEvent $e)
    {
        $result = $e->getResult();
        if ($result instanceof Response) {
            return $result;
        }

        // Martial arguments
        $response  = $e->getResponse();
        $viewModel = $e->getViewModel();
        if (!$viewModel instanceof ViewModel) {
            return null;
        }

        try {
            $result = $this->getEnvironment()->render(
                $viewModel->getTemplate() . $this->getSuffix(),
                (array) $viewModel->getVariables()
            );
        } catch (Twig\Error\Loader $e) {
            return null;
        }

        $response->setContent($result);
        $e->setResult($response);

        return $response;
    }
}