<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Twig;

class SirepaeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('explode', array($this, 'explodeFilter')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }
    
    /*
    * adding custom function for split character
    * used for fuel/app/classes/twig/fuel/extension.php
    * @params
    *  $string : this is twig variable or value example {{ test }}
    *  $split  : this is split character example {{ test\tdata | split('\t') }} \t is split character
    * @return 
    *  array of explode
    * 
    */
    public function explodeFilter($string, $split = '')
    {
        return explode($split, $string);
    }

    public function getName()
    {
        return 'sirepae_extension';
    }
}