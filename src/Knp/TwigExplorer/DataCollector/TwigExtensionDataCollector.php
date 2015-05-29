<?php

namespace Knp\TwigExplorer\DataCollector;

use Knp\TwigExplorer\Data\Compiler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class TwigExtensionDataCollector extends DataCollector
{
    protected $compiler;

    public function __construct(Compiler $compiler)
    {
        $this->compiler = $compiler;
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = $this->compiler->compile();
    }

    public function getName()
    {
        return 'twig_explorer';
    }

    public function getExtensions()
    {
        return $this->data;
    }
}
