<?php

namespace Knp\TwigExplorer\Command;

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
        $compiler = $this->getContainer()->get('knp.twig_explorer.data.compiler');
        $q = $input->getArgument('query');

        if (null !== $q && !empty($q)) {
            $data = $compiler->filter($q);
        } else {
            $data = $compiler->compile();
        }

        $output->write(
            $this->render('KnpTwigExplorerBundle::display.cli.twig', ['data' => $data])
        );
    }

    protected function render($template, array $context = [])
    {
        $templating = $this->getContainer()->get('templating');

        return $templating->render($template, $context);
    }
}
