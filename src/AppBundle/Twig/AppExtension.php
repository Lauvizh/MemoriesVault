<?php
// src/AppBundle/Twig/AppExtension.php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('strPad', array($this, 'stringPadding')),
        );
    }

    public function stringPadding($input, $padlength, $padstring='', $padtype=STRPADRIGHT)
    {
        return strpad($input, $padlength, $padstring, $pad_type);
    }

    public function getName()
    {
        return 'app_extension';
    }
}