<?php

namespace Knp\TwigExplorer\Name;

use Twig_SimpleFilter;
use Twig_SimpleFunction;

class ByNameResolver implements ResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return $element instanceof Twig_SimpleFilter
            || $element instanceof Twig_SimpleFunction;
    }

    /**
     * {@inheritdoc}
     */
    public function getName($key, $element)
    {
        return $element->getName();
    }
}
