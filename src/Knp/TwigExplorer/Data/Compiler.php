<?php

namespace Knp\TwigExplorer\Data;

use Knp\TwigExplorer\Name\ResolverRegistry;
use Knp\TwigExplorer\Twig\ExtensionContainer;

class Compiler
{
    private $extensions;
    private $resolvers;

    public function __construct(ExtensionContainer $extensions, ResolverRegistry $resolvers)
    {
        $this->extensions = $extensions;
        $this->resolvers  = $resolvers;
    }

    public function compile()
    {
        $data = [];

        foreach ($this->extensions->getFilters() as $extension => $filters) {
            $data[$extension]['filters'] = [];
            foreach ($filters as $key => $element) {
                $data[$extension]['filters'][] = $this->resolve($key, $element);
            }
            $data[$extension]['filters'] = array_values($data[$extension]['filters']);
        }

        foreach ($this->extensions->getFunctions() as $extension => $functions) {
            $data[$extension]['functions'] = [];
            foreach ($functions as $key => $element) {
                $data[$extension]['functions'][] = $this->resolve($key, $element);
            }
            $data[$extension]['functions'] = array_values($data[$extension]['functions']);
        }

        foreach ($this->extensions->getTokenParsers() as $extension => $functions) {
            $data[$extension]['token parsers'] = [];
            foreach ($functions as $key => $element) {
                $data[$extension]['token parsers'][] = $this->resolve($key, $element);
            }
            $data[$extension]['token parsers'] = array_values($data[$extension]['token parsers']);
        }

        return $data;
    }

    public function filter($q, array $data = null)
    {
        $data = $data ?: $this->compile();

        foreach ($data as $extension => $elements) {
            foreach ($elements as $part => $names) {
                foreach ($names as $index => $name) {
                    if (false === strpos(strtolower($name), strtolower($q))) {
                        unset($data[$extension][$part][$index]);
                    }
                }
                $data[$extension][$part] = array_values($data[$extension][$part]);
            }
        }

        return $data;
    }

    protected function resolve($key, $element)
    {
        $resolver = $this->resolvers->getResolver($element);

        return $resolver->getName($key, $element);
    }
}
