<?php

namespace App\Policies;

use App\Models\FacilityUsageRequest;
use App\Models\User;
use App\Enums\PermissionType;

class FacilityUsageRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function view(User $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs') || $user->hasRole('pimpinan')) {
            return true;
        }
        return $user->id === $facilityUsageRequest->user_id;
    }

    public function update(User $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs')) {
            return true;
        }
        if ($user->id === $facilityUsageRequest->user_id) {
            return $facilityUsageRequest->status === 'submitted';
        }
        return false;
    }

    public function delete(User $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs')) {
            return true;
        }
        if ($user->id === $facilityUsageRequest->user_id) {
            return $facilityUsageRequest->status === 'submitted';
        }
        return false;
    }
}