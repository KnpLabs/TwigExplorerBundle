<?php

namespace Knp\TwigExplorer\Name;

use Knp\TwigExplorer\Name\ResolverInterface;

class ResolverRegistry
{
    private $resolvers = [];

    public function addResolver(ResolverInterface $resolver)
    {
        $this->resolvers[] = $resolver;
    }

    public function getResolver($element)
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->supports($element)) {

                return $resolver;
            }
        }

        throw new \Exception(sprintf('Can\'t find any name resolver "%s"', get_class($element)));
    }
}
