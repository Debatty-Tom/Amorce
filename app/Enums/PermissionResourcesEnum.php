<?php

namespace App\Enums;

enum PermissionResourcesEnum:string
{
    case DRAW = 'draw';
    case USER = 'user';
    case STOCK = 'stock';
    case PROJECT = 'project';
    case FUND = 'fund';
    case TRANSACTION = 'transaction';
    case CSV = 'csv';
}
