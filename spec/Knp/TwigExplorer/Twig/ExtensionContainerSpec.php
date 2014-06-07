<?php

namespace spec\Knp\TwigExplorer\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtensionContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Twig\ExtensionContainer');
    }

    function it_register_extensions(\Twig_Extension $extension, \Twig_Extension $extension2)
    {
        $this->addExtension($extension);
        $this->getExtensions()->shouldReturn([
            $extension
        ]);

        $this->addExtension($extension2);
        $this->getExtensions()->shouldReturn([
            $extension,
            $extension2
        ]);
    }
}
