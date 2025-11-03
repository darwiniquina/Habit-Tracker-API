<?php

namespace App\Enums;

enum Frequency: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';

    public static function ALL(): array
    {
        return array_values(Frequency::cases());
    }
}
