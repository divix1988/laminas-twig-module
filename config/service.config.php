<?php

return array(
    'aliases' => array(
        'LaminasTwigExtension'               => 'LaminasTwig\Twig\Extension',
        'LaminasTwigLoaderChain'             => 'Twig\Loader\Chain',
        'LaminasTwigLoaderTemplateMap'       => 'LaminasTwig\Twig\MapLoader',
        'LaminasTwigLoaderTemplatePathStack' => 'LaminasTwig\Twig\StackLoader',
        'LaminasTwigRenderer'                => 'LaminasTwig\View\TwigRenderer',
        'LaminasTwigResolver'                => 'LaminasTwig\View\TwigResolver',
        'LaminasTwigViewHelperManager'       => 'LaminasTwig\View\HelperPluginManager',
        'LaminasTwigViewStrategy'            => 'LaminasTwig\View\TwigStrategy',
        'TwigViewModel'                       => 'LaminasTwig\View\TwigViewModel'
    ),

    'factories' => array(
        'Twig\Environment'  => 'LaminasTwig\Twig\EnvironmentFactory',
        'Twig\Loader\Chain' => 'LaminasTwig\Twig\ChainLoaderFactory',

        'LaminasTwig\Twig\Extension' => 'LaminasTwig\Twig\ExtensionFactory',
        'LaminasTwig\Twig\MapLoader' => 'LaminasTwig\Twig\MapLoaderFactory',

        'LaminasTwig\Twig\StackLoader'         => 'LaminasTwig\Twig\StackLoaderFactory',
        'LaminasTwig\View\TwigRenderer'        => 'LaminasTwig\View\TwigRendererFactory',
        'LaminasTwig\View\TwigResolver'        => 'LaminasTwig\View\TwigResolverFactory',
        'LaminasTwig\View\HelperPluginManager' => 'LaminasTwig\View\HelperPluginManagerFactory',
        'LaminasTwig\View\TwigStrategy'        => 'LaminasTwig\View\TwigStrategyFactory',

        'LaminasTwig\ModuleOptions' => 'LaminasTwig\ModuleOptionsFactory'
    )
);
