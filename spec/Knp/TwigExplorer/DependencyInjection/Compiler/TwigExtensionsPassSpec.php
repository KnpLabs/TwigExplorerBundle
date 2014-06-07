<?php

namespace spec\Knp\TwigExplorer\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TwigExtensionsPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\DependencyInjection\Compiler\TwigExtensionsPass');
    }
}
