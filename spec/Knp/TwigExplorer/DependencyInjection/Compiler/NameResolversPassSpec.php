<?php

namespace spec\Knp\TwigExplorer\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;

class NameResolversPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\DependencyInjection\Compiler\NameResolversPass');
    }
}
