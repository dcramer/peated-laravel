<?php

namespace App\Enums;

enum ContentSource: string
{
    case Generated = 'generated';
    case User = 'user';
}
