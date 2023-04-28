<?php

namespace Ezeksoft\RocketZap\Enum;

enum PaymentMethod : int
{
    case CREDIT_CARD = 1;
    case BILLET = 2;
    case PIX = 3;
}