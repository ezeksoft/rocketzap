<?php

namespace Ezeksoft\RocketZap\Enum;

enum MessageType : string
{
    case TEXT = "text";
    case IMAGE = "image";
    case ATTACHMENT = "attachment";
    case BUTTON = "button";
}