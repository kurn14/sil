<?php

namespace App\Policies;

use App\Models\Applicant;
use App\Models\FacilityUsageRequest;
use App\Models\User;
use App\Enums\PermissionType;

class FacilityUsageRequestPolicy
{
    public function viewAny(User|Applicant $user): bool
    {
        if ($user instanceof Applicant) {
            return true;
        }
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function create(User|Applicant $user): bool
    {
        if ($user instanceof Applicant) {
            return true;
        }
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function view(User|Applicant $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user instanceof User) {
            if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs') || $user->hasRole('pimpinan')) {
                return true;
            }
        }
        
        if ($user instanceof Applicant) {
            return $user->id === $facilityUsageRequest->applicant_id;
        }
        
        return false;
    }

    public function update(User|Applicant $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user instanceof User) {
            if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs')) {
                return true;
            }
        }
        
        if ($user instanceof Applicant) {
            return $user->id === $facilityUsageRequest->applicant_id && $facilityUsageRequest->status === 'submitted';
        }
        
        return false;
    }

    public function delete(User|Applicant $user, FacilityUsageRequest $facilityUsageRequest): bool
    {
        if ($user instanceof User) {
            if ($user->hasRole('super_admin') || $user->hasRole('pengelola_situs')) {
                return true;
            }
        }
        
        if ($user instanceof Applicant) {
            return $user->id === $facilityUsageRequest->applicant_id && $facilityUsageRequest->status === 'submitted';
        }
        
        return false;
    }
}