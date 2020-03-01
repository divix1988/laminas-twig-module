<?php

namespace LaminasTwig\View;

use Zend\View\HelperPluginManager as ZendHelperPluginManager;

class HelperPluginManager extends ZendHelperPluginManager
{
    /**
     * Default set of helpers factories
     *
     * @var array
     */
    protected $factories = array(
        'flashmessenger' => 'Laminas\View\Helper\Service\FlashMessengerFactory',
    );

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'declarevars'      => 'Laminas\View\Helper\DeclareVars',
        'htmlflash'        => 'Laminas\View\Helper\HtmlFlash',
        'htmllist'         => 'Laminas\View\Helper\HtmlList',
        'htmlobject'       => 'Laminas\View\Helper\HtmlObject',
        'htmlpage'         => 'Laminas\View\Helper\HtmlPage',
        'htmlquicktime'    => 'Laminas\View\Helper\HtmlQuicktime',
        'layout'           => 'Laminas\View\Helper\Layout',
        'renderchildmodel' => 'Laminas\View\Helper\RenderChildModel',
    );
}
