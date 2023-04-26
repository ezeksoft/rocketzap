<?php 

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\Entity;

class Auth
{
    public function SDK($apiSecret)
    {
        $instance = new Entity($apiSecret);
        $instance->setApiSecret($apiSecret);
        return $instance;
    }
}