<?php

namespace spec\Knp\TwigExplorer\DependencyInjection;

use PhpSpec\ObjectBehavior;

class KnpTwigExplorerExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\DependencyInjection\KnpTwigExplorerExtension');
    }
}
