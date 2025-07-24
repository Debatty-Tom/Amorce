<?php

// app/Configs/RolePermissionsConfig.php

namespace App\Configs;

use App\Enums\RolesEnum;
use App\Enums\PermissionActionsEnum;
use App\Enums\PermissionResourcesEnum;

class RolePermissionsConfig
{
    public static function get(): array
    {
        return [
            RolesEnum::ACCOUNTANT->value => [
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::CSV, PermissionActionsEnum::IMPORT],
            ],
            RolesEnum::DRAWMANAGER->value => [
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::DELETE],
            ],
            RolesEnum::USERMANAGER->value => [
                [PermissionResourcesEnum::USER, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::DELETE],
            ],
            RolesEnum::MEMBER->value => [
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::READ],
            ],
            RolesEnum::STOCKMANAGER->value => [
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::DELETE],
            ],
            RolesEnum::PROJECTMANAGER->value => [
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::DELETE],
            ],
            RolesEnum::ADMIN->value => [
                [PermissionResourcesEnum::USER, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::USER, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::DRAW, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::FUND, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::TRANSACTION, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::STOCK, PermissionActionsEnum::DELETE],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::CREATE],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::READ],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::UPDATE],
                [PermissionResourcesEnum::PROJECT, PermissionActionsEnum::DELETE]
            ]
        ];
    }
}

