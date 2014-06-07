<?php

namespace spec\Knp\TwigExplorer\Name;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ByNameResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Name\ByNameResolver');
    }
}
