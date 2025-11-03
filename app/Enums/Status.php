<?php

namespace App\Enums;

enum Status: string
{
    case DONE = 'done';
    case SKIPPED = 'skipped';
    case MISSED = 'missed';

    public static function ALL(): array
    {
        return array_values(Status::cases());
    }
}
