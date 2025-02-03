<?php

namespace App\Enums;

enum ChangeObjectType: string
{
    case Bottle = 'bottle';
    case Entity = 'entity';
    case Collection = 'collection';
    case Flight = 'flight';
    case Tasting = 'tasting';
    case Comment = 'comment';
    case Toast = 'toast';
    case Follow = 'follow';
    case User = 'user';
}
