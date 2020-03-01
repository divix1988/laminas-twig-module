<?php

namespace LaminasTwig\View;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use \Interop\Container\ContainerInterface;

class TwigStrategyFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TwigStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new $this($serviceLocator->get('LaminasTwigRenderer'));
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new TwigStrategy($container->get('LaminasTwigRenderer'));
    }

}
