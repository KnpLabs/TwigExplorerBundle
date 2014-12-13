<?php

namespace spec\Knp\TwigExplorer\Name;

use PhpSpec\ObjectBehavior;

class ByNameResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Name\ByNameResolver');
    }
}
