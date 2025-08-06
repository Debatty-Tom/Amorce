<?php

namespace App\Enums;

enum PermissionActionsEnum: string
{
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case IMPORT = 'import';
}
