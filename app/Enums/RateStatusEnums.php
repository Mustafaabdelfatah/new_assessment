<?php

namespace App\Enums;

enum RateStatusEnums: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case PUBLISHED = 'published';
    case RETURNED = 'returned';

    // public static function getConstantNameByValue($value){
    //     return array_flip((new \ReflectionClass(WeekDaysEnum::class))->getConstants())[$value];
    // }
}
