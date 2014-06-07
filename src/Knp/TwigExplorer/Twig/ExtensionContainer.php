<?php

namespace Knp\TwigExplorer\Twig;

class ExtensionContainer
{
    private $extensions = [];

    public function getExtensions()
    {
        return $this->extensions;
    }

    public function addExtension(\Twig_Extension $extension)
    {
        $this->extensions[] = $extension;
    }

    public function getFilters()
    {
        $filters = [];

        foreach ($this->extensions as $extension) {
            $filters[get_class($extension)] = $extension->getFilters();
        }

        return $filters;
    }

    public function getFunctions()
    {
        $functions = [];

        foreach ($this->extensions as $extension) {
            $functions[get_class($extension)] = $extension->getFunctions();
        }

        return $functions;
    }

    public function getTokenParsers()
    {
        $parsers = [];

        foreach ($this->extensions as $extension) {
            $parsers[get_class($extension)] = $extension->getTokenParsers();
        }

        return $parsers;
    }
}
