<?php

namespace App\Policies;

use App\Models\SitePhoto;
use App\Models\User;
use App\Enums\PermissionType;

class SitePhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function view(User $user, SitePhoto $sitePhoto): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function update(User $user, SitePhoto $sitePhoto): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function delete(User $user, SitePhoto $sitePhoto): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }
}