<?php

namespace spec\Knp\TwigExplorer\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TwigExplorerCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Command\TwigExplorerCommand');
    }
}
