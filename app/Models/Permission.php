<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Extends Spatie Permission so Laravel auto-discovers App\Policies\PermissionPolicy
}
