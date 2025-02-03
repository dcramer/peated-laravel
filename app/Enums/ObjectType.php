<?php

namespace App\Enums;

enum ObjectType: string
{
    case Bottle = 'bottle';
    case Entity = 'entity';
    case Tasting = 'tasting';
    case Comment = 'comment';
    case Toast = 'toast';
    case Follow = 'follow';
}
