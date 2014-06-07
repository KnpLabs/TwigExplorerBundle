<?php

namespace Knp\TwigExplorer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NameResolversPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $extensionContainer = $container->getDefinition('knp.twig_explorer.name.resolver_registry');

        foreach ($container->findTaggedServiceIds('knp.twig_explorer.name_resolver') as $id => $service) {
            $extensionContainer->addMethodCall('addResolver', [ new Reference($id) ]);
        }
    }
}
