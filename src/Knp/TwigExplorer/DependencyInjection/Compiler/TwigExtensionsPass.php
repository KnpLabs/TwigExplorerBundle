<?php

namespace Knp\TwigExplorer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TwigExtensionsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $extensionContainer = $container->getDefinition('knp.twig_explorer.twig.extension_container');

        foreach ($container->findTaggedServiceIds('twig.extension') as $id => $service) {
            $extensionContainer->addMethodCall('addExtension', [new Reference($id), $id]);
        }
    }
}
