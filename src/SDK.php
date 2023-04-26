<?php 

/* 
|------------------------------------------------------
| RocketZap SDK
|------------------------------------------------------
| 
| Use this script in your project to trigger RocketZap 
| platform automation events.
| 
*/

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\{Entity, Auth};

final class SDK
{
    public static function __callStatic($method_name, $arguments)
    {
        $instance = new Auth;
        return $instance->$method_name(...$arguments);
    }
}