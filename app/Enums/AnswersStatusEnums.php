<?php

namespace App\Enums;

enum AnswersStatusEnums: string
{

    case PENDING = 'pending';
    case PUBLISHED = 'published';

    // public static function getConstantNameByValue($value){
    //     return array_flip((new \ReflectionClass(WeekDaysEnum::class))->getConstants())[$value];
    // }
}
