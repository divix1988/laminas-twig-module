<?php

namespace LaminasTwig\View;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class TwigRendererFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TwigRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \LaminasTwig\moduleOptions $options */
        $options = $serviceLocator->get('LaminasTwig\ModuleOptions');

        $renderer = new TwigRenderer(
            $serviceLocator->get('Laminas\View\View'),
            $serviceLocator->get('Twig\Loader\Chain'),
            $serviceLocator->get('Twig\Environment'),
            $serviceLocator->get('LaminasTwig\View\TwigResolver')
        );

        $renderer->setCanRenderTrees($options->getDisableZfmodel());
        $renderer->setHelperPluginManager($serviceLocator->get('LaminasTwigViewHelperManager'));

        return $renderer;
    }

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }

}