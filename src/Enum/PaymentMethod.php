<?php

namespace Ezeksoft\RocketZap\Enum;

enum PaymentMethod : int
{
    case PIX = 1;
    case BILLET = 2;
    case CREDIT_CARD = 3;
}