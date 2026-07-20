<?php

namespace App\Policies;

use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Enums\PermissionType;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }
}