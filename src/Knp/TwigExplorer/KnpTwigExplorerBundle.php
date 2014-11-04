<?php

namespace Knp\TwigExplorer;

use Knp\TwigExplorer\DependencyInjection\Compiler\NameResolversPass;
use Knp\TwigExplorer\DependencyInjection\Compiler\TwigExtensionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class KnpTwigExplorerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TwigExtensionsPass());
        $container->addCompilerPass(new NameResolversPass());
    }
}
