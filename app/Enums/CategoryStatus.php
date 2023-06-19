<?php

namespace App\Enums;

class CategoryStatus
{
    const Active = 'active';
    const Inactive = 'inactive';

    public static function getStatus($value): string
    {
        // dd($value);
        switch ($value) {
            case self::Active:
                return 'active';
            case self::Inactive:
                return 'Inactive';
            default:
                return '';
        }
    }
    public static function getValues(): array
    {
        return [
            self::Active,
            self::Inactive,
        ];
    }
 }
