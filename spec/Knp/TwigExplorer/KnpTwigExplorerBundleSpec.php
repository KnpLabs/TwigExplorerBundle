<?php

namespace spec\Knp\TwigExplorer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KnpTwigExplorerBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\KnpTwigExplorerBundle');
    }
}
