<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/28/18
 * Time: 9:43 PM
 */

namespace App\Twig;


class UnescapeExtension extends  \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('unescape', array($this, 'unescape')),
        );
    }

    public function unescape($value)
    {
        return html_entity_decode($value);
    }
}