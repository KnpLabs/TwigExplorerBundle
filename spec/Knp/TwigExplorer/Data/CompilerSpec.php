<?php

namespace spec\Knp\TwigExplorer\Data;

use Knp\TwigExplorer\Name\ResolverInterface;
use Knp\TwigExplorer\Name\ResolverRegistry;
use Knp\TwigExplorer\Twig\ExtensionContainer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompilerSpec extends ObjectBehavior
{
    function let(ExtensionContainer $extensions, ResolverRegistry $resolvers, $extension1, $extension2, $ext1, $ext2, $ext3, ResolverInterface $res1, ResolverInterface $res2, ResolverInterface $res3)
    {
        $this->beConstructedWith($extensions, $resolvers);

        $resolvers->getResolver($ext1)->willReturn($res1);
        $resolvers->getResolver($ext2)->willReturn($res2);
        $resolvers->getResolver($ext3)->willReturn($res3);

        $res1->getName(Argument::any(), Argument::any())->willReturn('form');
        $res2->getName(Argument::any(), Argument::any())->willReturn('form_theme');
        $res3->getName(Argument::any(), Argument::any())->willReturn('dump');

        $extensions->getExtensionsClasses()->willReturn(['ext1' => 'Ext1', 'ext2' => 'Ext2' ]);
        $extensions->getFilters()->willReturn(['Ext1' => [ $ext1 ], 'Ext2' => []]);
        $extensions->getFunctions()->willReturn(['Ext1' => [ $ext3 ], 'Ext2' => [ $ext2 ]]);
        $extensions->getTokenParsers()->willReturn(['Ext1' => [], 'Ext2' => []]);
        $extensions->getNodeVisitors()->willReturn(['Ext1' => [], 'Ext2' => []]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\TwigExplorer\Data\Compiler');
    }

    function it_compile_extensions()
    {
        $this->compile()->shouldReturn([
            'Ext1' => [
                'service' => 'ext1',
                'parts' => [
                    'filters' => ['form'],
                    'functions' => ['dump'],
                    'token parsers' => [],
                    'node visitors' => [],
                ]
            ],
            'Ext2' => [
                'service' => 'ext2',
                'parts' => [
                    'filters' => [],
                    'functions' => ['form_theme'],
                    'token parsers' => [],
                    'node visitors' => [],
                ]
            ],
        ]);
    }

    function it_filter_results()
    {
        $this->filter('form')->shouldReturn([
            'Ext1' => [
                'service' => 'ext1',
                'parts' => [
                    'filters' => ['form'],
                    'functions' => [],
                    'token parsers' => [],
                    'node visitors' => [],
                ]
            ],
            'Ext2' => [
                'service' => 'ext2',
                'parts' => [
                    'filters' => [],
                    'functions' => ['form_theme'],
                    'token parsers' => [],
                    'node visitors' => [],
                ]
            ],
        ]);
    }
}
