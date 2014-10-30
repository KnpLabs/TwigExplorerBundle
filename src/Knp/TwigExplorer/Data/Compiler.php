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

        foreach ($this->extensions->getExtensionsClasses() as $id => $extension) {
            $data[$extension]['service'] = $id;
        }

        foreach ($this->extensions->getFilters() as $extension => $filters) {
            $data[$extension]['parts']['filters'] = [];
            foreach ($filters as $key => $element) {
                $data[$extension]['parts']['filters'][] = $this->resolve($key, $element);
            }
            $data[$extension]['parts']['filters'] = array_values($data[$extension]['parts']['filters']);
        }

        foreach ($this->extensions->getFunctions() as $extension => $functions) {
            $data[$extension]['parts']['functions'] = [];
            foreach ($functions as $key => $element) {
                $data[$extension]['parts']['functions'][] = $this->resolve($key, $element);
            }
            $data[$extension]['parts']['functions'] = array_values($data[$extension]['parts']['functions']);
        }

        foreach ($this->extensions->getTokenParsers() as $extension => $functions) {
            $data[$extension]['parts']['token parsers'] = [];
            foreach ($functions as $key => $element) {
                $data[$extension]['parts']['token parsers'][] = $this->resolve($key, $element);
            }
            $data[$extension]['parts']['token parsers'] = array_values($data[$extension]['parts']['token parsers']);
        }

        return $data;
    }

    public function filter($q, array $data = null)
    {
        $data = $data ?: $this->compile();

        foreach ($data as $extension => $values) {
            foreach ($values['parts'] as $part => $names) {
                foreach ($names as $index => $name) {
                    if (false === strpos(strtolower($name), strtolower($q))) {
                        unset($data[$extension]['parts'][$part][$index]);
                    }
                }
                $data[$extension]['parts'][$part] = array_values($data[$extension]['parts'][$part]);
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
