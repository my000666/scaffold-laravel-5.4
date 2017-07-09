<?php

namespace App\Models;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public function permission_user() {
        return $this->hasMany('App\Models\PermissionUser');
    }
}
