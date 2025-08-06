<?php

namespace App\Enums;

enum TransactionTypesEnum:string
{
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';
}
