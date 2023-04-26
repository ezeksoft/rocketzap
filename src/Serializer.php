<?php 

namespace Ezeksoft\RocketZap;

class Serializer
{
    public static function arrayToHeader($headers)
    {
        return array_map(fn($name, $value) => "{$name}: {$value}", array_keys($headers), array_values($headers));
    }
}