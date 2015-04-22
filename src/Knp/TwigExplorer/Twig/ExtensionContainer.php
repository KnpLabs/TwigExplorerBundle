<?php

namespace Knp\TwigExplorer\Twig;

class ExtensionContainer
{
    private $extensions = array();

    public function getExtensions()
    {
        return $this->extensions;
    }

    public function getExtensionsClasses()
    {
        return array_combine(
            array_keys($this->extensions),
            array_map('get_class', $this->extensions)
        );
    }

    public function addExtension(\Twig_Extension $extension, $service)
    {
        $this->extensions[$service] = $extension;
    }

    public function getFilters()
    {
        $filters = array();

        foreach ($this->extensions as $extension) {
            $filters[get_class($extension)] = $extension->getFilters();
        }

        return $filters;
    }

    public function getFunctions()
    {
        $functions = array();

        foreach ($this->extensions as $extension) {
            $functions[get_class($extension)] = $extension->getFunctions();
        }

        return $functions;
    }

    public function getTokenParsers()
    {
        $parsers = array();

        foreach ($this->extensions as $extension) {
            $parsers[get_class($extension)] = $extension->getTokenParsers();
        }

        return $parsers;
    }

    public function getNodeVisitors()
    {
        $visitors = array();

        foreach ($this->extensions as $extension) {
            $visitors[get_class($extension)] = $extension->getNodeVisitors();
        }

        return $visitors;
    }
}
