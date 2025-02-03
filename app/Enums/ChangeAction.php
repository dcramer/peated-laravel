<?php

namespace App\Enums;

enum ChangeAction: string
{
    case Create = 'create';
    case Update = 'update';
    case Delete = 'delete';
    case Merge = 'merge';
}
