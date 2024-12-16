<?php

namespace App\Enums;

enum AttendancesStatuses:string
{
    case Validated = 'validated';
    case Pending = 'pending';
}
