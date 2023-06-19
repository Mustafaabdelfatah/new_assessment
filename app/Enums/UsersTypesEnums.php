<?php

namespace App\Enums;

enum UsersTypesEnums: string
{

    case ADMIN = 'admin';
    case EMPLOYEE = 'employee';

    // public static function getConstantNameByValue($value){
    //     return array_flip((new \ReflectionClass(WeekDaysEnum::class))->getConstants())[$value];
    // }
}
