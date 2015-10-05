<?php

namespace Knp\TwigExplorer\Twig;

class StringExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('pad', array($this, 'pad')),
        ];
    }

    public function pad($str, $padLength, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return str_pad($str, $padLength, $padString, $padType);
    }

    public function getName()
    {
        return 'string';
    }
}
