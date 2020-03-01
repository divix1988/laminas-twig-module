<?php

namespace LaminasTwig\Twig;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class MapLoaderFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MapLoader
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \LaminasTwig\moduleOptions $options */
        $options = $serviceLocator->get('LaminasTwig\ModuleOptions');

        /** @var \Laminas\View\Resolver\TemplateMapResolver */
        $zfTemplateMap = $serviceLocator->get('ViewTemplateMapResolver');

        $templateMap = new MapLoader();
        foreach ($zfTemplateMap as $name => $path) {
            if ($options->getSuffix() == pathinfo($path, PATHINFO_EXTENSION)) {
                $templateMap->add($name, $path);
            }
        }

        return $templateMap;
    }
    
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }
}