<?php

namespace Ezeksoft\RocketZap\Enum;

enum Event : int
{
    case PIX_GENERATED = 1;
    case BILLET_PRINTED = 2;
    case APPROVED = 3;
    case CANCELED = 4;
    case REFUNDED = 5;
    case REJECTED = 6;
    case CHARGEDBACK = 7;
    case PENDING = 8;
}