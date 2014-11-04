<?php

namespace Knp\TwigExplorer\Name;

use \Twig_Filter_Function;
use \Twig_Filter_Method;
use \Twig_Function_Method;
use \Twig_Function_Node;

class ByKeyResolver implements ResolverInterface
{
    public function supports($element)
    {
        return $element instanceof Twig_Filter_Method
            || $element instanceof Twig_Filter_Function
            || $element instanceof Twig_Function_Node
            || $element instanceof Twig_Function_Method;
    }

    public function getName($key, $element)
    {
        return $key;
    }
}
