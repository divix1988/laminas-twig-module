<?php

namespace LaminasTwig\Twig;

use InvalidArgumentException;
use Twig_Loader_Chain;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class ChainLoaderFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \InvalidArgumentException
     * @return Twig_Loader_Chain
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \LaminasTwig\moduleOptions $options */
        $options = $serviceLocator->get('LaminasTwig\ModuleOptions');

        // Setup loader
        $chain = new Twig_Loader_Chain();

        foreach ($options->getLoaderChain() as $loader) {
            if (!is_string($loader) || !$serviceLocator->has($loader)) {
                throw new InvalidArgumentException('Loaders should be a service manager alias.');
            }
            $chain->addLoader($serviceLocator->get($loader));
        }

        return $chain;
    }
    
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }
}