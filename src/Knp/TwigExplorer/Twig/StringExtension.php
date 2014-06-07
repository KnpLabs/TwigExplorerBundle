<?php

namespace Knp\TwigExplorer\Twig;

class StringExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            'pad' => new \Twig_Filter_Method($this, 'pad')
        ];
    }

    public function pad($str, $pad_length , $pad_string = " ", $pad_type = STR_PAD_RIGHT)
    {
        return str_pad($str, $pad_length , $pad_string, $pad_type);
    }

    public function getName()
    {
        return 'string';
    }
}
