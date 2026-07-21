<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Enums\PermissionType;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function update(User $user, Role $role): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }
}