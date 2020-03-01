<?php

namespace LaminasTwig\Twig;

use Twig\Function;
use Laminas\View\Helper\HelperInterface;

class FallbackFunction extends Twig\Function
{
    /**
     * @var HelperInterface
     */
    protected $helper;

    public function __construct($helper)
    {
        $this->helper = $helper;

        parent::__construct(array('is_safe' => array('all')));
    }

    /**
     * Compiles a function.
     *
     * @return string The PHP code for the function
     */
    public function compile()
    {
        return sprintf('$this->env->getExtension("laminas-twig")->getRenderer()->plugin("%s")->__invoke', $this->helper);
    }
}