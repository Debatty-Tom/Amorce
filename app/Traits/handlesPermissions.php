<?php

// app/Traits/HandlesPermissions.php

namespace App\Traits;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\PermissionActionsEnum;
use App\Enums\PermissionResourcesEnum;
use App\Configs\RolePermissionsConfig;

trait handlesPermissions
{
    public function generateAndAssignPermissions(): void
    {
        $permissions = [];

        foreach (PermissionResourcesEnum::cases() as $resource) {
            foreach (PermissionActionsEnum::cases() as $action) {
                $permissionName = "{$resource->value}-{$action->value}";
                $permissions[$resource->name][$action->name] = Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        $rolePermissions = RolePermissionsConfig::get();

        foreach ($rolePermissions as $roleEnum => $permissionPairs) {
            $role = Role::firstOrCreate(['name' => $roleEnum]);

            $assignedPermissions = collect($permissionPairs)->map(function (array $pair) use ($permissions) {
                [$resource, $action] = $pair;
                return $permissions[$resource->name][$action->name];
            });

            $role->syncPermissions($assignedPermissions);
        }
    }
}
