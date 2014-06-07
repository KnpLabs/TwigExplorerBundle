<?php

namespace Knp\TwigExplorer\Name;

use Knp\TwigExplorer\Name\ResolverInterface;

class FilterMethodResolver implements ResolverInterface
{
    public function supports($element)
    {
        return $element instanceof \Twig_Filter_Method
            || $element instanceof \Twig_Filter_Function
            || $element instanceof \Twig_Function_Node
            || $element instanceof \Twig_Function_Method;
    }

    public function getName($key, $element)
    {
        return $key;
    }
}
