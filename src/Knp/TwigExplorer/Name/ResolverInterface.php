<?php

namespace Knp\TwigExplorer\Name;

interface ResolverInterface
{
    /**
     * @param mixed $element
     *
     * @return bool
     */
    public function supports($element);

    /**
     * @param string $key
     * @param mixed  $element
     *
     * @return string
     */
    public function getName($key, $element);
}
