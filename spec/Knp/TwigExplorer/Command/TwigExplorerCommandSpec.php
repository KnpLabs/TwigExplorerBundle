<?php

namespace spec\Knp\TwigExplorer\Command;

use PhpSpec\ObjectBehavior;

class TwigExplorerCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Command\TwigExplorerCommand');
    }
}
