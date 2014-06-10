<?php

namespace spec\Knp\TwigExplorer\DataCollector;

use Knp\TwigExplorer\Data\Compiler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TwigExtensionDataCollectorSpec extends ObjectBehavior
{
    function let(Compiler $compiler)
    {
        $this->beConstructedWith($compiler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\DataCollector\TwigExtensionDataCollector');
    }
}
