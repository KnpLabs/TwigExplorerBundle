<?php

namespace Knp\TwigExplorer\Command;

use Knp\TwigExplorer\Twig\ExtensionContainer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TwigExplorerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('knp:twig:explorer')
            ->setDescription('Display each extensions and each filters/functions available in TWIG.')
            ->addArgument('query', InputArgument::OPTIONAL, 'A query string')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $extensions = $this->getContainer()->get('knp.twig_explorer.twig.extension_container');
        $data = $this->compile($extensions);
        $q = $input->getArgument('query');

        if (null !== $q && !empty($q)) {
            $data = $this->filter($q, $data);
        }

        $output->write(
            $this->render('KnpTwigExplorerBundle::display.cli.twig', ['data' => $data])
        );
    }

    protected function compile(ExtensionContainer $container)
    {
        $data = [];

        foreach ($container->getExtensions() as $extension) {
            $data[get_class($extension)] = [
                'functions' => [],
                'filters' => [],
                'token parsers' => [],
            ];
        }

        foreach ($container->getFilters() as $extension => $filters) {
            foreach ($filters as $key => $element) {
                $data[$extension]['filters'][] = $this->resolve($key, $element);
            }
            $data[$extension]['filters'] = array_values($data[$extension]['filters']);
        }

        foreach ($container->getFunctions() as $extension => $functions) {
            foreach ($functions as $key => $element) {
                $data[$extension]['functions'][] = $this->resolve($key, $element);
            }
            $data[$extension]['functions'] = array_values($data[$extension]['functions']);
        }

        foreach ($container->getTokenParsers() as $extension => $functions) {
            foreach ($functions as $key => $element) {
                $data[$extension]['token parsers'][] = $this->resolve($key, $element);
            }
            $data[$extension]['token parsers'] = array_values($data[$extension]['token parsers']);
        }

        return $data;
    }

    public function filter($q, array $data)
    {
        foreach ($data as $extension => $elements) {
            foreach ($elements as $part => $names) {
                foreach ($names as $index => $name) {
                    if (false === strpos(strtolower($name), strtolower($q))) {
                        unset($data[$extension][$part][$index]);
                    }
                }
                $data[$extension][$part] = array_values($data[$extension][$part]);
            }
        }

        return $data;
    }

    protected function resolve($key, $element)
    {
        $resolvers = $this->getContainer()->get('knp.twig_explorer.name.resolver_registry');

        $resolver = $resolvers->getResolver($element);

        return $resolver->getName($key, $element);
    }

    protected function render($template, array $context = [])
    {
        $templating = $this->getContainer()->get('templating');

        return $templating->render($template, $context);
    }
}
