<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ACCOUNTANT = 'accountant';
    case DRAWMANAGER = 'draw-manager';
    case USERMANAGER = 'user-manager';
    case MEMBER = 'member';
    case STOCKMANAGER = 'stock-manager';
    case PROJECTMANAGER = 'project-manager';
    case ADMIN = 'admin';
}
