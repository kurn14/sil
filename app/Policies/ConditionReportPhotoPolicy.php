<?php

namespace App\Policies;

use App\Models\ConditionReportPhoto;
use App\Models\User;
use App\Enums\PermissionType;

class ConditionReportPhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function view(User $user, ConditionReportPhoto $conditionReportPhoto): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function update(User $user, ConditionReportPhoto $conditionReportPhoto): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function delete(User $user, ConditionReportPhoto $conditionReportPhoto): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }
}