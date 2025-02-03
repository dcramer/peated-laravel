<?php

namespace App\Enums;

enum Category: string
{
    case Blend = 'blend';
    case Bourbon = 'bourbon';
    case Rye = 'rye';
    case SingleGrain = 'single_grain';
    case SingleMalt = 'single_malt';
    case SinglePotStill = 'single_pot_still';
    case Spirit = 'spirit';
}
