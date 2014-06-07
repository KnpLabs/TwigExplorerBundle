<?php

namespace Knp\TwigExplorer\Name;

use Knp\TwigExplorer\Name\ResolverInterface;

class TransTokenResolver implements ResolverInterface
{
    public function supports($element)
    {
        return $element instanceof \Twig_TokenParserInterface;
    }

    public function getName($key, $element)
    {
        return $element->getTag();
    }
}
