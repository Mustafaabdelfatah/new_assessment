<?php

namespace App\Enums;

enum ActionsStatusEnums: string
{

    case PENDING = 'pending';

    case ACTIVE = 'active';

    case REJECTED = 'rejected';


    case RETURNED = 'returned';

    case REFUSED = 'refused';

    case ACCEPT = 'accept';

    // public static function getConstantNameByValue($value){
    //     return array_flip((new \ReflectionClass(WeekDaysEnum::class))->getConstants())[$value];
    // }
}
