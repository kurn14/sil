<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Applicant extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'nik',
        'address',
        'institution_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // All authenticated applicants can access their panel
    }

    public function facilityUsageRequests(): HasMany
    {
        return $this->hasMany(FacilityUsageRequest::class);
    }
}
