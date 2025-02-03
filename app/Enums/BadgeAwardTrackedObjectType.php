<?php

namespace App\Enums;

enum BadgeAwardTrackedObjectType: string
{
    case Bottle = 'bottle';
    case Entity = 'entity';
    case Country = 'country';
    case Region = 'region';
}
