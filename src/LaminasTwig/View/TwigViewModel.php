<?php

namespace LaminasTwig\View;

class TwigViewModel extends \Twig\Template {
    
    public function __construct(\Twig\Environment $env) {
        parent::__construct($env);
    }

    protected function doDisplay(array $context, array $blocks = array()) {
        print_r($context);
        print_r($blocks);
    }

    public function getDebugInfo(): array {
        
    }

    public function getSourceContext(): \Twig\Source {
        
    }

    public function getTemplateName(): string {
        
    }

}