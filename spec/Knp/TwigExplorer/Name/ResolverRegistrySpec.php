<?php

namespace spec\Knp\TwigExplorer\Name;

use Knp\TwigExplorer\Name\ResolverInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResolverRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Name\ResolverRegistry');
    }

    function it_should_return_the_good_resolver(ResolverInterface $resolver1, ResolverInterface $resolver2, $element)
    {
        $resolver1->supports($element)->willReturn(true);
        $resolver2->supports($element)->willReturn(false);

        $this->addResolver($resolver1);
        $this->addResolver($resolver2);

        $this->getResolver($element)->shouldReturn($resolver1);
    }
}
