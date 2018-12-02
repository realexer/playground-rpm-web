<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/23/18
 * Time: 7:03 PM
 */

namespace App\Service\NewPostsProcessor\Serializer;

use Symfony\Component\PropertyInfo\Type;

class TypeMapper
{
    public static function makeCollection(string $class): Type
    {
        return new Type(Type::BUILTIN_TYPE_ARRAY, true, null, true,
            new Type(Type::BUILTIN_TYPE_INT, true),
            self::makeType($class));
    }

    public static function makeType(string $class): Type
    {
        return new Type(Type::BUILTIN_TYPE_OBJECT, true, $class);
    }

    public static function makePrimitive($type): Type
    {
        return new Type($type, true);
    }
}