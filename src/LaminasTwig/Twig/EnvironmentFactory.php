<?php

namespace LaminasTwig\Twig;

use RuntimeException;
use Twig_Environment;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class EnvironmentFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Twig_Environment
     * @throws \RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \LaminasTwig\moduleOptions $options */
        $options  = $serviceLocator->get('LaminasTwig\ModuleOptions');
        $envClass = $options->getEnvironmentClass();

        /** @var \Twig_Environment $env */
        $env = new $envClass(null, $options->getEnvironmentOptions());

        if ($options->getEnableFallbackFunctions()) {
            $helperPluginManager = $serviceLocator->get('ViewHelperManager');
            $env->registerUndefinedFunctionCallback(
                function ($name) use ($helperPluginManager) {
                    if ($helperPluginManager->has($name)) {
                        return new FallbackFunction($name);
                    }
                    return false;
                }
            );
        }

        if (!$serviceLocator->has($options->getEnvironmentLoader())) {
            throw new RuntimeException(
                sprintf(
                    'Loader with alias "%s" could not be found!',
                    $options->getEnvironmentLoader()
                )
            );
        }

        $env->setLoader($serviceLocator->get($options->getEnvironmentLoader()));

        foreach ($options->getGlobals() as $name => $value) {
            $env->addGlobal($name, $value);
        }

        // Extensions are loaded later to avoid circular dependencies (for example, if an extension needs Renderer).
        return $env;
    }
    
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        return $this->createService($container);
    }
}
