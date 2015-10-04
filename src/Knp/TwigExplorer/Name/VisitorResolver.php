<?php

namespace Knp\TwigExplorer\Name;

class VisitorResolver implements ResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return $element instanceof \Twig_NodeVisitorInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getName($key, $element)
    {
        $class = get_class($element);
        $parts = explode('\\', $class);

        return end($parts);
    }
}
