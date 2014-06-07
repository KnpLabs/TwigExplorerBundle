<?php

namespace Knp\TwigExplorer\Name;

interface ResolverInterface
{
    public function supports($element);

    public function getName($key, $element);
}
