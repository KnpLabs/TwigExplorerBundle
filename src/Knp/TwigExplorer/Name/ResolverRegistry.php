<?php

namespace Knp\TwigExplorer\Name;

class ResolverRegistry
{
    private $resolvers = [];

    /**
     * @param ResolverInterface $resolver
     */
    public function addResolver(ResolverInterface $resolver)
    {
        $this->resolvers[] = $resolver;
    }

    /**
     * @param mixed $element
     *
     * @throw \Exception
     *
     * @return ResolverInterface
     */
    public function getResolver($element)
    {
        foreach ($this->resolvers as $resolver) {
            if (true === $resolver->supports($element)) {
                return $resolver;
            }
        }

        throw new \Exception(sprintf('Can\'t find any name resolver "%s"', get_class($element)));
    }
}
