<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/23/18
 * Time: 7:03 PM
 */

namespace App\Service\NewPostsProcessor\Serializer;

use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\PropertyInfo\Type;

class TypeMappedExtractor implements PropertyTypeExtractorInterface
{
    private $map;

    public function __construct(array $map = null)
    {
        $this->map = $map;
    }

    /**
     * Gets types of a property.
     *
     * @param string $class
     * @param string $property
     * @param array $context
     *
     * @return Type[]|null
     */
    public function getTypes($class, $property, array $context = array())
    {
        if ('[]' === substr($class, -2)) {
            $class = substr($class, 0, -2);
        }

        if (isset($this->map[$class])) {
            if (isset($this->map[$class][$property])) {

                return [$this->map[$class][$property]];
            }
        }
    }
}