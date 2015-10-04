<?php

namespace Knp\TwigExplorer\Name;

use Twig_TokenParserInterface;

class TokenParserResolver implements ResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return $element instanceof Twig_TokenParserInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getName($key, $element)
    {
        return $element->getTag();
    }
}
