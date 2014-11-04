<?php

namespace spec\Knp\TwigExplorer\Twig;

use PhpSpec\ObjectBehavior;

class StringExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Twig\StringExtension');
    }

    function it_pad_the_string()
    {
        $this->pad('test', '12')->shouldReturn('test        ');
    }
}
