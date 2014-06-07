<?php

namespace spec\Knp\TwigExplorer\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KnpTwigExplorerExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\DependencyInjection\KnpTwigExplorerExtension');
    }
}
