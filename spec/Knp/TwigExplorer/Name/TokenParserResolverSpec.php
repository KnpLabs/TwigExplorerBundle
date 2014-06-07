<?php

namespace spec\Knp\TwigExplorer\Name;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenParserResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Name\TokenParserResolver');
    }
}
