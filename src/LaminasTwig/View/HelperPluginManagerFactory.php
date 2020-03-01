<?php

namespace LaminasTwig\View;

use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\ConfigInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Exception;

class HelperPluginManagerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \Laminas\View\Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \LaminasTwig\moduleOptions $options */
        $options        = $serviceLocator->get('LaminasTwig\ModuleOptions');
        $managerOptions = $options->getHelperManager();
        $managerConfigs = isset($managerOptions['configs']) ? $managerOptions['configs'] : array();

        $baseManager = $serviceLocator->get('ViewHelperManager');
        $twigManager = new HelperPluginManager($baseManager);
        //$twigManager->addPeeringServiceManager($baseManager);

        foreach ($managerConfigs as $configClass) {
            if (is_string($configClass) && class_exists($configClass)) {
                $config = new $configClass;

                if (!$config instanceof ConfigInterface) {
                    throw new Exception\RuntimeException(
                        sprintf(
                            'Invalid service manager configuration class provided; received "%s",
                                expected class implementing %s',
                            $configClass,
                            'Laminas\ServiceManager\ConfigInterface'
                        )
                    );
                }

                $config->configureServiceManager($twigManager);
            }
        }

        return $twigManager;
    }
    
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }
}