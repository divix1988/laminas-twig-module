<?php
return array(
    'laminastwig' => array(
        /**
         * Service manager alias of the loader to use with LaminasTwig. By default, it uses
         * the included LaminasTwigLoaderChain which includes a copy of ZF2's TemplateMap and
         * TemplatePathStack.
         */
        'environment_loader' => 'LaminasTwigLoaderChain',

        /**
         * Optional class name override for instantiating the Twig Environment in the factory.
         */
        'environment_class' => 'Twig\Environment',

        /**
         * Options that are passed directly to the Twig_Environment.
         */
        'environment_options' => array(),

        /**
         * Service manager alias of any additional loaders to register with the chain. The default
         * has the TemplateMap and TemplatePathStack registered. This setting only has an effect
         * if the `environment_loader` key above is set to LaminasTwigLoaderChain.
         */
        'loader_chain' => array(
            'LaminasTwigLoaderTemplateMap',
            'LaminasTwigLoaderTemplatePathStack'
        ),

        /**
         * Service manager alias or fully qualified domain name of extensions. LaminasTwigExtension
         * is required for this module to function!
         */
        'extensions' => array(
            'laminastwig' => 'LaminasTwigExtension'
        ),

        /**
         * The suffix of Twig files. Technically, Twig can load *any* type of file
         * but the templates in ZF are suffix agnostic so we must specify the extension
         * that's expected here.
         */
        'suffix' => 'twig',

        /**
         * When enabled, the ZF2 view helpers will get pulled using a fallback renderer. This will
         * slightly degrade performance but must be used if you plan on using any of ZF2's view helpers.
         */
        'enable_fallback_functions' => true,

        /**
         * If set to true disables ZF's notion of parent/child layouts in favor of
         * Twig's inheritance model.
         */
        'disable_zf_model' => true,

        /**
         * LaminasTwig uses it's own HelperPluginManager to avoid renderer conflicts with the PhpRenderer. You must register
         * any view helpers in this array that require access to the renderer. The defaults from ZF2 (navigation,
         * partial, etc.) are done for you.
         */
        'helper_manager' => array(
            'configs' => array(
                'Laminas\Navigation\View\HelperConfig'
            )
        )
    ),

    /**
     * Load services.
     */
    'service_manager' => include 'service.config.php',

    /**
     * Register the view strategy with the view manager. This is required!
     */
    'view_manager' => array(
        'strategies' => array('LaminasTwigViewStrategy')
    )
);
