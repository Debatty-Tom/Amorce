<?php

namespace App\Enums;

enum EnumsDrawAssignmentsStatuses: string
{
    case funded = 'funded';
    case refused = 'refused';
    case pending = 'pending';
}
