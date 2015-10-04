<?php

namespace Knp\TwigExplorer\Data;

use Knp\TwigExplorer\Name\ResolverRegistry;
use Knp\TwigExplorer\Twig\ExtensionContainer;

class Compiler
{
    /**
     * @var ExtensionContainer
     */
    private $extensions;

    /**
     * @var ResolverRegistry
     */
    private $resolvers;

    /**
     * @param ExtensionContainer $extensions
     * @param ResolverRegistry   $resolvers
     */
    public function __construct(ExtensionContainer $extensions, ResolverRegistry $resolvers)
    {
        $this->extensions = $extensions;
        $this->resolvers  = $resolvers;
    }

    /**
     * Compile twig extensions data into an array.
     *
     * @return array
     */
    public function compile()
    {
        $data = array();

        foreach ($this->extensions->getExtensionsClasses() as $id => $extension) {
            $data[$extension]['service'] = $id;
        }

        $data = $this->compilePart($data, 'filters', 'getFilters');
        $data = $this->compilePart($data, 'functions', 'getFunctions');
        $data = $this->compilePart($data, 'token parsers', 'getTokenParsers');
        $data = $this->compilePart($data, 'node visitors', 'getNodeVisitors');

        return $data;
    }

    /**
     * Filter data.
     *
     * @param string     $q
     * @param array|null $data
     *
     * @return array
     */
    public function filter($q, array $data = null)
    {
        $data = null !== $data ? $data : $this->compile();

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

    /**
     * @param array  $data
     * @param string $part
     * @param string $method
     *
     * @return array
     */
    private function compilePart(array $data, $part, $method)
    {
        foreach ($this->extensions->$method() as $extension => $functions) {
            $data[$extension]['parts'][$part] = array();
            foreach ($functions as $key => $element) {
                $data[$extension]['parts'][$part][] = $this->resolve($key, $element);
            }
            $data[$extension]['parts'][$part] = array_values($data[$extension]['parts'][$part]);
        }

        return $data;
    }

    /**
     * @param string $key
     * @param mixed  $element
     *
     * @return string
     */
    private function resolve($key, $element)
    {
        $resolver = $this->resolvers->getResolver($element);

        return $resolver->getName($key, $element);
    }
}
